<?php
/**
 * Adminer MySQL Lite - Clean Version
 * Tanpa kredensial hardcoded. Mendukung login manual.
 */

function adminer_object() {
    class AdminerCustom extends Adminer {
        // Memberikan nama khusus pada interface
        function name() {
            return 'MySQL Lite Manager';
        }

        // Fungsi ini bisa dikosongkan untuk membiarkan user mengisi form secara manual
        function credentials() {
            // Mengembalikan nilai dari form input (server, user, password)
            return array($_GET["server"], $_GET["username"], "");
        }
    }
    return new AdminerCustom;
}

// Mengambil core Adminer versi MySQL-only jika belum ada di server
if (!file_exists('adminer_core.php')) {
    $core_url = 'https://www.adminer.org/static/download/4.8.1/adminer-4.8.1-mysql-en.php';
    $core_content = file_get_contents($core_url);
    if ($core_content) {
        file_put_contents('adminer_core.php', $core_content);
    } else {
        die("Gagal mengunduh core Adminer. Pastikan server Anda memiliki akses internet.");
    }
}

include 'adminer_core.php';
