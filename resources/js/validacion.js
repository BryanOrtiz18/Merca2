document.addEventListener('DOMContentLoaded', function () {
  const passwordInput = document.getElementById('passwordInput');
  const helpText = document.getElementById('passwordHelp');

  if (passwordInput && helpText) {
    passwordInput.addEventListener('input', function () {
      if (this.value.length < 8) {
        helpText.classList.remove('d-none');
      } else {
        helpText.classList.add('d-none');
      }
    });
  }
});
