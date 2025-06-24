@extends('layouts.app')

@section('title', 'Registrar Compra - MERCA2')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registrar Nueva Compra</h1>
        <a href="{{ route('purchases.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left mr-2"></i> Regresar
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-light">
            <h6 class="m-0 font-weight-bold text-primary">Datos de la Compra</h6>
        </div>
        <div class="card-body">
            <form id="purchase-form" action="{{ route('purchases.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="supplier_id">Proveedor *</label>
                            <select class="form-control" id="supplier_id" name="supplier_id" required>
                                <option value="">Seleccionar proveedor</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="purchase_date">Fecha *</label>
                            <input type="date" class="form-control" id="purchase_date" name="purchase_date" required value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="invoice_number">Factura *</label>
                            <input type="text" class="form-control" id="invoice_number" name="invoice_number" required>
                        </div>
                    </div>
                </div>

                <hr>

                <h5 class="mb-3">Productos</h5>
                <div class="table-responsive mb-3">
                    <table class="table table-bordered" id="products-table">
                        <thead>
                            <tr>
                                <th width="40%">Producto</th>
                                <th width="15%">Cantidad</th>
                                <th width="20%">Precio Unitario</th>
                                <th width="20%">Subtotal</th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody id="items-container">
                            <!-- Los items se agregarán dinámicamente aquí -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                <td id="total-amount">$0.00</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="row mb-4">
                    <div class="col-md-8">
                        <select class="form-control" id="product-select">
                            <option value="">Seleccionar producto</option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->purchase_price }}">
                                {{ $product->name }} ({{ $product->barcode }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-block" id="add-product">
                            <i class="fas fa-plus mr-2"></i> Agregar
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="notes">Notas</label>
                    <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i> Registrar Compra
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const items = [];
    let itemCounter = 0;

    // Agregar producto al formulario
    document.getElementById('add-product').addEventListener('click', function() {
        const productSelect = document.getElementById('product-select');
        const productId = productSelect.value;
        const productName = productSelect.options[productSelect.selectedIndex].text;
        const unitPrice = parseFloat(productSelect.options[productSelect.selectedIndex].dataset.price);

        if (!productId) return;

        const item = {
            id: productId,
            name: productName,
            quantity: 1,
            unit_price: unitPrice,
            subtotal: unitPrice
        };

        items.push(item);
        renderItems();
        productSelect.value = '';
    });

    // Renderizar items en la tabla
    function renderItems() {
        const container = document.getElementById('items-container');
        const totalAmount = document.getElementById('total-amount');
        let total = 0;

        container.innerHTML = '';
        
        items.forEach((item, index) => {
            total += item.subtotal;
            
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    ${item.name}
                    <input type="hidden" name="items[${index}][product_id]" value="${item.id}">
                </td>
                <td>
                    <input type="number" name="items[${index}][quantity]" class="form-control quantity" 
                           value="${item.quantity}" min="1" data-index="${index}">
                </td>
                <td>
                    <input type="number" step="0.01" name="items[${index}][unit_price]" class="form-control price" 
                           value="${item.unit_price.toFixed(2)}" min="0" data-index="${index}">
                </td>
                <td class="subtotal">$${item.subtotal.toFixed(2)}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-item" data-index="${index}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            `;
            container.appendChild(row);
        });

        totalAmount.textContent = `$${total.toFixed(2)}`;

        // Event listeners para los nuevos elementos
        document.querySelectorAll('.quantity').forEach(input => {
            input.addEventListener('change', function() {
                const index = this.dataset.index;
                items[index].quantity = parseInt(this.value);
                items[index].subtotal = items[index].quantity * items[index].unit_price;
                renderItems();
            });
        });

        document.querySelectorAll('.price').forEach(input => {
            input.addEventListener('change', function() {
                const index = this.dataset.index;
                items[index].unit_price = parseFloat(this.value);
                items[index].subtotal = items[index].quantity * items[index].unit_price;
                renderItems();
            });
        });

        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const index = this.dataset.index;
                items.splice(index, 1);
                renderItems();
            });
        });
    }
});
</script>
@endpush