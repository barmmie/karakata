<?php

View::composers([
            'Enclassified\Composers\LocationComposer' => ['partials._search_cta', 'categories.show',  'items.create', 'items.edit', 'items.search_result'],
            'Enclassified\Composers\CategoryComposer' => ['items.create', 'items.edit', 'admin.categories.list', 'items.search_result'],
            'Enclassified\Composers\MessageComposer' => ['partials._user_sidebar', 'partials._header'],
            'Enclassified\Composers\FeaturedItemComposer' => ['widgets._featured_items' ],
            'Enclassified\Composers\PopularCategoryComposer' => ['widgets._popular_categories' ],
            'Enclassified\Composers\LatestItemComposer' => ['widgets._recent_items' ],
                ]);