<?php

function getResults($algolia, $indexName, $query, $version)
{
    $facetFilter = match ($version) {
        'v1' => 'version:1.x',
        'v2' => 'version:2.x',
        'v3' => 'version:3.x',
        default => null,
    };

    if ($facetFilter) {
        $searchParams = [
            'query' => $query,
            'facetFilters' => [$facetFilter],
        ];

        $response = $algolia->searchSingleIndex($indexName, $searchParams);

        return $response['hits'] ?? [];
    }

    // For v4/v5, search without facet filters and filter by URL pattern
    $urlPattern = match ($version) {
        'v4' => '/docs/4.x/',
        default => '/docs/5.x/',
    };

    $response = $algolia->searchSingleIndex($indexName, ['query' => $query]);
    $hits = $response['hits'] ?? [];

    return array_values(array_filter($hits, fn($hit) => isset($hit['url']) && str_contains($hit['url'], $urlPattern)));
}

function getTitle($hit): array
{
    for ($level = 6; $level >= 1; $level--) {
        if (isset($hit['hierarchy']['lvl' . $level])) {
            return [$hit['hierarchy']['lvl' . $level], $level];
        }
    }

    return [null, null];
}

function getSubtitle($hit, $titleLevel)
{
    $currentLevel = 0;
    $subtitle = $hit['hierarchy']['lvl0'];

    while ($currentLevel < $titleLevel) {
        $currentLevel++;
        $subtitle .= ' » ' . $hit['hierarchy']['lvl' . $currentLevel];
    }

    return $subtitle;
}
