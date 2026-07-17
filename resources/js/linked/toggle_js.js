/**
 * Toggle password visibility
 */
$(document).on('click', '.toggle-password', function () {
  const $passwordField = $('.password-input');
  const $icon = $('.toggle-password-icon');
  const newType = $passwordField.attr('type') === 'password' ? 'text' : 'password';

  $passwordField.attr('type', newType);
  $icon.toggleClass('fa-eye-slash fa-eye');
});