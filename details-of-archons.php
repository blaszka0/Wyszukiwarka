<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';

$name = isset($_GET['name']) ? trim((string) $_GET['name']) : '';
if ($name === '') {
    $path = parse_url((string) ($_SERVER['REQUEST_URI'] ?? ''), PHP_URL_PATH) ?? '';
    if (preg_match('#/archons/([^/]+)/?$#', $path, $m)) {
        $name = rawurldecode($m[1]);
    }
}
$archon = $name !== '' ? find_archon($name) : null;
http_response_code($archon ? 200 : 404);
$home = app_url('index.php');
$styles = app_url('styles.css');
$directory = archons_url() . '#postacie';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#f5f2e9">
  <title><?= $archon ? h($archon['name']) . ' — Teyvat Archive' : 'Archon not found — Teyvat Archive' ?></title>
  <link rel="stylesheet" href="<?= h($styles) ?>">
</head>
<body>
  <header class="site-header">
    <a class="brand" href="<?= h($home) ?>" aria-label="Teyvat Archive home">
      <span class="brand-mark" aria-hidden="true">✧</span>
      <span>
        <span class="brand-name">Teyvat Archive</span>
        <span class="brand-subtitle">GENSHIN IMPACT</span>
      </span>
    </a>
    <nav class="main-nav" aria-label="Main navigation">
      <a href="<?= h(archons_url()) ?>">Archons</a>
      <a href="<?= h($home) ?>#regiony">Regions</a>
      <a href="<?= h($home) ?>#o-projekcie">About</a>
    </nav>
    <a class="pill-button header-cta" href="<?= h(archons_url()) ?>">Explore</a>
  </header>

  <main class="profile-page">
    <a class="back-link" href="<?= h($directory) ?>">← Back to directory</a>
    <?php if (!$archon): ?>
      <section class="profile-card" aria-labelledby="not-found-title">
        <div class="dialog-content">
          <p class="eyebrow">Not found</p>
          <h2 id="not-found-title">Archon not found</h2>
          <p class="dialog-description">The requested Archon could not be found. Return to the directory to browse available profiles.</p>
          <a class="pill-button dialog-close" href="<?= h($directory) ?>">Return to directory</a>
        </div>
      </section>
    <?php else: ?>
      <?php $portrait = portrait_url($archon); ?>
      <article class="profile-card" style="--element-bg:<?= h($archon['color']) ?>">
        <div class="dialog-art" aria-hidden="true">
          <?php if ($portrait !== ''): ?>
            <img class="dialog-portrait" src="<?= h($portrait) ?>" alt="Portrait of <?= h($archon['name']) ?>" decoding="async">
          <?php endif; ?>
        </div>
        <div class="dialog-content">
          <p class="eyebrow"><?= h($archon['region']) ?> · <?= h($archon['element']) ?></p>
          <h2><?= h($archon['name']) ?></h2>
          <p class="dialog-meta"><?= h($archon['epithet']) ?></p>
          <p class="dialog-description"><?= h($archon['description']) ?></p>
          <dl class="comparison-attributes" style="margin-bottom:24px;">
            <div><dt>Element</dt><dd><?= h($archon['element']) ?></dd></div>
            <div><dt>Region</dt><dd><?= h($archon['region']) ?></dd></div>
            <div><dt>Weapon</dt><dd><?= h($archon['weapon']) ?></dd></div>
          </dl>
          <div class="profile-voice">
            <p class="soundboard-line">“<?= h($archon['voiceLine']) ?>”</p>
            <p class="no-js-note">Voice playback and ratings are available as JavaScript enhancements on the main directory.</p>
          </div>
          <a class="pill-button dialog-close" href="<?= h($directory) ?>">Return to directory</a>
        </div>
      </article>
    <?php endif; ?>
  </main>

  <footer class="site-footer" id="o-projekcie">
    <div class="footer-brand"><span aria-hidden="true">✧</span> Teyvat Archive</div>
    <p>An unofficial fan guide to the Archons of Genshin Impact.</p>
    <span class="copyright">Reference data · 2025</span>
  </footer>
</body>
</html>
