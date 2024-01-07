<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        // Aanpassen naar /api/news
        '/api/news' => function() {
            return [
                'elementType' => Entry::class,
                // Indien nodig, pas de section naam uit
                'criteria' => ['section' => 'trees'],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function(Entry $entry) {
                    return [
                        'id' => $entry->ID,
                        'title' => $entry->title,
                        'treeThumbnail' => str_replace('https', 'http', $entry->treeThumbnail->one()->getUrl('treeMediumThumbnail')),
                        'botanicalName' => $entry->botanicalName,
                        'nativeAreas' => $entry->nativeAreas,
                        'plantFamily' => $entry->plantFamily,
                        'introText' => $entry->treeIntroText,
                    ];
                },
            ];
        },
        // /Api/news toevoegen
        '/api/news/<entryId:\d+>' => function($entryId) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $entryId],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'one' => true,
                'transformer' => function(Entry $entry) {
                    return [
                        'id' => $entry->ID,
                        'title' => $entry->title,
                        'treeThumbnail' => str_replace('https', 'http', $entry->treeThumbnail->one()->getUrl('treeMediumThumbnail')),
                        'botanicalName' => $entry->botanicalName,
                        'treeHeight' => $entry->matureSizeHeight,
                        'treeWidth' => $entry->matureSizeWidth,
                        'nativeAreas' => $entry->nativeAreas,
                        'plantFamily' => $entry->plantFamily,
                        'plantType' => $entry->plantType,
                        'introText' => $entry->treeIntroText,
                        'treeArticle' => $entry->treeArticle,
                        'shopLink' => $entry->treeLink,
                    ];
                },
            ];
        },
    ]
];