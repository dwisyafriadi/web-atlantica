<?php
session_start();
include 'connection.php';

// Periksa koneksi
if ($conn) {
    echo "Koneksi ke SQL Server berhasil!<br>";

    // Ambil username dari form
    $ID = $_POST['username'];

    // Query untuk memeriksa apakah ID sudah digunakan
    $checkSql = "SELECT ID FROM dbo.tbl_Account WHERE ID = ?";
    $checkStmt = odbc_prepare($conn, $checkSql);
    $checkParams = array($ID);
    $checkResult = odbc_execute($checkStmt, $checkParams);

    // Periksa hasil pengecekan
    if (odbc_fetch_row($checkStmt)) {
        // Jika ID sudah digunakan, tampilkan alert
        echo "<script>alert('ID \"$ID\" sudah digunakan. Silakan gunakan ID lain.'); window.location.href = 'register.php';</script>";
    } else {
        // Jika ID belum digunakan, lanjutkan dengan proses INSERT

        // Contoh data untuk di-insert
        $password = md5($_POST['password']); // Hash password dengan MD5

        // Query INSERT tanpa menyertakan IDNum
        $insertSql  = "INSERT INTO dbo.tbl_Account (ID, Password, ChannelIndex, Reg_Date, SSN)
        VALUES (?, ?, 130, GETDATE(), '1111111111111')";

        // Bind parameter ke dalam query
        $params = array($ID, $password);

        // Eksekusi query INSERT dengan parameter
        $insertStmt = odbc_prepare($conn, $insertSql);
        if ($insertStmt) {
            $insertResult = odbc_execute($insertStmt, $params);

            // Periksa apakah query berhasil dieksekusi
            if ($insertResult) {
                // Simpan ID ke dalam sesi
                $_SESSION['ID'] = $ID;

                // Tampilkan alert menggunakan JavaScript dan redirect ke halaman landing.php setelah tombol OK ditekan
                echo "<script>alert('Berhasil mendaftar'); window.location.href = 'landing.php';</script>";
                exit; // Penting untuk menghentikan eksekusi script setelah redirect
            } else {
                echo "Error executing INSERT query: " . odbc_errormsg($conn);
            }
        } else {
            echo "Error preparing INSERT query: " . odbc_errormsg($conn);
        }
    }
} else {
    echo "Koneksi ke SQL Server gagal: " . odbc_errormsg();
}

// Tutup koneksi
odbc_close($conn);

?>
