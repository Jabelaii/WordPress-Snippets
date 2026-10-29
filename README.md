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

Minimum PHP 7.4, WP 5.8 (untuk WebP).
