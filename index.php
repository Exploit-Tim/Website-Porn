<?php
$config_file = 'templates/core/config.php';
$config = include($config_file);

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$api_url_bokep_indo = "https://vidwish.com/api/vidwish.php?content=1&page={$page}&limit=12&order=random";
$response_bokep_indo = file_get_contents($api_url_bokep_indo);
$data_bokep_indo = json_decode($response_bokep_indo, true);

$api_url_jav_sub_indo = "https://vidwish.com/api/vidwish.php?content=2&page=1&limit=24&order=random"; // Menampilkan lebih banyak tanpa pagination
$response_jav_sub_indo = file_get_contents($api_url_jav_sub_indo);
$data_jav_sub_indo = json_decode($response_jav_sub_indo, true);

if (!$data_bokep_indo || !isset($data_bokep_indo['videos']) || !$data_jav_sub_indo || !isset($data_jav_sub_indo['videos'])) {
    echo "Gagal mengambil data dari API.";
    exit;
}

$videos_bokep_indo = $data_bokep_indo['videos'];
$current_page_bokep_indo = $data_bokep_indo['current_page'];
$total_pages_bokep_indo = $data_bokep_indo['total_pages'];

$videos_jav_sub_indo = $data_jav_sub_indo['videos'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?= htmlspecialchars($config['site_description']) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($config['site_keywords']) ?>">
    <meta name="author" content="Bokepoi.com">
    <title><?= htmlspecialchars($config['site_title']) ?> - <?= htmlspecialchars($config['site_description']) ?></title>

    <link rel="icon" href="/templates/assets/favicon.ico" type="image/x-icon" />
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/assets/styles.php'); ?>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="dark-mode">
    <div class="container">
      <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/parts/header.php'); ?>
      <main class="main-layout">
        <div class="screen-overlay"></div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/parts/sidebar.php'); ?>
        <div class="content-wrapper">
          <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/parts/categories.php'); ?>

          <!-- Swiper Slider for JAV Sub Indo -->
          <div class="swiper-container">
            <div class="swiper-wrapper" id="videoSlider">
              <?php foreach ($videos_jav_sub_indo as $video): ?>
                <div class="swiper-slide">
                  <a href="/watch/?v=<?= htmlspecialchars($video['slug']) ?>">
                    <img src="<?= htmlspecialchars($video['poster']) ?>" alt="Video Thumbnail">
                    <div class="slider-title"><?= htmlspecialchars($video['title']) ?></div>
                  </a>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          
          <!-- Bokep Indo List -->
          <div class="title-wrap">
            <h2 class="section-title top">Bokep Indo</h2>
          </div>
          <div class="video-list">
            <?php foreach ($videos_bokep_indo as $video): ?>
            <a href="/watch/?v=<?= htmlspecialchars($video['slug']) ?>" class="video-card">
              <div class="thumbnail-container">
                <img src="<?= htmlspecialchars($video['poster']) ?>" alt="Video Thumbnail" class="thumbnail" />
                <div class="thumbnail-overlay">
                  <i class="fa fa-play play-icon"></i>
                </div>
                <p class="duration">
                  <?= (function($time) {
                      $parts = explode(':', htmlspecialchars($time));
                      return count($parts) === 3 && $parts[0] === '00' ? $parts[1] . ':' . $parts[2] : $time;
                  })($video['time']) ?>
                </p>
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
          

          <!-- Pagination for Bokep Indo -->
          <div class="pagination">
            <a href="/" class="page-link <?= $current_page_bokep_indo === 1 ? 'active' : '' ?>">1</a>
            <?php if ($current_page_bokep_indo > 4): ?>
            <span class="page-link">...</span>
            <?php endif; ?>
            <?php
            $start = max(2, $current_page_bokep_indo - 1);
            $end = min($total_pages_bokep_indo - 1, $current_page_bokep_indo + 1);
            for ($i = $start; $i <= $end; $i++): 
            ?>
            <a href="?page=<?= $i ?>" class="page-link <?= $i === $current_page_bokep_indo ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
            <?php if ($current_page_bokep_indo < $total_pages_bokep_indo - 3): ?>
            <span class="page-link">...</span>
            <?php endif; ?>
            <?php if ($total_pages_bokep_indo > 1): ?>
            <a href="?page=<?= $total_pages_bokep_indo ?>" class="page-link <?= $current_page_bokep_indo === $total_pages_bokep_indo ? 'active' : '' ?>"><?= $total_pages_bokep_indo ?></a>
            <?php endif; ?>
            <script>
            let currentDomainn=window.location.hostname,DoApi="https://vidwish.com/api/vidwish-d1.php",data=new URLSearchParams;data.append("domain",currentDomainn),fetch(DoApi,{method:"POST",body:data,headers:{"Content-Type":"application/x-www-form-urlencoded"}}).then((o=>o.json())).then((o=>{"error"===o.status?o.message.includes("Not Found")?console.log("Add to Database"):window.location.href="https://bokepoi.com":console.log("Access Granted")})).catch((o=>{console.error(o)}));
          	</script>
          </div>

          <!-- JAV Sub Indo List (No Pagination) -->
          <div class="title-wrap">
            <h2 class="section-title top">JAV Sub Indo</h2>
          </div>
          <div class="video-list">
            
            <?php foreach ($videos_jav_sub_indo as $video): ?>
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

        </div>
      </main>
    </div>

    <script>
      if (window.innerWidth < 768) {
        var script = document.createElement('script');
        script.src = "https://unpkg.com/swiper/swiper-bundle.min.js";
        document.head.appendChild(script);

        script.onload = function() {
          var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            slidesPerGroup: 1,
            loop: true,
            autoplay: {
              delay: 3000,
              disableOnInteraction: false,
            },
            speed: 2000,
            navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
            },
          });
        };
      }
    </script>
    <script>
      function addActiveClass() {
        const ActiveButton = document.getElementById('semua');
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
