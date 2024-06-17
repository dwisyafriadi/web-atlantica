<?php
// Periksa apakah sesi sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Memulai sesi jika belum dimulai
  }

// Periksa apakah sesi ID ada
  if (!isset($_SESSION['ID'])) {
    // Jika tidak ada sesi ID, arahkan ke halaman index.php
    header("Location: index.php");
    exit();
  }

  include 'connection.php';
// Ambil ID dari sesi
  $ID = $_SESSION['ID'];

// Koneksi ke SQL Server menggunakan ODBC
  $conn = odbc_connect($dsn, $username, $password);

// Periksa koneksi
  if ($conn) {
// Query untuk mengambil data pengguna berdasarkan ID
    $sql = "SELECT *
    FROM dbo.tbl_Account
    WHERE ID = ?";

// Bind parameter ke dalam query
    $params = array($ID);

// Eksekusi query dengan parameter
    $stmt = odbc_prepare($conn, $sql);
    $result = odbc_execute($stmt, $params);

    if ($result) {
// Fetch data
      $userData = odbc_fetch_array($stmt);
    } else {
      echo "Error executing query: " . odbc_errormsg($conn);
    }
  } else {
    echo "Koneksi ke SQL Server gagal: " . odbc_errormsg();
  }

// Tutup koneksi
  odbc_close($conn);
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <title>Welcome User</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
      body {
        font: 20px Montserrat, sans-serif;
        line-height: 1.8;
        background: url('assets/img/at-bg.jpg') no-repeat center center fixed; 
        background-size: cover;
      }
      .bg-1, .bg-2, .bg-3, .bg-4 {
        background: rgba(0, 0, 0, 0.7); 
        color: #ffffff;
        padding: 70px 0;
        border-radius: 10px;
        margin-bottom: 20px;
      }
      p {font-size: 16px;}
      .margin {margin-bottom: 45px;}
      .container-fluid {
        padding-top: 70px;
        padding-bottom: 70px;
      }
      .navbar {
        padding-top: 15px;
        padding-bottom: 15px;
        border: 0;
        border-radius: 0;
        margin-bottom: 0;
        font-size: 12px;
        letter-spacing: 5px;
      }
      .navbar-nav  li a:hover {
        color: #1abc9c !important;
      }
    </style>
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="#">Me</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">Change Password</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- First Container -->
    <div class="container-fluid bg-1 text-center">
      <h3 class="margin">Hello, <?php echo $ID; ?></h3>
      <img src="assets\img\player.png" class="img-responsive img-circle margin" style="display:inline" alt="Bird" width="350" height="350">
      <h3>Level User</h3>
    </div>

    <!-- Display User Data -->
    <div class="container-fluid bg-2 text-center">
      <h3 class="margin">User Details</h3>
      <?php if (isset($userData)): ?>
        <p>ID: <?php echo $userData['ID']; ?></p>
        <p>Register Date: <?php echo $userData['Reg_Date']; ?></p>
        <p>Last Login: <?php 
        if ($userData['LastConnect'] = 'NULL'){
          echo "Please login in game first";
        }else{
         echo $userData['LastConnect'];
       }

       ?></p>
       <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
       <p>LastCharName: <?php 
       if ($userData['LastConnect'] = 'NULL'){
        echo "Please login in game first";
      }else{
       echo $userData['LastCharName'];
     }

     ?></p>
     <?php else: ?>
      <p>No user data found.</p>
    <?php endif; ?>
  </div>

  <!-- Third Container (Grid) -->
  <div class="container-fluid bg-3 text-center">    
    <h3 class="margin">Want Donate ?</h3><br>
    <div class="row">
      <div class="col-sm-4">
        <p>10.000 Atlas Ore</p>
        <img src="assets\img\atlas.jpg" class="img-responsive margin" style="width:100%" alt="Image">
      </div>
      <div class="col-sm-4"> 
        <p>Weapon Legendary</p>
        <img src="assets\img\weapon.png" class="img-responsive margin" style="width:100%" alt="Image">
      </div>
      <div class="col-sm-4"> 
        <p>Mount</p>
        <img src="assets\img\mount.jpeg" class="img-responsive margin" style="width:100%" alt="Image">
      </div>
    </div>
  </div>

</body>
</html>
