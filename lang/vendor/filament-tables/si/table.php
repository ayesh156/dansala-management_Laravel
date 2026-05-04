<?php

return [
    'column_toggle' => [
        'heading' => 'තීරු',
    ],

    'columns' => [
        'actions' => ['label' => 'ක්‍රියාව|ක්‍රියාවන්'],
        'text' => [
            'actions' => [
                'collapse_list' => ':count ක් අඩු කරන්න',
                'expand_list'   => ':count ක් වැඩිපුර පෙන්වන්න',
            ],
            'more_list_items' => 'සහ :count ක් තවත්',
        ],
    ],

    'fields' => [
        'bulk_select_page'   => ['label' => 'සියලු අයිතම තෝරන්න/ඉවත් කරන්න.'],
        'bulk_select_record' => ['label' => ':key අයිතමය තෝරන්න/ඉවත් කරන්න.'],
        'bulk_select_group'  => ['label' => ':title කණ්ඩායම තෝරන්න/ඉවත් කරන්න.'],
        'search' => [
            'label'       => 'සොයන්න',
            'placeholder' => 'සොයන්න...',
            'indicator'   => 'සෙවීම',
        ],
    ],

    'actions' => [
        'disable_reordering' => ['label' => 'නැවත සකස් කිරීම නිම කරන්න'],
        'enable_reordering'  => ['label' => 'නැවත සකස් කරන්න'],
        'filter'             => ['label' => 'පෙරහන'],
        'group'              => ['label' => 'කණ්ඩායම'],
        'open_bulk_actions'  => ['label' => 'කාණ්ඩ ක්‍රියාවන්'],
        'toggle_columns'     => ['label' => 'තීරු සක්‍රිය/අක්‍රිය'],
    ],

    'empty' => [
        'heading'     => ':model නොමැත',
        'description' => 'ආරම්භ කිරීමට :model එකතු කරන්න.',
    ],

    'filters' => [
        'actions' => [
            'apply'      => ['label' => 'පෙරහන් යොදන්න'],
            'remove'     => ['label' => 'පෙරහන ඉවත් කරන්න'],
            'remove_all' => ['label' => 'සියලු පෙරහන් ඉවත් කරන්න', 'tooltip' => 'සියලු පෙරහන් ඉවත් කරන්න'],
            'reset'      => ['label' => 'යළි සකසන්න'],
        ],
        'heading'   => 'පෙරහන්',
        'indicator' => 'ක්‍රියාකාරී පෙරහන්',
        'multi_select' => ['placeholder' => 'සියල්ල'],
        'select'       => ['placeholder' => 'සියල්ල'],
        'trashed' => [
            'label'           => 'මකා දැමූ වාර්තා',
            'only_trashed'    => 'මකා දැමූ ඒවා පමණි',
            'with_trashed'    => 'මකා දැමූ ඒවා සමඟ',
            'without_trashed' => 'මකා දැමූ ඒවා නොමැතිව',
        ],
    ],

    'selection_indicator' => [
        'selected_count' => 'වාර්තාව 1ක් තෝරා ඇත|වාර්තා :count ක් තෝරා ඇත',
        'actions' => [
            'select_all'   => ['label' => 'සියල්ල :count ක් තෝරන්න'],
            'deselect_all' => ['label' => 'සියල්ල ඉවත් කරන්න'],
        ],
    ],

    'sorting' => [
        'fields' => [
            'column'    => ['label' => 'අනුව වර්ග කරන්න'],
            'direction' => [
                'label'   => 'වර්ග කිරීමේ දිශාව',
                'options' => ['asc' => 'ආරෝහණ', 'desc' => 'අවරෝහණ'],
            ],
        ],
    ],

    'summary' => [
        'heading' => 'සාරාංශය',
        'subheadings' => [
            'all'   => 'සියලු :label',
            'group' => ':group සාරාංශය',
            'page'  => 'මෙම පිටුව',
        ],
        'summarizers' => [
            'average' => ['label' => 'සාමාන්‍යය'],
            'count'   => ['label' => 'ගණන'],
            'sum'     => ['label' => 'එකතුව'],
        ],
    ],

    'reorder_indicator' => 'ඇදගෙන ගොස් වාර්තා සකස් කරන්න.',
];
