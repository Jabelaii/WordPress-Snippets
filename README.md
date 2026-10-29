# WordPress-Snippets
Collection of custom WordPress code snippets for themes, plugins, and performance optimization.

Tiap file berdiri sendiri, tinggal copy ke `functions.php` theme atau ke plugin seperti Code Snippets.

## admin/
- `clean-dashboard.php` – buang widget dashboard bawaan dan welcome panel
- `custom-admin-footer.php` – ganti teks footer wp-admin
- `disable-comments.php` – matiin komentar total (frontend + admin menu)
- `duplicate-post.php` – link "Duplicate" di list post/page/produk, meta & taxonomy ikut
- `hide-update-notices.php` – sembunyikan notif update dari user non-admin
- `login-logo.php` – logo site di halaman login (ambil dari Customizer)
- `remove-image-title-attribute.php` – hapus attribute `title` di gambar attachment

## editor/
- `disable-gutenberg.php` – classic editor tanpa plugin, sekalian dequeue CSS block

## media/
- `convert-upload-to-webp.php` – auto convert JPG/PNG ke WebP + resize saat upload. Quality & ukuran max bisa diatur lewat filter, lihat komentar di file.
- `limit-uploads.php` – batas ukuran gambar 2MB, izinin webp, svg cuma buat admin

## performance/
- `clean-head.php` – buang emoji script, rsd/wlw/shortlink, versi WP dari `<head>` dan query string asset
- `limit-heartbeat.php` – heartbeat off di frontend/dashboard, 60s di editor
- `limit-revisions.php` – max 5 revisi, autosave tiap 2 menit

## security/
- `block-user-enumeration.php` – tutup `/wp-json/wp/v2/users` dan `?author=N`, pesan login generik
- `disable-file-editor.php` – matiin theme/plugin file editor di wp-admin
- `disable-xmlrpc.php` – matiin xmlrpc.php + header X-Pingback

## woocommerce/
- `checkout-fields.php` – buang company/address 2, no HP wajib & jadi "No. WhatsApp", default negara ID
- `disable-assets-non-shop.php` – buang cart fragments & CSS/JS Woo di halaman non-toko
- `free-shipping-notice.php` – "belanja Rp X lagi buat gratis ongkir" di cart/checkout
- `min-order-amount.php` – minimum belanja sebelum checkout
- `order-number-prefix.php` – nomor order jadi INV-000123
- `sale-badge-percent.php` – badge Sale! jadi -25%
- `skip-cart-to-checkout.php` – add to cart langsung ke checkout
- `whatsapp-button.php` – tombol "Tanya via WhatsApp" di halaman produk

## misc/
- `disable-update-emails.php` – matiin email auto-update & password change
- `maintenance-mode.php` – 503 buat pengunjung, admin tetap bisa akses
- `reading-time.php` – `[reading_time]` / `wps_reading_time()`
- `year-shortcode.php` – `[year]` buat copyright footer

Minimum PHP 7.4, WP 5.8 (untuk WebP).
