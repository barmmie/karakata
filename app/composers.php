<?php

View::composers([
            'Enclassified\Composers\LocationComposer' => ['pages.homepage', 'categories.show', 'items.create', 'items.edit', 'items.search_result'],
            'Enclassified\Composers\CategoryComposer' => ['items.create', 'items.edit', 'admin.categories.list', 'items.search_result'],

                ]);