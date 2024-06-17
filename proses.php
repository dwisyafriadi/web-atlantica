<?php
session_start();

include 'connection.php';

// Fungsi untuk melakukan alter user jika level master adalah 120
function alterUserIfNeeded($conn, $ID) {
    $checkLevelSql = "SELECT MasterLevel FROM dbo.tbl_Account WHERE ID = ?";
    $checkLevelStmt = odbc_prepare($conn, $checkLevelSql);
    $checkLevelParams = array($ID);
    $checkLevelResult = odbc_execute($checkLevelStmt, $checkLevelParams);

    if ($checkLevelResult) {
        if (odbc_fetch_row($checkLevelStmt)) {
            $level = odbc_result($checkLevelStmt, "MasterLevel");
            if ($level == 120) {
                // Lakukan alter user
                $alterSql = "UPDATE dbo.tbl_Account SET MasterLevel = 0 WHERE ID = ?";
                $alterStmt = odbc_prepare($conn, $alterSql);
                $alterParams = array($ID);
                $alterResult = odbc_execute($alterStmt, $alterParams);

                if ($alterResult) {
                    echo "User level has been altered successfully.";
                } else {
                    echo "Error altering user level: " . odbc_errormsg($conn);
                }
            }
        }
    } else {
        echo "Error checking user level: " . odbc_errormsg($conn);
    }
}

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa username dan password
    $loginSql = "SELECT ID, Password FROM dbo.tbl_Account WHERE ID = ? AND Password = ?";
    $loginStmt = odbc_prepare($conn, $loginSql);
    $loginParams = array($ID, md5($password)); // Gunakan MD5 untuk membandingkan password yang di-hash
    $loginResult = odbc_execute($loginStmt, $loginParams);

    if ($loginResult && odbc_fetch_row($loginStmt)) {
        // Jika login berhasil
        $_SESSION['ID'] = $ID;

        // Memeriksa level master
        alterUserIfNeeded($conn, $ID);

        // Redirect ke halaman landing.php
        header("Location: landing.php");
        exit();
    } else {
       echo "<script>alert('Wrong Username and Password'); window.location.href = 'login.php';</script>";
   }
}

// Tutup koneksi
odbc_close($conn);
?>