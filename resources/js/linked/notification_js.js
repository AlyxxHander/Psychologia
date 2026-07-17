/**
 * Trigger a toast notification.
 * @param {string} type Type of toast ('toast_success', 'toast_error', 'toast_info').
 * @param {string} message Message to display in toast.
 */
export function triggerToast(type, message) {
  if ($('#toast-container').children().length > 0) return;

  const id = 'toast-' + Date.now();
  const toastHTML = `
    <div id="${id}" class="toast ${type}">
      <div class="flex items-center gap-2 text-white">
        ${type === 'toast_success' ? '✅' : type === 'toast_error' ? '❌' : 'ℹ️'}
        <span>${message}</span>
      </div>
    </div>
  `;
  $('#toast-container').append(toastHTML);

  // Slide in
  setTimeout(() => $(`#${id}`).addClass('show'), 10);
  // Auto hide and remove after 3s
  setTimeout(() => {
    $(`#${id}`).removeClass('show');
    setTimeout(() => $(`#${id}`).remove(), 300);
  }, 3000);
}

// Make globally available for inline scripts in Blade
window.triggerToast = triggerToast;