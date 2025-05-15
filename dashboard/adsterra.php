<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: /login.php');
    exit;
}

$config_file = '../templates/core/config.php';
$config = include($config_file);

$success_message = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $config = include($config_file);
  	$config['site_adsterra'] = $_POST['site_adsterra'] ?? $config['site_adsterra'];
    if (file_put_contents($config_file, "<?php\nreturn " . var_export($config, true) . ";\n?>")) {
        $success_message = "Konfigurasi berhasil diperbarui!";
    } else {
        $error_message = "Gagal memperbarui konfigurasi. Silakan coba lagi.";
    }
}

$apiKey = $config['site_adsterra'];
$endDate = date('Y-m-d');
$startDate = date('Y-m-d', strtotime('-6 days'));
$apiUrl = "https://api3.adsterratools.com/publisher/stats.csv?start_date=$startDate&finish_date=$endDate&group_by=date";
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'X-API-Key: ' . $apiKey
));
$response = curl_exec($ch);
if (curl_errno($ch)) {
    $api_error = 'Error: ' . curl_error($ch);
    curl_close($ch);
    $data = [];
    $headers = [];
} else {
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpCode != 200) {
        $api_error = 'HTTP Status Code: ' . $httpCode;
        $data = [];
        $headers = [];
    } else {
        curl_close($ch);
        $lines = explode("\n", trim($response));
        $headers = str_getcsv(array_shift($lines), ';');
        $data = array_map(function($line) {
            return str_getcsv($line, ';');
        }, $lines);
        $filtered_data = array_map(function($row) {
            return [
                $row[0], // Date
                $row[1], // Impression
                $row[4], // CPM
                $row[5]  // Revenue
            ];
        }, $data);
        foreach ($filtered_data as &$row) {
            $row[0] = date('d-m-Y', strtotime($row[0]));
        }
        usort($filtered_data, function($a, $b) {
            return strtotime($b[0]) - strtotime($a[0]);
        });
        $headers = ['D', 'I', 'C', 'R'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin</title>

    <link rel="icon" href="/templates/assets/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/assets/styles.php'); ?>
    
    <style>
      .sidebar-header .sidebar-toggler,
      .sidebar-menu-button {
        top: 20px;
      }
      .container-adsterra {
        position: relative;
        top: 30px;
      }
      .chart-container {
        width: 95%;
    	max-width: 850px;
        margin: 20px auto;
        padding: 20px;
        background-color: var(--white-color);
        box-shadow: 0 4px 8px rgb(106 106 106 / 50%);
        border-radius: 8px;
        margin-bottom: 50px;
      }
      body.dark .chart-container{
        box-shadow: 0 4px 8px rgb(219 218 218 / 50%);
      }
      h2{
      	font-size: 20;
        font-weight: 600;
        color: #FFF;
      }
      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }
      th, td {
        padding: 12px;
   	    text-align: left;
      }
      body.dark th, body.dark td{
        border-bottom: 1px solid #464545;
      }
      th {
        background-color: transparent;
   	    color: #FFF;
        box-shadow: 1px 4px 8px 2px rgb(153 150 150 / 50%);
        border-bottom: 1px solid #e5e3e3;
      }
      td {
        background-color: transparent;
        color: #FFF;
        border-bottom: 1px solid #e5e3e3;
      }
      tr:nth-child(even) {
        background-color: transparent;
      }
      body.dark tr:nth-child(even) {
        background-color: #FFF;
      }
      tr:hover {
        background-color: #242b46;
      }
      body.dark tr:hover {
        background-color: #000;
      }      
      .aa-container {
        background: transparent;
        padding: 10px 10px 10px 20px;
        box-shadow: 0 4px 8px rgb(106 106 106 / 50%);
        border-radius: 8px;
        width: 95%;
        max-width: 850px;
        margin: 0 auto;
      }
      .aa-container form {
        display: flex;
        align-items: center;
        gap: 10px;
      }
      label {
        font-weight: bold;
        display: block;
  	    font-size: 16px;
        color: #FFF;
      }
      input, textarea {
        width: 70%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        background: transparent;
        color: #FFF;
      }
      button {
        width: 100px;
        background: var(--red-color);
        filter: brightness(0.9);
        color: white;
        border: none;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
      }
      button:hover {
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
        font-size: 14px;
        border-radius: 5px;
        cursor: pointer;
      }
      .popup-btn:hover {
        background: var(--border-color);
      }
      @media only screen and (max-width: 768px) {
        .home .text{
          font-size: 1.4em;
        }
        .container-adsterra {
          top: 50px;
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
		  <div class="container-adsterra">
            <div class="aa-container">
              <form method="POST">
                <label>API Adsterra:</label>
                <input type="text" name="site_adsterra" value="<?= htmlspecialchars($config['site_adsterra']) ?>" required autocomplete="off">
                <button type="submit">Simpan</button>
              </form>
            </div>
            <center>
              <div class="chart-container" id="adstera">
                <h2>AdSense Revenue</h2>
                <?php if (isset($api_error)): ?>
                  <p style="color: red;"><?php echo htmlspecialchars($api_error); ?></p>
                <?php else: ?>
                  <table>
                    <thead>
                      <tr>
                        <?php foreach ($headers as $header): ?>
                          <th><?php echo ucfirst(strtolower($header)); ?></th>
                        <?php endforeach; ?>
                        </tr>
                    </thead>
                  <tbody>
                    <?php foreach ($filtered_data as $row): ?>
                      <tr>
                      <?php foreach ($row as $key => $column): ?>
                        <?php
                          if ($key === 2 || $key === 3) {
                            $column = '$' . number_format($column, 3);
                          }
                        ?>
                        <td>
                          <?php echo htmlspecialchars($column); ?>
                        </td>
                        <?php endforeach; ?>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                <?php endif; ?>
              </div>
            </center><br>
          </div>
        </div>
      </main>
    </div>
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/assets/javascript.php'); ?>
  </body>
</html>
