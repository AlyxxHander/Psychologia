import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/css/style.css',
        'resources/js/app.js',
        'resources/js/tinymce.js',
        'resources/js/layouts/base_js.js',
        'resources/js/landing/contact_us_js.js',
        'resources/js/linked/toggle_js.js',
        'resources/js/linked/faq_js.js',
        'resources/js/linked/notification_js.js',
        'resources/js/linked/logout_js.js',
        'resources/js/linked/user_profile_js.js',
        'resources/js/admin/new_member_form_js.js',
        'resources/js/admin/edit_profile_js.js',
        'resources/js/admin/new_article_form_js.js',
      ],
      refresh: true,
    }),
    tailwindcss(),
  ],
  server: {
    watch: {
      ignored: ['**/storage/framework/views/**'],
    },
  },
});
