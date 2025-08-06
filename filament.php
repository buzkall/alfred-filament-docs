<?php

// Suppress only the specific deprecation warning from Alfred Workflow library
// This is a third-party library issue that we can't fix directly
error_reporting(E_ALL & ~E_DEPRECATED);

use Alfred\Workflows\Workflow;

use Algolia\AlgoliaSearch\Api\SearchClient as Algolia;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/functions.php';

$query = $argv[1];
$version = isset($argv[2]) ? $argv[2] : 'v4';

$workflow = new Workflow;
$algolia = Algolia::create('LMIKXMDI4P', '1e3d12b0b9c3a4db16cd896e83b9efa0');

$results = getResults($algolia, 'filamentadmin', $query, $version);

if (empty($results)) {
    $workflow->item()
        ->title('No matches')
        ->icon('google.png')
        ->subtitle('No match found in the docs. Search Google for: "Laravel+Filament+Admin+' . $query . '"')
        ->arg('https://www.google.com/search?q=laravel+filament+admin+' . $query)
        ->quickLookUrl('https://www.google.com/search?q=laravel+filament+admin+' . $query)
        ->valid(true);

    $workflow->output();
    exit;
}

foreach ($results as $hit) {
    list($title, $titleLevel) = getTitle($hit);

    if ($title === null) {
        continue;
    }

    $title = html_entity_decode($title);

    $workflow->item()
        ->uid($hit['objectID'])
        ->title($title)
        ->autocomplete($title)
        ->subtitle(html_entity_decode(getSubtitle($hit, $titleLevel)))
        ->arg($hit['url'])
        ->quickLookUrl($hit['url'])
        ->valid(true);
}

$workflow->output();
