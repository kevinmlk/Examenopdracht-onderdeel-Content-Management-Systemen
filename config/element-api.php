<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        '/api/trees' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'treesArticles'],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function(Entry $entry) {
                    return [
                        'id' => $entry->ID,
                        'title' => $entry->title,
                        'treeThumbnail' => str_replace('https', 'http', $entry->treeThumbnail->one()->getUrl('treeMediumThumbnail')),
                        'botanicalName' => $entry->botanicalName,
                        'nativeAreas' => $entry->nativeAreas->label,
                        'plantFamily' => $entry->plantFamily->label,
                        'introText' => $entry->treeIntroText,
                        'treeLink' => $entry->treeLink,
                    ];
                },
            ];
        },
        '/api/trees/<entryId:\d+>' => function($entryId) {
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
                        'nativeAreas' => $entry->nativeAreas->label,
                        'plantFamily' => $entry->plantFamily->label,
                        'plantType' => $entry->plantType->label,
                        'introText' => $entry->treeIntroText,
                        'treeLink' => $entry->treeLink,
                    ];
                },
            ];
        },
    ]
];