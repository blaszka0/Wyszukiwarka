<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';

$names = $_GET['names'] ?? [];
if (!is_array($names)) {
    $names = [$names];
}
$names = array_values(array_filter(array_map(static fn($n) => trim((string) $n), $names), static fn($n) => $n !== ''));
if ($names === []) {
    $path = parse_url((string) ($_SERVER['REQUEST_URI'] ?? ''), PHP_URL_PATH) ?? '';
    if (preg_match('#/compare/([^/]+)/([^/]+)/?$#', $path, $m)) {
        $names = [rawurldecode($m[1]), rawurldecode($m[2])];
    }
}
$names = array_slice(array_values(array_unique($names)), 0, 2);

$selected = [];
foreach ($names as $name) {
    $archon = find_archon($name);
    if ($archon) {
        $selected[] = $archon;
    }
}
$valid = count($selected) === 2;
$cleanPath = parse_url((string) ($_SERVER['REQUEST_URI'] ?? ''), PHP_URL_PATH) ?? '';
if ($valid && !preg_match('#/compare/[^/]+/[^/]+/?$#', $cleanPath)) {
    header('Location: ' . compare_url($selected), true, 302);
    exit;
}
http_response_code($valid ? 200 : 400);
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
  <title>Compare Archons — Teyvat Archive</title>
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

  <main class="compare-page">
    <a class="back-link" href="<?= h($directory) ?>">← Back to directory</a>
    <p class="eyebrow">Side by side</p>
    <h2 id="compare-title">Archon comparison</h2>

    <?php if (!$valid): ?>
      <div class="empty-state" style="display:block; margin-top:24px;">
        <strong>Select exactly two Archons</strong>
        Comparison requires two valid Archons. Go back to the directory and choose two.
      </div>
      <p style="margin-top:24px;"><a class="pill-button" href="<?= h($directory) ?>">Return to directory</a></p>
    <?php else: ?>
      <div class="comparison-grid" style="margin-top:25px;">
        <?php foreach ($selected as $archon): ?>
          <?php $portrait = portrait_url($archon); ?>
          <article class="comparison-card" style="--element-bg:<?= h($archon['color']) ?>">
            <div class="comparison-art">
              <?php if ($portrait !== ''): ?>
                <img src="<?= h($portrait) ?>" alt="Portrait of <?= h($archon['name']) ?>" loading="lazy" decoding="async">
              <?php endif; ?>
            </div>
            <div class="comparison-copy">
              <h3><?= h($archon['name']) ?></h3>
              <p class="comparison-epithet"><?= h($archon['epithet']) ?></p>
              <dl class="comparison-attributes">
                <div><dt>Element</dt><dd><?= h($archon['element']) ?></dd></div>
                <div><dt>Region</dt><dd><?= h($archon['region']) ?></dd></div>
                <div><dt>Weapon</dt><dd><?= h($archon['weapon']) ?></dd></div>
              </dl>
              <p class="comparison-description"><?= h($archon['description']) ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
      <p style="margin-top:24px;"><a class="pill-button dialog-close compare-close" href="<?= h($directory) ?>">Return to directory</a></p>
    <?php endif; ?>
  </main>

  <footer class="site-footer" id="o-projekcie">
    <div class="footer-brand"><span aria-hidden="true">✧</span> Teyvat Archive</div>
    <p>An unofficial fan guide to the Archons of Genshin Impact.</p>
    <span class="copyright">Reference data · 2025</span>
  </footer>
</body>
</html>
