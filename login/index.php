<?php
session_start();
$login_data = include('../templates/core/config.php');

if (isset($_SESSION['username'])) {
    header('Location: /dashboard/');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['site_username'] ?? '';
    $password = $_POST['site_password'] ?? '';

    if ($username === $login_data['site_username'] && $password === $login_data['site_password']) {
        $_SESSION['username'] = $username;
        header('Location: /dashboard/');
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Categories : <?= htmlspecialchars($_GET['s']) ?></title>

    <link rel="icon" href="/templates/assets/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/assets/styles.php'); ?>
    
    <style>
      .login-container {
        background: transparent;
        padding: 20px;
        box-shadow: 0 4px 8px rgb(219 218 218 / 50%);
        border-radius: 8px;
        width: 80%;
        max-width: 600px;
        text-align: center;
        display: grid;
        margin: 50px 170px auto;
      }
      .login-container h1 {
        margin-bottom: 20px;
        color: #FFF;
       	font-size: 25px;
        font-weight: 600;
      }
      .login-container input {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        background: transparent;
    	color: #FFF;
      }
      .login-container button {
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
      .login-container button:hover {
        background: var(--border-color);
      }
      .login-container .error-message {
        color: red;
        font-size: 14px;
        margin-bottom: 15px;
      }
		
      @media only screen and (max-width: 768px) {
        .login-container{
          width:80%;
          margin: 50px auto;
        }
      }
    </style>
  </head>
  <body class="dark-mode">
    <div class="container">
      <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/parts/header.php'); ?>
      <main class="main-layout">
        <div class="screen-overlay"></div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/parts/sidebar.php'); ?>
        <div class="content-wrapper">
          <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/parts/categories.php'); ?>
          <div class="login-container">
          	<h1>DASHBOARD LOGIN</h1>
             <?php if (isset($error)): ?>
            <p class="error-message"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form method="POST">
              <input type="text" name="site_username" placeholder="Username" required><br>
              <input type="password" name="site_password" placeholder="Password" required><br>
              <button type="submit">Login</button>
            </form>
          </div> 
        </div>
      </main>
    </div>

  <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/assets/javascript.php'); ?>
  </body>
</html>
