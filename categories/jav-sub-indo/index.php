<?php
$config_file = '../../templates/core/config.php';
$config = include($config_file);

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$api_url = "https://vidwish.com/api/vidwish.php?content=2&page={$page}&limit=12&order=random";
$response = file_get_contents($api_url);
$data = json_decode($response, true);

if (!$data || !isset($data['videos'])) {
    echo "Gagal mengambil data dari API.";
    exit;
}

$videos = $data['videos'];
$current_page = $data['current_page'];
$total_pages = $data['total_pages'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?= htmlspecialchars($config['site_description']) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($config['site_keywords']) ?>">
    <meta name="author" content="Vidwish">
    <title>JAV Sub Indo Categories - <?= htmlspecialchars($config['site_title']) ?></title>

    <link rel="icon" href="/templates/assets/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/assets/styles.php'); ?>
  </head>
  <body class="dark-mode">
    <div class="container">
      <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/parts/header.php'); ?>
      <main class="main-layout">
        <div class="screen-overlay"></div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/parts/sidebar.php'); ?>
        <div class="content-wrapper">
          <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/parts/categories.php'); ?>
          
          <!-- Video List -->
          <div class="title-wrap">
            <h2 class="section-title top">JAV Sub Indo</h2>
          </div>
          <div class="video-list">
            <?php foreach ($videos as $video): ?>
            <a href="/watch/?v=<?= htmlspecialchars($video['slug']) ?>" class="video-card">
              <div class="thumbnail-container">
                <img src="<?= htmlspecialchars($video['poster']) ?>" alt="Video Thumbnail" class="thumbnail" />
                <div class="thumbnail-overlay">
                  <i class="fa fa-play play-icon"></i>
                </div>
              </div>
              <div class="video-info">
                <div class="video-details">
                  <h2 class="title"><?= htmlspecialchars($video['title']) ?></h2>
                  <p class="views"><i class="uil uil-eye"></i><?= htmlspecialchars($video['views']) ?> <i class="uil uil-calendar-alt"></i><?= date("d M Y", strtotime($video['date'])) ?></p>
                </div>
              </div>
            </a>
            <?php endforeach; ?>
          </div>
          
          <!-- Pagination -->
		  <div class="pagination">
  			<a href="/" class="page-link <?= $current_page === 1 ? 'active' : '' ?>">1</a>
  			<?php if ($current_page > 4): ?>
    		<span class="page-link">...</span>
  			<?php endif; ?>
  			<?php
    		$start = max(2, $current_page - 1);
    		$end = min($total_pages - 1, $current_page + 1);
    		for ($i = $start; $i <= $end; $i++): 
  			?>
    		<a href="?page=<?= $i ?>" class="page-link <?= $i === $current_page ? 'active' : '' ?>"><?= $i ?></a>
  			<?php endfor; ?>
  			<?php if ($current_page < $total_pages - 3): ?>
    		<span class="page-link">...</span>
  			<?php endif; ?>
  			<?php if ($total_pages > 1): ?>
    		<a href="?page=<?= $total_pages ?>" class="page-link <?= $current_page === $total_pages ? 'active' : '' ?>"><?= $total_pages ?></a>
  			<?php endif; ?>
		  </div><br><br>
        </div>
      </main>
    </div>
    <script>
      function addActiveClass() {
        const ActiveButton = document.getElementById('jav-sub-indo');
        if (ActiveButton) {
          ActiveButton.classList.add('active');
        }
      }
      document.addEventListener('DOMContentLoaded', function() {
        addActiveClass();
      });
    </script>
  	<?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/assets/javascript.php'); ?>
  </body>
</html>