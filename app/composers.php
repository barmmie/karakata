<?php

View::composers([
            'Enclassified\Composers\LocationComposer' => ['categories.show', 'items.create', 'items.edit'],
            'Enclassified\Composers\CategoryComposer' => ['items.create', 'items.edit', 'admin.categories.list'],

                ]);