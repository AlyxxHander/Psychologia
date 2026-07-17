/**
 * Toggle FAQ dropdown and update arrow icon.
 */
$(document).ready(function () {
  $(document).on('click', '.faq-container', function () {
    const $this = $(this);
    const $faqQuestion = $this.find('.faq-question');
    const $dropdown = $this.find('.faq-content');
    const $arrowIcon = $this.find('.dropdown-toggle').find('i');

    $faqQuestion.hasClass('rounded-xl') ? $faqQuestion.removeClass('rounded-xl').addClass('rounded-t-xl') : $faqQuestion.removeClass('rounded-t-xl').addClass('rounded-xl');
    $arrowIcon.toggleClass('-rotate-180');

    $dropdown.slideToggle(200, function () {
      $dropdown.hasClass('hidden') ? $dropdown.removeClass('hidden') : $dropdown.addClass('hidden');
    });
  });
});