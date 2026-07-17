<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Faq::truncate();

    $faqs = [
      [
        'type' => 'articles',
        'question' => 'Bagaimana cara mempublikasikan artikel baru?',
        'answer' => "1) Tekan tombol 'Articles' yang ada di Side Menu Admin sebelah kiri layar. 2) Tekan tombol 'Add New Articles'. 3) Isi data yang relevan. 4) Tekan tombol 'Save as Draft'.",
      ],
      [
        'type' => 'articles',
        'question' => 'Apa perbedaan status Published, Draft, dan Archived?',
        'answer' => "Draft adalah status yang menunjukkan bahwa artikel masih dalam proses pembuatan sehingga belum dapat dilihat oleh publik. Published menunjukkan bahwa artikel telah siap ditampilkan kepada publik. Archived digunakan untuk artikel yang sudah tidak relevan namun masih ingin disimpan agar dapat dipublikasikan kembali di kemudian hari dengan mengubah statusnya menjadi Published.",
      ],
      [
        'type' => 'member_managements',
        'question' => 'Bagaimana cara menambahkan data pengurus baru?',
        'answer' => "1) Tekan tombol 'Manage Members' pada Side Menu Admin. 2) Pilih 'Add New Members'. 3) Isi seluruh data yang diperlukan. 4) Tekan tombol 'Add Member'.",
      ],
      [
        'type' => 'member_managements',
        'question' => 'Bagaimana cara menghapus atau menonaktifkan anggota?',
        'answer' => "1) Masuk ke menu 'Manage Members'. 2) Cari anggota yang ingin dihapus. 3) Tekan tombol bergambar ikon tong sampah pada kolom 'Actions'. 4) Konfirmasi dengan menekan tombol 'OK' saat dialog konfirmasi muncul.",
      ],
      [
        'type' => 'account_safety',
        'question' => 'Bagaimana cara mengubah password atau kata sandi?',
        'answer' => "1) Masuk ke menu 'Edit Profile' pada Side Menu Admin. 2) Isi kolom 'Current Password', 'New Password', dan 'Confirm New Password'. 3) Simpan perubahan.",
      ],
      [
        'type' => 'quick_faqs',
        'question' => 'Berapa ukuran maksimal foto untuk artikel?',
        'answer' => 'Ukuran maksimal gambar thumbnail artikel adalah 2 MB (2048 KB).',
      ],
      [
        'type' => 'quick_faqs',
        'question' => 'Mengapa artikel saya tidak muncul di halaman utama?',
        'answer' => "Kemungkinan artikel masih berstatus Draft. Artikel dengan status Draft tidak ditampilkan kepada publik. Untuk menampilkannya, ubah status artikel menjadi Published melalui halaman Edit Article.",
      ],
    ];

    foreach ($faqs as $faq) {
      Faq::create($faq);
    }
  }
}