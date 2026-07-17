/**
 * ==========================================================
 * Contact Form
 * ==========================================================
 * Open email draft in user's email application.
 */
const receiverEmail = 'lsopcumm@gmail.com';

$(document).on('submit', '#contact-form', function (e) {
  e.preventDefault();

  const name = $('#nama').val().trim();
  const email = $('#email').val().trim();
  const message = $('#pesan').val().trim();
  if (!name || !email || !message) {
    alert('Mohon lengkapi seluruh data terlebih dahulu.');
    return;
  }

  /**
   * Determine greeting based on time
   */
  const currentHour = new Date().getHours();
  let greeting = 'Selamat malam';
  if (currentHour >= 5 && currentHour < 11) {
    greeting = 'Selamat pagi';
  }
  else if (currentHour >= 11 && currentHour < 15) {
    greeting = 'Selamat siang';
  }
  else if (currentHour >= 15 && currentHour < 18) {
    greeting = 'Selamat sore';
  }

  const subject = `Pertanyaan / Kolaborasi dari ${name}`;
  const body =
    `${greeting},
    Perkenalkan, nama saya ${name}.

    ${message}

    Apabila diperlukan informasi lebih lanjut, saya dapat dihubungi melalui alamat email yang saya gunakan untuk mengirim pesan ini.
    Terima kasih atas perhatian dan waktunya. Saya menantikan balasan dari tim LSO Psychology Club.

    ${name}
    ${email}`;

  /**
   * Open email draft in user's email application
   */
  const gmailUrl = `https://mail.google.com/mail/?view=cm&fs=1&to=${encodeURIComponent(receiverEmail)}&su=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
  window.open(gmailUrl, '_blank');
});