/**
 * Handle profile photo preview when selected.
 */

$(document).on('change', '#profile_photo', function () {
  // Mengecek apakah user benar-benar sudah memilih file
  if (this.files && this.files[0]) {
    let reader = new FileReader();

    // Ketika file selesai dibaca, masukkan ke src dari tag img
    reader.onload = function (e) {
      $('#profile-photo-preview').attr('src', e.target.result);
    }

    // Membaca file sebagai URL data
    reader.readAsDataURL(this.files[0]);
  }
});
