/**
 * Listen for click event on the logout button
 */
$(document).ready(function () {
  $(document).on('click', '.logout-btn', function (e) {
    e.preventDefault();

    const $form = $('.logout-form');
    if ($form.length) $form.submit();
  });
});
