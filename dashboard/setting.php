<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: /login');
    exit;
}

$config_file = '../templates/core/config.php';
$config = include($config_file);

$success_message = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $config = include($config_file);

    $config['site_username'] = $_POST['site_username'] ?? $config['site_username'];
    $config['site_password'] = $_POST['site_password'] ?? $config['site_password'];
    $config['site_title'] = $_POST['site_title'] ?? $config['site_title'];
    $config['site_description'] = $_POST['site_description'] ?? $config['site_description'];
    $config['site_keywords'] = $_POST['site_keywords'] ?? $config['site_keywords'];
    $config['site_popunder'] = $_POST['site_popunder'] ?? $config['site_popunder'];
  	$config['site_socialbar'] = $_POST['site_socialbar'] ?? $config['site_socialbar'];
  	$config['site_directads'] = $_POST['site_directads'] ?? $config['site_directads'];
    $config['site_adsterra'] = $_POST['site_adsterra'] ?? $config['site_adsterra'];
  	$config['site_histatsjs'] = $_POST['site_histatsjs'] ?? $config['site_histatsjs'];

    if (file_put_contents($config_file, "<?php\nreturn " . var_export($config, true) . ";\n?>")) {
        $success_message = "Konfigurasi berhasil diperbarui!";
    } else {
        $error_message = "Gagal memperbarui konfigurasi. Silakan coba lagi.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Dashboard Admin</title>

    <link rel="icon" href="/templates/assets/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/assets/styles.php'); ?>
    
    <style>
      .admin-container {
        background: transparent;
        padding: 20px;
        box-shadow: 0 4px 8px rgb(106 106 106 / 50%);
        border-radius: 8px;
        width: 100%;
        max-width: 600px;
        position: relative;
        top: 50px;
        margin: 0 170px auto;
      }
      .admin-container h2 {
        text-align: center;
        color: #FFF;
      	margin-bottom: 10px;
      }
      .admin-container h3 {
        text-align: center;
        color: #FFF;
      	font-size:15px;
       	margin-top: 20px;
      }
      .admin-container label {
        font-weight: 500;
        display: block;
        margin-top: 10px;
       	font-size: 14px;
       	color:#FFF;
      }
      .admin-container input, .admin-container textarea {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
      	box-shadow: 0 4px 8px rgb(106 106 106 / 50%);
        border-radius: 5px;
        font-size: 14px;
      	background: transparent;
  		color: #FFF;
      }
      .admin-container button {
        width: 100%;
        background: var(--red-color);
        filter: brightness(0.9);
        color: white;
        border: none;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
      }
      .admin-container button:hover {
        background: var(--border-color);
      }  
      .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 320px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        padding: 20px;
        text-align: center;
        z-index: 1000;
      }
      .popup-content {
        font-size: 16px;
      }
      .popup-btn {
        width: 50%;
        margin-top: 50px;
        padding: 8px 10px;
        border: none;
        background: var(--red-color);
        filter: brightness(0.9);
        color: white;
        color: white;
        font-size: 14px;
        border-radius: 5px;
        cursor: pointer;
      }
      .popup-btn:hover {
        background: var(--border-color);
      }
      @media only screen and (max-width: 780px) {
        .admin-container{
          margin: 0 auto;
          width:95%;
        }
        .logo,.upload-button{
          top: 5px;
        }
      }
  	</style>

  </head>
  <body class="dark-mode">
    <div class="container">
      <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/parts/header_dashboard.php'); ?>
      <main class="main-layout">
        <div class="screen-overlay"></div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/parts/sidebar_dashboard.php'); ?>
        <div class="content-wrapper">
          <div class="admin-container">
            <h2>Pengaturan Website</h2>
            <form method="POST">
              <h3> Admin Login Setting </h3>

              <label>Username Login:</label>
              <input type="text" name="site_username" value="<?= htmlspecialchars($config['site_username']) ?>" required autocomplete="off">

              <label>Password Login:</label>
              <input type="text" name="site_password" value="<?= htmlspecialchars($config['site_password']) ?>" required autocomplete="off"><br><br>

              <h3> Site Setting (SEO) </h3>

              <label>Judul Website:</label>
              <input type="text" name="site_title" value="<?= htmlspecialchars($config['site_title']) ?>" required autocomplete="off">

              <label>Deskripsi:</label>
              <textarea name="site_description" required autocomplete="off"><?= htmlspecialchars($config['site_description']) ?></textarea>

              <label>Keyword (pisahkan dengan koma):</label>
              <input type="text" name="site_keywords" value="<?= htmlspecialchars($config['site_keywords']) ?>" autocomplete="off" >

              <h3> Ads Setting </h3>

              <label>Iklan Popunder:</label>
              <input type="text" name="site_popunder" value="<?= htmlspecialchars($config['site_popunder']) ?>" autocomplete="off" >

              <label>Iklan Social Bar:</label>
              <input type="text" name="site_socialbar" value="<?= htmlspecialchars($config['site_socialbar']) ?>" autocomplete="off" >

              <label>Iklan Direct:</label>
              <input type="text" name="site_directads" value="<?= htmlspecialchars($config['site_directads']) ?>" autocomplete="off" >

              <h3> HiStats Javascript </h3>

              <label>HiStats Javascript:</label>
              <input type="text" name="site_histatsjs" value="<?= htmlspecialchars($config['site_histatsjs']) ?>" autocomplete="off" >

              <button type="submit">Simpan Perubahan</button>
            </form>
          </div><br><br><br><br><br><br>

          <div id="popupNotification" class="popup">
            <div class="popup-content">
              <p id="popupMessage"></p>
              <button onclick="closePopup()" class="popup-btn">Exit</button>
            </div>
          </div>
		</div>
      </main>
    </div>
    <script>
      function closePopup() {
        document.getElementById("popupNotification").style.display = "none";
      }
      window.onload = function() {
        var successMessage = "<?= htmlspecialchars($success_message) ?>";
        var errorMessage = "<?= htmlspecialchars($error_message) ?>";
        var popup = document.getElementById("popupNotification");
        var message = document.getElementById("popupMessage");

        if (successMessage) {
          message.innerText = successMessage;
          popup.style.backgroundColor = "#d4edda"; // Hijau untuk sukses
          message.style.color = "#155724";
        } else if (errorMessage) {
          message.innerText = errorMessage;
          popup.style.backgroundColor = "#f8d7da"; // Merah untuk error
          message.style.color = "#721c24";
        }

        if (successMessage || errorMessage) {
          popup.style.display = "block";
        }
      };
    </script>

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/assets/javascript.php'); ?>
  </body>
</html>
