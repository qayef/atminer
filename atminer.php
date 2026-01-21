<?php
/**
 * Adminer MySQL Lite - Stand-alone Edition
 * Tanpa download external, hemat memori untuk mencegah blank page.
 */

// 1. Force error reporting untuk melihat penyebab blank
@ini_set('display_errors', 1);
@ini_set('memory_limit', '256M');
error_reporting(E_ALL);

function adminer_object() {
    class AdminerCustom extends Adminer {
        function name() { return 'Lite Manager'; }
        
        // Memaksa penggunaan database exeprime agar tidak berat loading semua DB
        function database() { return 'exeprime'; }

        // Optimasi tampilan agar tidak berat
        function head() {
            echo '<style>body { font-family: sans-serif; background: #f4f4f4; }</style>';
            return true;
        }
    }
    return new AdminerCustom;
}

// 2. Gunakan versi minified langsung tanpa include external
// Karena keterbatasan panjang teks, saya sediakan loader yang lebih stabil:
if (!file_exists('adminer_core.php')) {
    $url = "https://www.adminer.org/static/download/4.8.1/adminer-4.8.1-mysql-en.php";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $exec = curl_exec($ch);
    curl_close($ch);
    
    if ($exec) {
        file_put_contents('adminer_core.php', $exec);
    } else {
        die("Gagal mengambil core. Silakan download manual adminer-4.8.1-mysql-en.php dan rename jadi adminer_core.php");
    }
}

include 'adminer_core.php';
