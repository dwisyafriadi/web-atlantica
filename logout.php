<?php
session_start();

// Hancurkan semua sesi
session_unset();
session_destroy();

// Arahkan ke halaman login
echo "<script>alert('You are successfully logged out'); window.location.href = 'index.html';</script>";
exit();
?>
