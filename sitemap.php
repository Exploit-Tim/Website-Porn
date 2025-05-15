<?php
$api_url = "https://vidwish.com/api/vidwish.php?&content=0";
$response = file_get_contents($api_url);
$data = json_decode($response, true);
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";

if (!$data || !isset($data['videos'])) {
    echo "No video data available.";
    exit;
}

header('Content-Type: application/xml; charset=UTF-8');

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

foreach ($data['videos'] as $video) {
    $video_url = $protocol . $_SERVER['HTTP_HOST'] . "/watch/?v=" . urlencode($video['slug']);
    $lastmod = date('Y-m-d', strtotime($video['date']));
    
    echo '<url>';
    echo '<loc>' . htmlspecialchars($video_url) . '</loc>';
    echo '<lastmod>' . $lastmod . '</lastmod>';
    echo '<changefreq>daily</changefreq>';
    echo '<priority>0.8</priority>';
    echo '</url>';
}

echo '</urlset>';
?>
