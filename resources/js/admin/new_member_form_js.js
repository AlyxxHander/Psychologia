/**
 * Handle profile photo preview when selected.
 */

$(document).on('change', '#profile-photo-input', function () {
  // Check if user has a file uploaded
  if (this.files && this.files[0]) {
    let reader = new FileReader();

    // If file is finished reading, put it to the src of the img tag
    reader.onload = function (e) {
      $('#profile-photo-preview').attr('src', e.target.result);
      $('#preview-image-container').toggleClass('hidden');
      $('#upload-container').toggleClass('hidden');
    }

    // Read file as URL data
    reader.readAsDataURL(this.files[0]);
  }
});

$(document).on('click', '#remove-preview-btn', function () {
  $('#profile_photo').val('');
  $('#profile-photo-preview').attr('src', '');
  $('#upload-container').addClass('flex').removeClass('hidden');
  $('#preview-image-container').addClass('hidden').removeClass('flex');
});
