<?php
// Konfigurasi koneksi
$serverName = "dbaop.prority-network.tech"; // Ganti dengan nama server SQL Server Anda
$database = "AT_AccountDB"; // Ganti dengan nama database yang ingin diakses
$username = "sa"; // Ganti dengan username SQL Server Anda
$password = "Admin001"; // Ganti dengan password SQL Server Anda

// Buat DSN secara dinamis
$dsn = "Driver={SQL Server};Server=$serverName;Database=$database;";

// Koneksi ke SQL Server menggunakan ODBC
$conn = odbc_connect($dsn, $username, $password);

// Periksa koneksi
if (!$conn) {
	die("Koneksi ke SQL Server gagal: " . odbc_errormsg());
}

// Anda bisa menambahkan kode berikut jika ingin memeriksa koneksi
// echo "Koneksi ke SQL Server berhasil!";
?>
