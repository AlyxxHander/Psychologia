// Tags variable
let tags = [];

/**
 * Initialize tags
 * INPUT: Livewire is ready
 */
function init() {
  // Get existing tags from database
  const existingTags = $('#tags').val();
  if (existingTags) {
    try {
      tags = JSON.parse(existingTags);
    } catch (e) {
      console.error("Gagal melakukan parse pada data tags awal", e);
    }
  }
  renderTags();
}

/**
 * Render tags to the DOM
 */
function renderTags() {
  $('#tags-container').empty();
  $.each(tags, function (index, tag) {
    $('#tags-container').append(`
      <div class="bg-brand-gradient-200 text-white rounded-full px-4 py-1 flex items-center gap-2">
        #${tag}
        <button
          type="button"
          class="remove-tag-btn"
          data-index="${index}">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
    `);
  });

  // Update hidden input whenever the UI tags change (add/remove)
  $('#tags').val(JSON.stringify(tags));
}

/**
 * Remove tag from array
 * INPUT: Click on '.remove-tag-btn' button inside the tag
 */
$(document).on('click', '.remove-tag-btn', function () {
  // Get the index of the tag to remove
  const index = $(this).data('index');
  // Remove the tag from the array
  tags.splice(index, 1);

  // Render ulang UI
  renderTags();
});

/**
 * Add a tag to the tags array.
 * INPUT: Click '#add-tag-btn'
 */
$(document).on('click', '#add-tag-btn', function () {
  const inputValue = $('#tag-input').val().trim();
  if (inputValue === '') {
    return;
  }

  // Check duplicate (case-insensitive)
  let exists = tags.some(tag =>
    tag.toLowerCase() === inputValue.toLowerCase()
  );
  if (exists) {
    $('#tag-input').val('');
    return;
  }

  // Add tag to the array
  tags.push(inputValue);
  renderTags();
  $('#tag-input').val('');
});

/**
 * Add a tag to the tags array when the Enter key is pressed.
 * INPUT: Press Enter key on '#tag-input'
 */
$(document).on('keydown', '#tag-input', function (e) {
  if (e.key === 'Enter') {
    e.preventDefault();
    $('#add-tag-btn').click();
  }
});

/**
 * Handle profile photo preview when selected.
 */
$(document).on('change', '#article-thumbnail-input', function () {
  // Check if user has a file uploaded
  if (this.files && this.files[0]) {
    let reader = new FileReader();
    // If file is finished reading, put it to the src of the img tag
    reader.onload = function (e) {
      $('#thumbnail-preview').attr('src', e.target.result);
      $('#thumbnail-preview-container').toggleClass('hidden');
      $('#upload-container').toggleClass('hidden');
    }
    // Read file as URL data
    reader.readAsDataURL(this.files[0]);
  }
});

/**
 * Remove the preview of the article thumbnail.
 * INPUT: Click '#remove-preview-btn'
 */
$(document).on('click', '#remove-preview-btn', function () {
  $('#article-thumbnail-input').val('');
  $('#thumbnail-preview').attr('src', '');
  $('#upload-container').addClass('flex').removeClass('hidden');
  $('#thumbnail-preview-container').addClass('hidden').removeClass('flex');
});

/**
 * Initialize tags
 * INPUT: Livewire is ready
 */
$(document).on('livewire:navigated', function () {
  init();
});

/**
 * Initialize tags when the page is loaded
 */
$(document).ready(function () {
  init();
});