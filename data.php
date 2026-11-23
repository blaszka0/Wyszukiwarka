<?php
declare(strict_types=1);

const IMAGE_BASE = 'https://enka.network/ui/UI_Gacha_AvatarImg_';

// indeksowanie przez PHP - 0,1,2,...
// $tablica = [
//     1, // 0 => 1
//     2, // 1 => 2
//     3, // 2 => 3
// ]


// własne indeksowanie
// $tablica = [
//     'abc' => 1,
//     'xyz' => 2,
//     '123' => 3,
// ]
//      ^ indeks
//              ^ element

function archons(): array {
    return [
        [
            'name' => 'Furina',
            'region' => 'Fontaine',
            'element' => 'Hydro',
            'weapon' => 'Sword',
            'epithet' => 'Endless Solo of Solitude',
            'description' => "For five centuries, Furina played the role of Fontaine's Hydro Archon, captivating the nation as its adored star. Behind the confident performances was a lonely human carrying an impossible secret and a promise to save her people. After Fontaine's crisis, Furina stepped away from the divine stage and began to discover who she wanted to be on her own.",
            'voiceLine' => 'The curtain is rising. Let us make this story one to remember.',
            'color' => 'linear-gradient(135deg, #d8efff, #91c8fa)',
            'ink' => '#4b7890',
            'pill' => '#e1f1f8',
            'image' => 'Furina',
        ],
        [
            'name' => 'Zhongli',
            'region' => 'Liyue',
            'element' => 'Geo',
            'weapon' => 'Polearm',
            'epithet' => 'Vago Mundo',
            'description' => 'Zhongli is the name used by Morax, the Geo Archon who once guided Liyue through countless contracts and battles. After thousands of years as its protector, he chose to relinquish his divine role and see whether the people could shape their own future. He now lives quietly as a consultant at Wangsheng Funeral Parlor, bringing deep knowledge of history, ritual, and the value of a promise.',
            'voiceLine' => 'A promise, kept through the years, is a treasure beyond price.',
            'color' => 'linear-gradient(135deg, #ffe7b0, #ffbd72)',
            'ink' => '#826535',
            'pill' => '#f6ebd0',
            'image' => 'Zhongli',
        ],
        [
            'name' => 'Raiden Shogun',
            'region' => 'Inazuma',
            'element' => 'Electro',
            'weapon' => 'Polearm',
            'epithet' => 'Plane of Euthymia',
            'description' => "Raiden Shogun is both the title of Inazuma's ruler and the puppet that enforces her decree of eternity. The true Electro Archon is Ei, who withdrew into the Plane of Euthymia after suffering profound losses. Seeking a world untouched by change, she pursued eternity with unwavering resolve, only to learn that her people and their ambitions could not be frozen in time.",
            'voiceLine' => 'Even in stillness, the heart may find a path forward.',
            'color' => 'linear-gradient(135deg, #f0dfff, #d5b3f5)',
            'ink' => '#795e89',
            'pill' => '#eee2f4',
            'image' => 'Shougun',
        ],
        [
            'name' => 'Nahida',
            'region' => 'Sumeru',
            'element' => 'Dendro',
            'weapon' => 'Catalyst',
            'epithet' => 'Physic of Purity',
            'description' => "Known as Lesser Lord Kusanali, Nahida is the youngest of the Seven and the Dendro Archon of Sumeru. Kept apart from her people for much of her life, she remained curious about the world and deeply attentive to the dreams and worries of others. With patience, empathy, and the wisdom of Irminsul, she helped Sumeru face the truth of its past and look toward a more thoughtful future.",
            'voiceLine' => 'A little curiosity can help a new idea take root.',
            'color' => 'linear-gradient(135deg, #d9ffbd, #5de3ba)',
            'ink' => '#5c7950',
            'pill' => '#e9f4df',
            'image' => 'Nahida',
        ],
        [
            'name' => 'Venti',
            'region' => 'Mondstadt',
            'element' => 'Anemo',
            'weapon' => 'Bow',
            'epithet' => 'Windborne Bard',
            'description' => "Venti appears to be a carefree bard who would rather sing for a drink than sit on a throne. In truth, he is Barbatos, the Anemo Archon who helped Mondstadt break free from a tyrant and grow into a nation that treasures liberty. He rarely rules directly, believing that freedom means allowing people to make their own choices—even when the wind must wait for them to find their way.",
            'voiceLine' => 'The wind has brought us together. Shall we see where it goes?',
            'color' => 'linear-gradient(135deg, #c1f3df, #7bd1b2)',
            'ink' => '#4c7a6b',
            'pill' => '#def0e9',
            'image' => 'Venti',
        ],
        [
            'name' => 'Mavuika',
            'region' => 'Natlan',
            'element' => 'Pyro',
            'weapon' => 'Claymore',
            'epithet' => 'Night-Igniting Flame',
            'description' => "Mavuika is Natlan's Pyro Archon and a champion who stands on the front lines beside her people. Her nation has long faced the threat of the Abyss, and its survival depends on courage shared across its tribes and generations. Carrying the hopes of Natlan, Mavuika meets that struggle with fierce determination and a belief that people can rise together against even the darkest night.",
            'voiceLine' => 'When the night grows fierce, we kindle the flame together.',
            'color' => 'linear-gradient(135deg, #ffc5a4, #ff8e72)',
            'ink' => '#985845',
            'pill' => '#fae5dc',
            'image' => 'Mavuika',
        ],
        [
            'name' => 'Tsaritsa',
            'region' => 'Snezhnaya',
            'element' => 'Cryo',
            'weapon' => 'Unknown',
            'epithet' => 'The Cryo Archon of Snezhnaya',
            'description' => "The Tsaritsa is the Cryo Archon and the distant ruler of Snezhnaya. Through the Fatui, her influence reaches across Teyvat, and her agents pursue the Gnoses held by the other Archons. The reasons behind her campaign—and the grief and convictions that may have shaped it—remain largely hidden, making her one of the most enigmatic figures in the world.",
            'voiceLine' => "Even beneath winter's silence, a new dawn is waiting.",
            'color' => 'linear-gradient(135deg, #d7f0f3, #a6d9e1)',
            'ink' => '#527984',
            'pill' => '#e0f0f2',
            'image' => 'tsaritsa-cutout.webp',
        ],
    ];
}

function regions(): array {
    return ['Mondstadt', 'Liyue', 'Inazuma', 'Sumeru', 'Fontaine', 'Natlan', 'Snezhnaya'];
}

function elements(): array {
    return ['Pyro', 'Hydro', 'Anemo', 'Electro', 'Dendro', 'Cryo', 'Geo'];
}

function h(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function initial(string $value): string {
    if (function_exists('mb_substr')) {
        return mb_substr($value, 0, 1);
    }
    return substr($value, 0, 1);
}

function slugify(string $value): string {
    if (function_exists('mb_strtolower')) {
        $value = mb_strtolower(trim($value), 'UTF-8');
    } else {
        $value = strtolower(trim($value));
    }
    $value = preg_replace('/[^a-z0-9]+/u', '-', $value) ?? '';
    return trim($value, '-');
}

function archon_slug(array $archon): string {
    return slugify((string) ($archon['name'] ?? ''));
}

function base_path(): string {
    $script = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? ''));
    $dir = str_replace('\\', '/', dirname($script));
    if ($dir === '.' || $dir === '/') {
        return '';
    }
    return rtrim($dir, '/');
}

function app_url(string $path = ''): string {
    $base = base_path();
    $path = '/' . ltrim($path, '/');
    if ($path === '/') {
        return ($base !== '' ? $base : '') . '/index.php';
    }
    return ($base !== '' ? $base : '') . $path;
}

function archons_url(): string {
    return app_url('archons');
}

function archon_url(array $archon): string {
    return app_url('archons/' . rawurlencode(archon_slug($archon)));
}

function compare_url(array $names): string {
    $slugs = array_values(array_filter(array_map(static function ($name): string {
        $archon = is_array($name) ? $name : find_archon((string) $name);
        return $archon ? archon_slug($archon) : slugify((string) $name);
    }, $names)));
    return app_url('compare/' . implode('/', array_map('rawurlencode', $slugs)));
}

function portrait_url(array $archon): string {
    $image = $archon['image'] ?? '';
    if ($image === '') {
        return '';
    }
    if (str_ends_with($image, '.webp') || str_ends_with($image, '.jpg') || str_ends_with($image, '.png')) {
        return $image;
    }
    return IMAGE_BASE . $image . '.png';
}

function find_archon(string $name): ?array {
    $needle = slugify($name);
    foreach (archons() as $archon) {
        if ($archon['name'] === $name || archon_slug($archon) === $needle) {
            return $archon;
        }
    }
    return null;
}

function filter_archons(string $query, string $region, string $element): array {
    $query = trim(function_exists('mb_strtolower') ? mb_strtolower($query) : strtolower($query));
    $regionSet = array_flip(regions());
    $elementSet = array_flip(elements());
    if ($region !== '' && !isset($regionSet[$region])) {
        $region = '';
    }
    if ($element !== '' && !isset($elementSet[$element])) {
        $element = '';
    }

    return array_values(array_filter(archons(), static function (array $archon) use ($query, $region, $element): bool {
        if ($region !== '' && $archon['region'] !== $region) {
            return false;
        }
        if ($element !== '' && $archon['element'] !== $element) {
            return false;
        }
        if ($query === '') {
            return true;
        }
        $haystackText = $archon['name'] . ' ' . $archon['region'] . ' ' . $archon['element'] . ' ' . $archon['epithet'];
        $haystack = function_exists('mb_strtolower') ? mb_strtolower($haystackText) : strtolower($haystackText);
        return str_contains($haystack, $query);
    }));
}
