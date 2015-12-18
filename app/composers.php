<?php

View::composers([
    'Karakata\Composers\LocationComposer' => [
        'partials._search_cta',
        'categories.show',
        'items.create',
        'admin.items.edit',
        'items.edit',
        'items.search_result'
    ],
    'Karakata\Composers\CategoryComposer' => [
        'items.create',
        'items.edit',
        'admin.items.edit',
        'admin.categories.list',
        'items.search_result'
    ],
    'Karakata\Composers\MessageComposer' => ['partials._user_sidebar', 'partials._header'],
    'Karakata\Composers\FeaturedItemComposer' => ['widgets._featured_items'],
    'Karakata\Composers\PopularCategoryComposer' => ['widgets._popular_categories'],
    'Karakata\Composers\LatestItemComposer' => ['widgets._recent_items'],
    'Karakata\Composers\PremiumItemComposer' => ['widgets._premium_items'],
    'Karakata\Composers\LangChoiceComposer' => ['partials._header', 'admin.settings.edit']
]);