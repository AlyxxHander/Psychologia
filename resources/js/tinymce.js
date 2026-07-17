function initializeTinyMCE() {
  const textarea = document.querySelector('#content');
  if (!textarea) return;

  if (tinymce.get('content')) tinymce.get('content').remove();
  tinymce.init({
    selector: '#content',
    height: 600,
    menubar: true,
    branding: false,
    promotion: false,
    resize: false,
    plugins: [
      'advlist',
      'autolink',
      'lists',
      'link',
      'image',
      'table',
      'code', // Note to meself: Dont forget to delete this line before production
      'preview',
      'wordcount'
    ],

    toolbar:
      'undo redo | ' +
      'blocks | ' +
      'bold italic underline | ' +
      'alignleft aligncenter alignright alignjustify | ' +
      'bullist numlist | ' +
      'link image table | ' +
      'code preview' // Note to meself: Dont forget to delete this line before production
  });
};

$(document).on('livewire:navigated', initializeTinyMCE);