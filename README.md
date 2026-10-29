# WordPress-Snippets
Collection of custom WordPress code snippets for themes, plugins, and performance optimization.

Tiap file berdiri sendiri, tinggal copy ke `functions.php` theme atau ke plugin seperti Code Snippets.

## admin/
- `clean-dashboard.php` – buang widget dashboard bawaan dan welcome panel
- `custom-admin-footer.php` – ganti teks footer wp-admin
- `disable-comments.php` – matiin komentar total (frontend + admin menu)
- `hide-update-notices.php` – sembunyikan notif update dari user non-admin
- `remove-image-title-attribute.php` – hapus attribute `title` di gambar attachment

## editor/
- `disable-gutenberg.php` – classic editor tanpa plugin, sekalian dequeue CSS block

## media/
- `convert-upload-to-webp.php` – auto convert JPG/PNG ke WebP + resize saat upload. Quality & ukuran max bisa diatur lewat filter, lihat komentar di file.
- `limit-uploads.php` – batas ukuran gambar 2MB, izinin webp, svg cuma buat admin

## performance/
- `clean-head.php` – buang emoji script, rsd/wlw/shortlink, versi WP dari `<head>` dan query string asset

## security/
- `block-user-enumeration.php` – tutup `/wp-json/wp/v2/users` dan `?author=N`, pesan login generik
- `disable-xmlrpc.php` – matiin xmlrpc.php + header X-Pingback

## woocommerce/
- `checkout-fields.php` – buang company/address 2, no HP wajib & jadi "No. WhatsApp", default negara ID
- `skip-cart-to-checkout.php` – add to cart langsung ke checkout
- `whatsapp-button.php` – tombol "Tanya via WhatsApp" di halaman produk

## misc/
- `maintenance-mode.php` – 503 buat pengunjung, admin tetap bisa akses
- `year-shortcode.php` – `[year]` buat copyright footer

Minimum PHP 7.4, WP 5.8 (untuk WebP).
