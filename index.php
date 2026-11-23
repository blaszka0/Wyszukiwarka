<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';

$total = count(archons());
$regions = regions();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#f5f2e9">
  <title>Teyvat Archive — Genshin Impact</title>
  <link rel="stylesheet" href="<?= h(app_url('styles.css')) ?>">
</head>
<body>
  <header class="site-header">
    <a class="brand" href="<?= h(app_url('index.php')) ?>" aria-label="Teyvat Archive home">
      <span class="brand-mark" aria-hidden="true">✧</span>
      <span>
        <span class="brand-name">Teyvat Archive</span>
        <span class="brand-subtitle">GENSHIN IMPACT</span>
      </span>
    </a>
    <nav class="main-nav" aria-label="Main navigation">
      <a href="<?= h(archons_url()) ?>">Archons</a>
      <a href="#regiony">Regions</a>
      <a href="#o-projekcie">About</a>
    </nav>
    <a class="pill-button header-cta" href="<?= h(archons_url()) ?>">Explore</a>
  </header>

  <main>
    <section class="hero" aria-labelledby="hero-title">
      <div class="hero-copy">
        <p class="eyebrow">A guide to Teyvat</p>
        <h1 id="hero-title">Meet the rulers of <em>seven nations</em></h1>
        <p class="hero-description">A curated directory of the Archons from Genshin Impact. Discover their nations, elements, and extraordinary stories.</p>
        <div class="hero-actions">
          <a class="pill-button" href="<?= h(archons_url()) ?>">Browse Archons</a>
          <a class="pill-button secondary" href="#regiony">Explore regions</a>
        </div>
        <div class="hero-stats" aria-label="Guide statistics">
          <div class="stat"><strong><?= h((string) $total) ?></strong><span>Archons</span></div>
          <div class="stat"><strong>7</strong><span>elements</span></div>
          <div class="stat"><strong>7</strong><span>nations</span></div>
        </div>
      </div>
      <div class="hero-art" aria-label="Featured Archon: Zhongli, Geo">
        <div class="arch">
          <span class="arch-sigil" aria-hidden="true">✧</span>
          <img class="featured-portrait" src="https://enka.network/ui/UI_Gacha_AvatarImg_Zhongli.png" alt="Zhongli" fetchpriority="high" decoding="async">
        </div>
        <div class="featured-label"><span>FEATURED ARCHON</span><strong>Zhongli · Geo</strong></div>
      </div>
    </section>

    <section class="world-section" id="regiony" aria-labelledby="regions-title">
      <div>
        <p class="eyebrow">The world of Teyvat</p>
        <h2 id="regions-title">Every nation tells a different story</h2>
      </div>
      <div class="region-grid" id="region-grid" aria-label="Explore the seven nations">
        <?php foreach ($regions as $index => $r): ?>
          <a class="region-button" href="<?= h(archons_url()) ?>?region=<?= rawurlencode($r) ?>#postacie" data-region="<?= h($r) ?>">
            <span class="region-number"><?= h(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)) ?></span>
            <span class="region-name"><?= h($r) ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </section>
  </main>

  <footer class="site-footer" id="o-projekcie">
    <div class="footer-brand"><span aria-hidden="true">✧</span> Teyvat Archive</div>
    <p>An unofficial fan guide to the Archons of Genshin Impact.</p>
    <span class="copyright">Reference data · 2025</span>
  </footer>
</body>
</html>
