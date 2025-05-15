<?php
$slug = isset($_GET['v']) ? $_GET['v'] : null;
if (!$slug) {
    echo "<p>Error: No slug provided.</p>";
    exit;
}

$apiUrl = "https://vidwish.com/api/vidwish.php?slug=" . urlencode($slug);
$videoDetail = json_decode(file_get_contents($apiUrl), true);

if (!$videoDetail || !isset($videoDetail['slug'])) {
    echo "<p>Error: Gagal mengambil data video dari API.</p>";
    exit;
}

$video = $videoDetail;
$contentType = (strpos($video['title'], 'Bokep Indo') === 0) ? 1 : 2;
$recommendedApiUrlLeft = "https://vidwish.com/api/vidwish.php?content={$contentType}&limit=12&order=random";
$recommendedVideosLeft = json_decode(file_get_contents($recommendedApiUrlLeft), true);

if (!$recommendedVideosLeft || !isset($recommendedVideosLeft['videos'])) {
    echo "<p>Error: Gagal mengambil video rekomendasi kiri.</p>";
    exit;
}

$recommendedVideosLeft = $recommendedVideosLeft['videos'];
$recommendedApiUrlRight = "https://vidwish.com/api/vidwish.php?content={$contentType}&limit=7&order=random";
$recommendedVideosRight = json_decode(file_get_contents($recommendedApiUrlRight), true);

if (!$recommendedVideosRight || !isset($recommendedVideosRight['videos'])) {
    echo "<p>Error: Gagal mengambil video rekomendasi kanan.</p>";
    exit;
}

$recommendedVideosRight = $recommendedVideosRight['videos'];

$genres = explode(',', $video['genre']);
$genreLinks = [];

foreach ($genres as $genre) {
    $trimmed = trim($genre);
    $encoded = urlencode($trimmed);
    $genreLinks[] = '<a href="/categories/?s=' . $encoded . '">' . htmlspecialchars($trimmed) . '</a>';
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($video['title']) ?></title>

    <link rel="icon" href="/templates/assets/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/assets/styles.php'); ?>
    <style>
      .content-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
      }
      .left-content {
        flex: 1;
        min-width: 0;
      }
      .right-widget {
        width: 250px;
        padding: 10px;
        border-radius: 8px;
      }
      .right-widget h3 {
        color: #fff;
        margin-top: 0;
      }
      .right-widget ul {
        list-style: none;
        padding: 0;
        margin: 0;
      }
      .right-widget ul li {
        margin-bottom: 10px;
      }
      .right-widget ul li a {
        text-decoration: none;
      }
      .right-widget ul li a:hover {
        text-decoration: underline;
      }

      .content-wrapper .video-list{
        padding: 0;
        gap: 16px;
      }
      .video-details h1{
        color: #FFF;
        font-size: 18px;
        font-weight: 500;
      }
      .video-details p.views {
        color: #FFF;
        font-weight: 300;
        font-size: 11px;
      }
      .thumbnail-overlay{
        height: calc(100% - 7px);
        border-radius: 8px;
      }
      .video-player {
        position: relative;
        width: 100%;
        aspect-ratio: 16 / 9;
        background-color: #000;
        margin-top: 20px;
      }
      .downloads{
        display: flex;
        justify-content: center;
        align-items: center; 
      }
      .downloads button {
        padding: 5px 10px;
        font-size: 16px;
        border: none;
        background-color: var(--red-color);
        filter: brightness(0.95);
        color: white;
        border-radius: 5px;
        cursor: pointer;
      }
      .video-description{
        margin-top: 25px;
        margin-bottom: -40px;
      }
      .video-description span {
        color: #FFF;
        font-size: 14px;
      }
      .video-description span a{
        color: #FFF;
        text-decoration: none;
      }

      @media (min-width: 768px) {
        .video-details h1 {
          margin-top: 10px;
        }
      }
      @media (max-width: 768px) {
        .content-wrapper {
          flex-direction: column;
        }
        .right-widget {
          width: 100%;
          margin-top: 20px;
        }
        .video-details h1{
          margin-top: 10px;
          color: #FFF;
          font-size: 15px;
          font-weight: 500;
        }
        .video-details p.views {
          color: #FFF;
          font-weight: 300;
          font-size: 10px;
        }
        .left-content{
          width: 100%;
        }
        .downloads button {
          font-size: 14px;
        }
        .video-description span {
          color: #FFF;
          font-size: 11px;
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
          <div class="left-content">
            <?php include($_SERVER['DOCUMENT_ROOT'] . '/templates/parts/categories.php'); ?>
              <div class="video-player">
                <iframe 
                  src="<?= htmlspecialchars($video['embed']) ?>" 
                  width="100%" 
                  height="100%" 
                  frameBorder="0"
                  allowfullscreen="true">
                </iframe>
              </div>
              <div class="video-details">
                <h1><?= htmlspecialchars($video['title']) ?></h1>
                <p class="views">
                  <i class="uil uil-eye"></i> <?= htmlspecialchars($video['views']) ?> views
                  <i class="uil uil-calendar-alt" style="margin-left:15px;"></i> <?= date("d M Y", strtotime($video['date'])) ?>
                </p>
              </div>
            <?php if (strpos($video['title'], 'Bokep Indo') !== 0): ?>
            <div class="video-description">
              <span>• Actor : <?= htmlspecialchars($video['actor']) ?></span><br>
              <span>• Status : Release</span><br>
              <span>• Genre: <?= implode(', ', $genreLinks) ?></span>
            </div>
            <?php else: ?>
            <?php endif; ?><br>

            <div class="downloads">
                <?php if (strpos($video['title'], 'Bokep Indo') === 0): ?>
                    <a href="<?= htmlspecialchars($video['download']) ?>" target="_blank">
                        <button>Download Video !</button>
                    </a>
                <?php else: ?>
                <?php endif; ?>
            </div>

            <br><br>
            <div class="title-wrap" style="margin-bottom: 20px;">
              <h2 class="section-title top">Rekomendasi</h2>
            </div>
            <div class="video-list">
              <?php foreach ($recommendedVideosLeft as $recVideo): ?>
              <a href="/watch/?v=<?= htmlspecialchars($recVideo['slug']) ?>" class="video-card"> <!-- Perubahan disini -->
                <div class="thumbnail-container">
                  <img src="<?= htmlspecialchars($recVideo['poster']) ?>" alt="Video Thumbnail" class="thumbnail" />
                  <div class="thumbnail-overlay">
                    <i class="fa fa-play play-icon"></i>
                  </div>
                  <?php if (strpos($video['title'], 'Bokep Indo') === 0): ?>
                  <p class="duration">
                    <?= (function($time) {
                        $parts = explode(':', htmlspecialchars($time));
                        return count($parts) === 3 && $parts[0] === '00' ? $parts[1] . ':' . $parts[2] : $time;
                    })($video['time']) ?>
                  </p>
                  <?php else: ?>
                  <?php endif; ?>
                </div>
                <div class="video-info">
                  <div class="video-details">
                    <h2 class="title"><?= htmlspecialchars($recVideo['title']) ?></h2>
                    <p class="views"><i class="uil uil-eye"></i><?= htmlspecialchars($recVideo['views']) ?> <i class="uil uil-calendar-alt"></i><?= date("d M Y", strtotime($recVideo['date'])) ?></p>
                  </div>
                </div>
              </a>
              <?php endforeach; ?><br><br><br><br><br>
            </div>
          </div>

          <!-- Widget Kanan -->
          <aside class="right-widget">
            <div style="background:#333; padding: 10px; text-align: center; color: #999; margin-bottom: 20px; margin-top: 63px;">
              Slot Iklan 250x250
            </div>
            <ul>
              <div class="video-list">
                <?php foreach ($recommendedVideosRight as $recVideo): ?>
                <a href="/watch/?v=<?= htmlspecialchars($recVideo['slug']) ?>" class="video-card"> <!-- Perubahan disini -->
                  <div class="thumbnail-container" style="width: calc(100% - 20px);">
                    <img src="<?= htmlspecialchars($recVideo['poster']) ?>" alt="Video Thumbnail" class="thumbnail" />
                    <div class="thumbnail-overlay">
                      <i class="fa fa-play play-icon"></i>
                    </div>
                    <?php if (strpos($video['title'], 'Bokep Indo') === 0): ?>
                    <p class="duration">
                      <?= (function($time) {
                          $parts = explode(':', htmlspecialchars($time));
                          return count($parts) === 3 && $parts[0] === '00' ? $parts[1] . ':' . $parts[2] : $time;
                      })($video['time']) ?>
                    </p>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>
                  <div class="video-info">
                    <div class="video-details">
                      <h2 class="title"><?= htmlspecialchars($recVideo['title']) ?></h2>
                      <p class="views"><i class="uil uil-eye"></i><?= htmlspecialchars($recVideo['views']) ?> <i class="uil uil-calendar-alt"></i><?= date("d M Y", strtotime($recVideo['date'])) ?></p>
                    </div>
                  </div>
                </a>
                <?php endforeach; ?>
              </div>
            </ul>
          </aside>
        </div>
      </main>
    </div>
    <script>
      const slug = "<?= htmlspecialchars($video['slug']) ?>";
      fetch(`https://vidwish.com/api/watch-views.php?slug=${slug}`)
        .then(res => res.json())
        .then(data => console.log("Views updated:", data))
        .catch(err => console.error("Error:", err));
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
