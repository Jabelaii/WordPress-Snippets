# WordPress-Snippets
Collection of custom WordPress code snippets for themes, plugins, and performance optimization.

Snippet yang kepake berulang di project WordPress & WooCommerce, dikumpulin di sini biar ga nyari-nyari lagi di functions.php project lama. Kebanyakan buat toko online lokal (no HP, WA, ongkir, dst).

Tiap file berdiri sendiri, tinggal copy ke `functions.php` theme atau ke plugin seperti Code Snippets. Semua pakai prefix `wps_`, header tiap file ada penjelasan kenapa dan cara pakainya. Test di staging dulu, beberapa snippet (REST, cart fragments) bisa bentrok sama plugin tertentu.

## admin/
- `clean-dashboard.php` – Bersihin dashboard wp-admin: buang widget bawaan + welcome panel
- `custom-admin-color.php` – Warna admin bar beda per environment biar ga salah edit di production
- `custom-admin-footer.php` – Ganti teks footer di wp-admin ("Thank you for creating with WordPress")
- `disable-comments.php` – Matiin komentar di seluruh site
- `duplicate-post.php` – Duplicate post/page/produk dari list admin tanpa plugin
- `featured-image-column.php` – Kolom thumbnail di list post & page di admin
- `hide-update-notices.php` – Sembunyikan notifikasi update (core, plugin, theme) dari user non-admin
- `login-logo.php` – Login page: ganti logo WP dengan logo site (Customizer > Site Identity),
- `post-state-label.php` – Label di list page buat halaman penting (kayak "Front Page" bawaan WP)
- `remove-image-title-attribute.php` – Remove title attribute from attachment images
- `remove-menus-for-editor.php` – Sembunyikan menu yang ga perlu dari role selain administrator

## editor/
- `disable-gutenberg.php` – Disable Gutenberg, balik ke classic editor tanpa plugin

## media/
- `auto-image-alt.php` – Isi alt text otomatis dari nama file pas upload
- `convert-upload-to-webp.php` – Convert JPG/PNG jadi WebP saat upload, sekalian resize kalau kegedean
- `limit-uploads.php` – Batasi upload: maksimal ukuran file dan tipe yang boleh

## performance/
- `clean-head.php` – Buang hal-hal yang ga perlu dari <head>: emoji script, RSD/WLW link,
- `dashicons-guests.php` – Dashicons (~45KB CSS) cuma kepake di admin bar. Buat yang belum login
- `defer-scripts.php` – Tambah `defer` ke semua script frontend kecuali jQuery dan yang di-skip
- `disable-embeds.php` – Matiin oEmbed (wp-embed.min.js) & jQuery Migrate
- `disable-wp-cron.php` – WP-Cron jalan tiap ada pengunjung, bikin request pertama lambat
- `limit-heartbeat.php` – Heartbeat API: matiin di frontend & dashboard, di editor kasih interval 60s
- `limit-revisions.php` – Batasi revisi post jadi 5 dan autosave jadi 2 menit

## security/
- `block-user-enumeration.php` – Tutup REST API user enumeration (/wp-json/wp/v2/users) dan ?author=N
- `block-wp-admin-non-admin.php` – Customer/subscriber ga bisa buka wp-admin, dilempar ke home
- `disable-file-editor.php` – Matiin editor file theme/plugin di wp-admin (Appearance > Theme File Editor)
- `disable-rest-for-guests.php` – REST API cuma buat yang login. Hati-hati: Contact Form 7, Woo Blocks,
- `disable-xmlrpc.php` – Matiin XML-RPC (xmlrpc.php). Sering jadi target brute force,
- `limit-login-attempts.php` – Limit login attempts tanpa plugin. 5x salah dari IP yang sama = blok 15 menit
- `security-headers.php` – Header keamanan dasar. Idealnya di nginx/htaccess, tapi kalau ga punya

## woocommerce/
- `add-to-cart-text.php` – ganti teks tombol Add to cart
- `checkout-fields.php` – rapihin field checkout
- `custom-order-status.php` – Status order custom "Dikirim" (wc-shipped). Default Woo cuma Processing -> Completed,
- `disable-assets-non-shop.php` – matiin cart fragments (wc-ajax=get_refreshed_fragments)
- `disable-password-strength.php` – Matiin password strength meter di register/checkout
- `disable-reviews.php` – matiin review produk total
- `empty-cart-button.php` – tombol "Kosongkan Keranjang" di halaman cart
- `free-shipping-notice.php` – notice "Belanja Rp X lagi buat gratis ongkir" di cart & checkout
- `hide-coupon-field.php` – sembunyikan form kupon di cart & checkout
- `hide-price-for-guests.php` – harga & tombol beli cuma buat yang login (B2B / reseller)
- `hide-shipping-when-free.php` – kalau gratis ongkir udah kena, sembunyikan metode lain
- `login-redirect-my-account.php` – customer yang login dari wp-login.php dilempar ke My Account,
- `low-stock-label.php` – "Sisa 3 lagi!" di halaman produk kalau stok tinggal dikit
- `min-order-amount.php` – minimum belanja sebelum bisa checkout
- `order-number-prefix.php` – nomor order pakai prefix + padding, misal INV-000123
- `order-status-whatsapp-link.php` – link WhatsApp ke customer di halaman detail order admin,
- `order-tracking-number.php` – Field nomor resi di order admin, ikut masuk ke email "Completed" dan
- `out-of-stock-last.php` – produk habis ditaruh paling bawah di shop & kategori
- `product-custom-field.php` – field tambahan di produk (tab General) yang tampil di frontend
- `products-per-page.php` – jumlah produk per halaman & kolom di shop
- `product-tabs.php` – atur tab di halaman produk
- `sale-badge-percent.php` – badge "Sale!" diganti jadi persen diskon, misal "-25%"
- `skip-cart-to-checkout.php` – redirect ke checkout langsung setelah add to cart,
- `sku-in-loop.php` – tampilin SKU di list produk & di cart
- `validate-phone-id.php` – validasi nomor HP Indonesia di checkout
- `whatsapp-button.php` – tombol "Tanya via WhatsApp" di halaman produk

## misc/
- `allow-shortcodes-in-widgets.php` – Shortcode jalan di widget text, excerpt, dan menu item label
- `body-class-extras.php` – Tambah class di <body>: slug halaman, nama browser, login/guest
- `custom-404-log.php` – Catat URL yang kena 404 ke option, lihat di Tools > 404 Log
- `disable-search.php` – Matiin fitur search total. Buat landing page / company profile yang
- `disable-self-pingback.php` – WP ngirim pingback ke diri sendiri tiap kita link ke post sendiri
- `disable-update-emails.php` – Matiin email notifikasi auto-update (core, plugin, theme) dan
- `excerpt-length.php` – Panjang excerpt & teks "read more"
- `google-analytics.php` – Pasang GA4 / GTM tanpa plugin. Isi salah satu, admin yang login ga ditrack
- `last-updated.php` – Tampilin "Diperbarui: 12 Jan 2026" kalau post pernah diedit setelah publish
- `maintenance-mode.php` – Maintenance mode sederhana tanpa plugin
- `phone-link-shortcode.php` – [tel number="081234567890"] -> link tel: yang bisa diklik di HP
- `reading-time.php` – Estimasi waktu baca: [reading_time] atau wps_reading_time() di template
- `redirect-attachment-pages.php` – Halaman attachment (domain.com/nama-gambar/) itu thin content, Yoast selalu
- `register-cpt.php` – Template register custom post type + taxonomy. Ganti 'portfolio' & label
- `search-include-cpt.php` – Hasil search include custom post type & produk, exclude page
- `smtp-settings.php` – Kirim email lewat SMTP tanpa plugin WP Mail SMTP
- `year-shortcode.php` – Shortcode [year] buat copyright di footer biar ga perlu diedit tiap tahun

Minimum PHP 7.4, WP 5.8 (untuk WebP). Semua lolos php -l.
