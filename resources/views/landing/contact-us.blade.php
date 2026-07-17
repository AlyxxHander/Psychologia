@extends('layouts.base')

@section('title', 'Contact Us')

@section('content')

<div>
  <div id="contact-us-section">
    <div id="main-contact-section" class="relative">
      <div>
        <div class="wobble-fade-in-effect px-0 md:px-20 2xl:px-50 py-20 flex flex-col justify-center bg-white text-center xl:text-start">
          <h1 class="gradient-text mb-3 font-extrabold text-4xl">Contact Us</h1>
          <p class="max-w-full xl:max-w-165 text-brand-text-primary">Punya pertanyaan, ide kolaborasi, atau ingin tahu lebih lanjut tentang kegiatan kami? Sampaikan pesan Anda dan mari bertumbuh Bersama dalam komunitas psikologi yang inklusif.</p>
        </div>
        <div class="px-0 md:px-20 2xl:px-50 py-20 flex flex-col justify-center lg:justify-start items-center xl:items-start bg-brand-main-bg">
          <div class="wobble-fade-in-effect w-full flex flex-col text-center xl:text-start">
            <p class="mb-2 font-bold text-2xl">Contact Information</p>
            <p class="mb-10 max-w-full xl:max-w-165 text-brand-text-primary">Tim admin kami siap membantu Anda di jam operasional. Silahkan pilih kanal komunikasi yang paling nyaman bagi Anda untuk mendapatkan respons cepat</p>
            <div class="gap-10 flex flex-col md:flex-row justify-center xl:justify-start xl:ml-40 items-center">
              <div class="flex flex-col items-center">
                <img src="{{ asset('assets/icons/phone-contact-icon.png') }}" class="h-9 mb-3 aspect-square">
                <label class="mb-1 font-bold">(+62) 821 5256 8929</label>
                <p>Contact Person</p>
              </div>
              <div class="flex flex-col items-center">
                <img src="{{ asset('assets/icons/email-contact-icon.png') }}" class="h-9 mb-3 aspect-square">
                <label class="mb-1 font-bold">lsopcumm@gmail.com</label>
                <p>Email</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <img src="{{ asset('assets/images/contact-us-images.png') }}" alt="Contact Us Image" class="hidden xl:block absolute top-1/2 right-10 2xl:right-50 -translate-y-1/2 max-w-100 w-100 object-cover z-20"/>
    </div>

    <div id="contact-support-section" class="invisible px-0 md:px-20 2xl:px-50 py-20 gap-10 flex flex-col lg:flex-row justify-between items-center lg:items-stretch">
      <div class="w-full max-w-140 max-h-155 lg:w-2/4 p-10 gap-4 flex flex-col rounded-2xl bg-brand-main-bg">
        <h1 class="gradient-text mb-2 text-3xl">Get in Touch!</h1>
        <p>Isi detail di bawah untuk memulai kolaborasi atau menanyakan tentang program terbaru kami.</p>
        <form id="contact-form" class="w-full gap-4 flex flex-col">
          @csrf
          <input id="email" name="email" type="email" placeholder="Email Anda" class="px-6 py-3 rounded-3xl border-2 border-brand-border"/>
          <input id="nama" name="nama" type="text" placeholder="Nama Anda" class="px-6 py-3 rounded-3xl border-2 border-brand-border"/>
          <textarea id="pesan" name="pesan" placeholder="Pesan Anda" class="px-6 py-3 h-60 rounded-3xl border-2 border-brand-border resize-none"></textarea>
          <button type="submit" class="btn gradient-bg hover:scale-105 w-1/2 px-6 py-3">Submit</button>
        </form>
      </div>

      <div class="max-w-140 w-full lg:w-2/4 flex flex-col justify-between">
        <div class="mb-10 lg:mb-0 gap-5 flex flex-col justify-between">
          <h1 class="mb-4 text-3xl font-extrabold">Frequently Asked Questions</h1>
          <div class="faq-container flex flex-col justify-between text-brand-text-tertiary hover:text-brand-gradient-200 rounded-2xl drop-shadow-stone-400/60 drop-shadow transition-all duration-300 cursor-pointer">
            <div class="faq-question px-5 py-1 flex flex-row justify-between items-center bg-brand-main-bg rounded-xl">
              <label class="mr-5 font-semibold text-sl cursor-pointer">
                Kapan pendaftaran Staff ahli dan Staff muda baru dibuka?
              </label>
              <button class="dropdown-toggle mb-2 font-bold text-xl cursor-pointer">
                <i class="fa-solid fa-angle-down transition-all duration-200"></i>
              </button>
            </div>
            <div class="faq-content hidden px-5 py-3 bg-brand-main-bg brightness-93 rounded-b-xl">
              <p class="text-brand-text-primary cursor-pointer">
                Pendaftaran dibuka pada bulan september, stay tune terus yaa!
              </p>
            </div>
          </div>

          <div class="faq-container flex flex-col justify-between text-brand-text-tertiary hover:text-brand-gradient-200 rounded-2xl drop-shadow-stone-400/60 drop-shadow transition-all duration-300 cursor-pointer">
            <div class="faq-question px-5 py-1 flex flex-row justify-between items-center bg-brand-main-bg rounded-xl">
              <label class="mr-5 font-semibold text-sl cursor-pointer">
                Bagaimana cara berkolaborasi atau mengundang LSO sebagai Media Partner?
              </label>
              <button class="dropdown-toggle mb-2 font-bold text-xl text-brand-text-tertiary hover:text-brand-gradient-200 cursor-pointer">
                <i class="fa-solid fa-angle-down transition-all duration-200"></i>
              </button>
            </div>
            <div class="faq-content hidden px-5 py-3 bg-brand-main-bg brightness-93 rounded-b-xl">
              <p class="text-brand-text-primary">
                Untuk menjadi Media Partner, kamu dapat menghubungi kami melalui nomor Whatsapp yang tertera.
              </p>
            </div>
          </div>

          <div class="faq-container flex flex-col justify-between text-brand-text-tertiary hover:text-brand-gradient-200 rounded-2xl drop-shadow-stone-400/60 drop-shadow transition-all duration-300 cursor-pointer">
            <div class="faq-question px-5 py-1 flex flex-row justify-between items-center bg-brand-main-bg rounded-xl">
              <label class="mr-5 font-semibold text-sl cursor-pointer">
                Apakah ada syarat khusus untuk bergabung?
              </label>
              <button class="dropdown-toggle mb-2 font-bold text-xl cursor-pointer">
                <i class="fa-solid fa-angle-down transition-all duration-200"></i>
              </button>
            </div>
            <div class="faq-content hidden px-5 py-3 bg-brand-main-bg brightness-93 rounded-b-xl">
              <div class="flex flex-col text-brand-text-primary">
                <span class="font-semibold">Staff Ahli</span>
                <span>1. Mahasiswa aktif Fakultas Psikologi Universitas Muhammadiyah Malang (Maksimal pada semester 3 dan sudah menjadi anggota Psychology Club pada periode 2024/2025)</span>
                <span>2. Foto KTM /E-KTM</span>
                <span>3. Mengisi Formulir Pendaftaran</span>
                <span>4. Menulis Motivation Letter</span>
                <span>5. Wajib mengikuti screening sesuai dengan jadwal yang telah tersedia</span>

                <span class="mt-4 font-semibold">Staff Muda</span>
                <span>1. Mahasiswa aktif Fakultas Psikologi Universitas Muhammadiyah Malang (Angkatan 2024 & 2025)</span>
                <span>2. Foto KTM /E-KTM</span>
                <span>3. Mengisi Formulir Pendaftaran</span>
                <span>4. Menulis Motivation Letter</span>
                <span>5. Wajib mengikuti screening sesuai dengan jadwal yang telah tersedia</span>  
              </div>
            </div>
          </div>
        </div>

        <div class="mt-5 gap-6 flex flex-col items-center lg:items-start">
          <h2 class="text-2xl font-bold">Social Media</h2>
          <div class="gap-3 flex flex-col sm:flex-row">
            <a href="https://www.instagram.com/psychologyclubumm?igsh=cjJ4NTN0ZDd5dGp0" target="_blank">
              <img src="{{ asset('assets/icons/instagram-contact-icon.png') }}" class="h-10 object-cover cursor-pointer transition-all duration-300 hover:scale-105"/>
            </a>
            <a href="https://www.tiktok.com/@psychologyclubumm?_r=1&_t=ZS-97NyvHcBwSf" target="_blank">
              <img src="{{ asset('assets/icons/tiktok-contact-icon.png') }}" class="h-10 object-cover cursor-pointer transition-all duration-300 hover:scale-105"/> 
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@vite(['resources/js/landing/contact_us_js.js', 'resources/js/linked/faq_js.js'])

@endsection 
