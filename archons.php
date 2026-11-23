<?php
declare(strict_types=1);
require_once __DIR__ . '/data.php';

$query = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
$region = isset($_GET['region']) ? trim((string) $_GET['region']) : '';
$element = isset($_GET['element']) ? trim((string) $_GET['element']) : '';
$regions = regions();
$elements = elements();
if ($region !== '' && !in_array($region, $regions, true)) {
    $region = '';
}
if ($element !== '' && !in_array($element, $elements, true)) {
    $element = '';
}
$filtered = filter_archons($query, $region, $element);
$visible = count($filtered);
$home = app_url('index.php');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#f5f2e9">
  <title>Archons — Teyvat Archive</title>
  <link rel="stylesheet" href="<?= h(app_url('styles.css')) ?>">
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
    <a class="pill-button header-cta" href="#postacie">Explore</a>
  </header>

  <main>
    <section class="directory" id="postacie" aria-labelledby="directory-title">
      <div class="section-heading">
        <div>
          <p class="eyebrow">The Seven</p>
          <h2 id="directory-title">Archon directory</h2>
        </div>
        <p class="section-intro">Use search and filters to quickly find your favorite Archon.</p>
      </div>

      <form class="filters" role="search" method="get" action="<?= h(archons_url()) ?>#postacie" id="filters-form">
        <label class="search-wrap">
          <span class="search-icon" aria-hidden="true">⌕</span>
          <input id="character-search" name="q" type="search" value="<?= h($query) ?>" placeholder="Search for an Archon..." aria-label="Search for an Archon">
        </label>
        <select id="region-filter" name="region" aria-label="Filter by region">
          <option value="">All regions</option>
          <?php foreach ($regions as $r): ?>
            <option value="<?= h($r) ?>"<?= $region === $r ? ' selected' : '' ?>><?= h($r) ?></option>
          <?php endforeach; ?>
        </select>
        <select id="element-filter" name="element" aria-label="Filter by element">
          <option value="">All elements</option>
          <?php foreach ($elements as $e): ?>
            <option value="<?= h($e) ?>"<?= $element === $e ? ' selected' : '' ?>><?= h($e) ?></option>
          <?php endforeach; ?>
        </select>
        <div class="filter-actions">
          <button class="pill-button" type="submit">Filter</button>
        </div>
      </form>

      <p class="results-line" aria-live="polite">Showing <strong id="result-count"><?= h((string) $visible) ?></strong> Archons</p>
      <p class="rating-status" id="rating-status" role="status" aria-live="polite"></p>

      <form class="compare-form" id="compare-form" method="get" action="<?= h(app_url('compare')) ?>">
        <div class="character-grid" id="character-grid">
          <?php foreach ($filtered as $archon): ?>
            <?php $portrait = portrait_url($archon); ?>
            <article class="character-card" data-name="<?= h($archon['name']) ?>" data-region="<?= h($archon['region']) ?>" data-element="<?= h($archon['element']) ?>" data-epithet="<?= h($archon['epithet']) ?>" style="--element-bg:<?= h($archon['color']) ?>;--element-ink:<?= h($archon['ink']) ?>;--element-pill:<?= h($archon['pill']) ?>">
              <div class="card-art">
                <span class="region-badge"><?= h($archon['region']) ?></span>
                <label class="compare-select-label compare-card-select">
                  <input type="checkbox" name="names[]" value="<?= h(archon_slug($archon)) ?>" data-compare="<?= h($archon['name']) ?>" data-slug="<?= h(archon_slug($archon)) ?>" aria-label="Select <?= h($archon['name']) ?> for comparison">
                  <span class="compare-select-text">Compare</span>
                  <span class="compare-select-text-selected" aria-hidden="true">Selected</span>
                </label>
                <span class="card-art-letter" aria-hidden="true"><?= h(initial($archon['name'])) ?></span>
                <?php if ($portrait !== ''): ?>
                  <img class="character-portrait" src="<?= h($portrait) ?>" alt="Portrait of <?= h($archon['name']) ?>" loading="lazy" decoding="async">
                <?php endif; ?>
              </div>
              <div class="card-content">
                <div class="card-title-row">
                  <h3><?= h($archon['name']) ?></h3>
                  <span class="element-badge"><?= h($archon['element']) ?></span>
                </div>
                <p class="epithet"><?= h($archon['epithet']) ?></p>
                <div class="card-bottom">
                  <div class="rating-control" data-rating-control="<?= h($archon['name']) ?>">
                    <span class="rating-label">Your rating</span>
                    <div class="star-rating" role="group" aria-label="Your rating for <?= h($archon['name']) ?>: not rated">
                      <?php for ($i = 1; $i <= 5; $i++): ?>
                        <button class="rating-star" type="button" data-rating="<?= $i ?>" data-character="<?= h($archon['name']) ?>" aria-label="Rate <?= h($archon['name']) ?> <?= $i ?> out of 5 stars" aria-pressed="false">☆</button>
                      <?php endfor; ?>
                    </div>
                    <noscript><span class="no-js-note">Ratings require JavaScript.</span></noscript>
                  </div>
                  <a class="profile-button" href="<?= h(archon_url($archon)) ?>" data-profile="<?= h($archon['name']) ?>" data-profile-url="<?= h(archon_url($archon)) ?>">View profile →</a>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>

        <div class="empty-state" id="empty-state"<?= $visible === 0 ? ' style="display:block"' : '' ?>>
          <strong>No Archons found</strong>Try a different search or clear the filters.
        </div>

        <div class="compare-tray-static" id="compare-tray-static">
          <p><strong id="compare-count-static"></strong> selected for comparison</p>
          <button class="pill-button" id="compare-submit" type="submit">Compare</button>
        </div>
      </form>

      <div class="compare-tray" id="compare-tray" hidden>
        <p><strong id="compare-count">0 / 2</strong> selected for comparison</p>
        <button class="pill-button" id="compare-open" type="button" disabled>Compare</button>
      </div>
    </section>
  </main>

  <footer class="site-footer" id="o-projekcie">
    <div class="footer-brand"><span aria-hidden="true">✧</span> Teyvat Archive</div>
    <p>An unofficial fan guide to the Archons of Genshin Impact.</p>
    <span class="copyright">Reference data · 2025</span>
  </footer>

  <dialog id="profile-dialog" aria-labelledby="dialog-name">
    <div class="dialog-art" id="dialog-art" aria-hidden="true"></div>
    <div class="dialog-content">
      <p class="eyebrow" id="dialog-region"></p>
      <h2 id="dialog-name"></h2>
      <p class="dialog-meta" id="dialog-meta"></p>
      <p class="dialog-description" id="dialog-description"></p>
      <div id="profile-rating"></div>
      <div class="profile-voice">
        <button class="voice-button" id="voice-button" type="button">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M11 5 6 9H3v6h3l5 4z"/><path d="M15.5 8.5a5 5 0 0 1 0 7M18.5 5.5a9 9 0 0 1 0 13"/>
          </svg>
          <span>Hear an original line</span>
        </button>
        <p class="voice-status" id="voice-status" role="status" aria-live="polite"></p>
        <p class="soundboard-line" id="soundboard-line"></p>
      </div>
      <button class="pill-button dialog-close" id="dialog-close" type="button">Return to directory</button>
    </div>
  </dialog>

  <dialog id="compare-dialog" aria-labelledby="compare-title">
    <div class="compare-dialog-content">
      <p class="eyebrow">Side by side</p>
      <h2 id="compare-title">Archon comparison</h2>
      <div class="comparison-grid" id="comparison-grid"></div>
      <button class="pill-button dialog-close compare-close" id="compare-close" type="button">Return to directory</button>
    </div>
  </dialog>

  <script>
    const imageBase = <?= json_encode(IMAGE_BASE, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
    const archons = <?= json_encode(archons(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>.map((a) => ({ ...a, slug: a.name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '') }));
    const regions = <?= json_encode(regions(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
    const basePath = <?= json_encode(base_path(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
    const selectedForComparison = new Set();
    const grid = document.querySelector("#character-grid");
    const search = document.querySelector("#character-search");
    const regionFilter = document.querySelector("#region-filter");
    const elementFilter = document.querySelector("#element-filter");
    const count = document.querySelector("#result-count");
    const emptyState = document.querySelector("#empty-state");
    const dialog = document.querySelector("#profile-dialog");
    const compareDialog = document.querySelector("#compare-dialog");
    const compareTray = document.querySelector("#compare-tray");
    const compareTrayStatic = document.querySelector("#compare-tray-static");
    const compareCount = document.querySelector("#compare-count");
    const compareOpenButton = document.querySelector("#compare-open");
    const voiceButton = document.querySelector("#voice-button");
    const voiceStatus = document.querySelector("#voice-status");
    const ratingStatus = document.querySelector("#rating-status");
    const profileRating = document.querySelector("#profile-rating");
    const ratingsStorageKey = "teyvat-character-ratings";
    const ratings = loadRatings();
    let activeArchon = null;
    let activeUtterance = null;

    function loadRatings() {
      try {
        const savedRatings = localStorage.getItem(ratingsStorageKey);
        if (!savedRatings) return {};
        const parsedRatings = JSON.parse(savedRatings);
        if (!parsedRatings || typeof parsedRatings !== "object" || Array.isArray(parsedRatings)) {
          throw new Error("Saved ratings have an invalid format.");
        }
        return Object.fromEntries(archons
          .filter((archon) => Number.isInteger(parsedRatings[archon.name]) && parsedRatings[archon.name] >= 1 && parsedRatings[archon.name] <= 5)
          .map((archon) => [archon.name, parsedRatings[archon.name]]));
      } catch (error) {
        ratingStatus.textContent = "Saved ratings could not be loaded from this browser.";
        return {};
      }
    }

    function ratingMarkup(archon) {
      const rating = ratings[archon.name] || 0;
      const currentRating = rating ? `${rating} out of 5 stars` : "not rated";
      const stars = Array.from({ length: 5 }, (_, index) => {
        const value = index + 1;
        const selected = value <= rating;
        return `<button class="rating-star" type="button" data-rating="${value}" data-character="${archon.name}" aria-label="Rate ${archon.name} ${value} out of 5 stars" aria-pressed="${selected}">${selected ? "★" : "☆"}</button>`;
      }).join("");
      return `<div class="rating-control"><span class="rating-label">Your rating</span><div class="star-rating" role="group" aria-label="Your rating for ${archon.name}: ${currentRating}">${stars}</div></div>`;
    }

    function saveRatings() {
      try {
        localStorage.setItem(ratingsStorageKey, JSON.stringify(ratings));
        ratingStatus.textContent = "";
      } catch (error) {
        ratingStatus.textContent = "This browser blocked storage, so your rating may not persist.";
      }
    }

    function updateRating(name, value) {
      ratings[name] = value;
      saveRatings();
      syncRatings();
      if (activeArchon && activeArchon.name === name) profileRating.innerHTML = ratingMarkup(activeArchon);
    }

    function syncRatings() {
      document.querySelectorAll("[data-rating-control]").forEach((control) => {
        const name = control.dataset.ratingControl;
        const archon = archons.find((item) => item.name === name);
        if (archon) control.innerHTML = ratingMarkup(archon);
      });
    }

    function handleRatingClick(event) {
      const button = event.target.closest("[data-rating]");
      if (!button) return;
      updateRating(button.dataset.character, Number(button.dataset.rating));
    }

    function portraitUrl(archon) {
      return archon.image.endsWith(".webp") || archon.image.endsWith(".jpg") || archon.image.endsWith(".png") ? archon.image : `${imageBase}${archon.image}.png`;
    }

    function archonUrl(archon) {
      return `${basePath}/archons/${encodeURIComponent(archon.slug)}`;
    }

    function compareUrl(slugs) {
      return `${basePath}/compare/${slugs.map(encodeURIComponent).join('/')}`;
    }

    function watchImage(image, fallback) {
      const handleLoad = () => { if (image.naturalWidth) fallback.hidden = true; };
      image.addEventListener("load", handleLoad, { once: true });
      image.addEventListener("error", () => { image.hidden = true; }, { once: true });
      if (image.complete) handleLoad();
    }

    function renderArchons() {
      const query = search.value.trim().toLocaleLowerCase();
      const region = regionFilter.value;
      const element = elementFilter.value;
      const cards = Array.from(grid.querySelectorAll(".character-card"));
      let visible = 0;
      cards.forEach((card) => {
        const searchable = `${card.dataset.name} ${card.dataset.region} ${card.dataset.element} ${card.dataset.epithet}`.toLocaleLowerCase();
        const show = searchable.includes(query) && (!region || card.dataset.region === region) && (!element || card.dataset.element === element);
        card.hidden = !show;
        if (show) visible += 1;
      });
      count.textContent = visible;
      emptyState.style.display = visible ? "none" : "block";
      updateCompareTray();
    }

    function updateCompareTray() {
      const checkboxes = Array.from(grid.querySelectorAll('[data-compare]'));
      selectedForComparison.clear();
      checkboxes.forEach((cb) => { if (cb.checked) selectedForComparison.add(cb.dataset.compare); });
      checkboxes.forEach((cb) => {
        cb.disabled = !cb.checked && selectedForComparison.size >= 2;
      });
      compareTray.hidden = selectedForComparison.size === 0;
      compareTrayStatic.hidden = selectedForComparison.size > 0;
      compareCount.textContent = `${selectedForComparison.size} / 2`;
      compareOpenButton.disabled = selectedForComparison.size !== 2;
    }

    function openComparison() {
      if (selectedForComparison.size !== 2) return;
      const selectedArchons = archons.filter((archon) => selectedForComparison.has(archon.name));
      document.querySelector("#comparison-grid").innerHTML = selectedArchons.map((archon) => `
        <article class="comparison-card" style="--element-bg:${archon.color}">
          <div class="comparison-art"><img src="${portraitUrl(archon)}" alt="Portrait of ${archon.name}" loading="lazy" decoding="async"></div>
          <div class="comparison-copy">
            <h3>${archon.name}</h3>
            <p class="comparison-epithet">${archon.epithet}</p>
            <dl class="comparison-attributes">
              <div><dt>Element</dt><dd>${archon.element}</dd></div>
              <div><dt>Region</dt><dd>${archon.region}</dd></div>
              <div><dt>Weapon</dt><dd>${archon.weapon}</dd></div>
            </dl>
            <p class="comparison-description">${archon.description}</p>
          </div>
        </article>`).join("");
      compareDialog.showModal();
    }

    function openProfile(name) {
      const archon = archons.find((item) => item.name === name);
      if (!archon) return;
      stopVoice();
      activeArchon = archon;
      const dialogArt = document.querySelector("#dialog-art");
      dialogArt.style.background = archon.color;
      dialogArt.replaceChildren();
      if (archon.image) {
        const image = document.createElement("img");
        image.className = "dialog-portrait";
        image.src = portraitUrl(archon);
        image.alt = `Portrait of ${archon.name}`;
        image.decoding = "async";
        dialogArt.append(image);
      }
      document.querySelector("#dialog-region").textContent = `${archon.region} · ${archon.element}`;
      document.querySelector("#dialog-name").textContent = archon.name;
      document.querySelector("#dialog-meta").textContent = archon.epithet;
      document.querySelector("#dialog-description").textContent = archon.description;
      profileRating.innerHTML = ratingMarkup(archon);
      document.querySelector("#soundboard-line").textContent = `“${archon.voiceLine}”`;
      voiceStatus.textContent = "";
      voiceButton.querySelector("span").textContent = "Hear an original line";
      dialog.showModal();
    }

    function stopVoice() {
      if ("speechSynthesis" in window) window.speechSynthesis.cancel();
      activeUtterance = null;
      voiceButton.querySelector("span").textContent = "Hear an original line";
    }

    function playVoiceLine() {
      if (!activeArchon) return;
      if (!("speechSynthesis" in window) || typeof SpeechSynthesisUtterance === "undefined") {
        voiceStatus.textContent = "Speech playback is not available in this browser.";
        return;
      }
      if (activeUtterance) { stopVoice(); voiceStatus.textContent = "Playback stopped."; return; }
      const utterance = new SpeechSynthesisUtterance(activeArchon.voiceLine);
      utterance.lang = "en-US";
      utterance.onstart = () => { voiceStatus.textContent = "Playing with your browser's synthetic voice."; voiceButton.querySelector("span").textContent = "Stop playback"; };
      utterance.onend = () => { if (activeUtterance !== utterance) return; activeUtterance = null; voiceStatus.textContent = "Playback finished."; voiceButton.querySelector("span").textContent = "Hear an original line"; };
      utterance.onerror = () => { if (activeUtterance !== utterance) return; activeUtterance = null; voiceStatus.textContent = "The browser could not play this line."; voiceButton.querySelector("span").textContent = "Hear an original line"; };
      activeUtterance = utterance;
      window.speechSynthesis.speak(utterance);
    }

    document.querySelectorAll(".character-portrait").forEach((image) => {
      watchImage(image, image.parentElement.querySelector(".card-art-letter"));
    });
    syncRatings();

    [search, regionFilter, elementFilter].forEach((control) => control.addEventListener("input", renderArchons));
    document.querySelector("#filters-form").addEventListener("submit", (event) => { event.preventDefault(); renderArchons(); });

    grid.addEventListener("click", handleRatingClick);
    dialog.addEventListener("click", handleRatingClick);

    grid.addEventListener("change", (event) => {
      if (event.target.matches('[data-compare]')) updateCompareTray();
    });

    grid.addEventListener("click", (event) => {
      const profile = event.target.closest("[data-profile]");
      if (profile) {
        event.preventDefault();
        const name = profile.dataset.profile;
        const archon = archons.find((item) => item.name === name);
        if (archon) history.pushState({ profile: name }, '', archonUrl(archon));
        openProfile(name);
      }
    });

    compareOpenButton.addEventListener("click", () => {
      if (selectedForComparison.size !== 2) return;
      const slugs = archons.filter((a) => selectedForComparison.has(a.name)).map((a) => a.slug);
      if (slugs.length === 2) {
        window.location.href = compareUrl(slugs);
        return;
      }
      openComparison();
    });
    document.querySelector("#compare-close").addEventListener("click", () => compareDialog.close());
    compareDialog.addEventListener("click", (event) => { if (event.target === compareDialog) compareDialog.close(); });
    voiceButton.addEventListener("click", playVoiceLine);
    document.querySelector("#dialog-close").addEventListener("click", () => dialog.close());
    dialog.addEventListener("close", () => {
      stopVoice();
      activeArchon = null;
      if (location.pathname.startsWith(`${basePath}/archons/`)) history.pushState({}, '', `${basePath}/archons#postacie`);
    });
    dialog.addEventListener("click", (event) => { if (event.target === dialog) dialog.close(); });

    window.addEventListener('popstate', () => {
      const m = location.pathname.match(/\/archons\/([^/]+)\/?$/);
      if (m) {
        const slug = decodeURIComponent(m[1]);
        const archon = archons.find((a) => a.slug === slug);
        if (archon) { openProfile(archon.name); return; }
      }
      if (dialog.open) dialog.close();
    });

    renderArchons();
  </script>
</body>
</html>
