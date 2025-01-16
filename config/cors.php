<?php

return [
    'paths' => ['*'], // Menerapkan CORS ke semua route
    'allowed_methods' => ['*'], // Semua metode HTTP diizinkan
    'allowed_origins' => ['*'], // Izinkan semua asal domain (gunakan * jika ingin menerima semua)
    'allowed_headers' => ['*'], // Semua header diizinkan
    'expose_headers' => [],
    'max_age' => 3600,
    'supports_credentials' => true, // Jika Anda menggunakan cookie atau otorisasi
];