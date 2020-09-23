<?php

return [

    // plugin
    'plugin' => [
        'name' => 'Blog Taxonomy',
        'description' => 'Přidává tagy a správu sérií pro články blogu RainLab',
    ],

    'labels' => [
        'authors' => 'Autoři',
        'name' => 'Jméno',
        'surname' => 'Příjmení',
        'mail' => 'E-mail',
        'function' => 'Funkce',
        'image' => 'Obrázek',
        'description' => 'Popis',
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
        'twitter' => 'Twitter',
        'linkedin' => 'LinkedIn',
        'created_at' => 'Vytvořeno dne',
        'updated_at' => 'Změněno dne',
        'author' => 'Patron',
        'choose_author' => '--- Vyberte patrona',
    ],

    'return_to_questions' => 'Zpátky na série',

    // form
    'form' => [
        'errors' => [
            'unknown' => 'Nastala neznámá chyba'
        ],
        'reorder' => 'Změňte pořadí záznamů',
        'fields' => [
            'tag' => 'Tag',
            'title' => 'Titulek',
            'images' => 'Obrázky',
            'slug' => 'Slug',
            'description' => 'Popis',
            'posts' => 'Články',
            'series' => 'Série',
            'status' => 'Status',
            'related_series' => 'Související série'
        ],
        'tabs' => [
            'general' => 'Všeobecné',
            'posts' => 'Články',
            'series' => 'Série',
            'related_series' => 'Související série'
        ],

        'categories' => [
            'no_posts_in_categories' => 'V této kategorii nejsou žádné články'
        ],
        'tags' => [
            'label' => 'Tagy',

            'create_title' => 'Vytvořte nový tag',
            'edit_title' => 'Upravte tag ":tag"',
            'list_title' => 'Spravovat Tagy',
            'new_tag_label' => 'Nový Tag',
            'no_tags_message' => 'Nejsou žádné tagy. Začněte tím, že si nějaké vytvoříte',
            'tag_does_not_exist' => 'Tag neexistuje',
            'no_posts_with_such_tag' => 'S tímto tagem nejsou žádné články',
            'no_series_with_such_tag' => 'S tímto tagem nejsou žádné série',

            'delete_confirm' => 'Opravdu chcete tento tag smazat?',
            'remove_orphaned_load_indicator' => 'Odebírání nepoužívaných tagů...',
            'remove_orphaned_label' => 'Odebrat Nepoužívané Tagy',
            'remove_orphaned_confirm' => 'Opravdu chcete odebrat nepoužíváné tagy?',
            'no_orphaned_tags' => 'Neexistují žádné nepoužíváné tagy',
            'remove_orphaned_tags_success' => 'Nepoužíváné tagy byly úspěšně odebrány',
            'delete_bulk_confirm' => 'Opravdu chcete odstranit vybrané tagy?',
            'delete_tags_success' => 'Tagy byly úspěšně smazány',

            'comment_post' => 'Vyberte tagy, které se na články vztahují',
            'comment_series' => 'Vyberte tagy, které jsou použitelné pro sérii',

            'name_invalid' => 'Názvy tagů mohou obsahovat pouze alfanumerické znaky, mezery, spojovníky a určitou interpunkci',
            'name_required' => 'Pole názvu tagu je povinné',
            'name_unique' => 'Tento název tagu je již obsazen',
            'name_too_short' => 'Minimální délka názvu tagu je :min',

            'slug_invalid' => 'Slugy tagů mohou obsahovat pouze alfanumerické znaky, mezery a pomlčky',
            'slug_required' => 'Slug tagu je povinný',
            'slug_unique' => 'Tentto slug tagu je již obsazena',
            'slug_too_short' => 'Minimální délka slugu tagu je :min',

            'return_to_list' => 'Zpět na seznam tagů',
            'create_load_indicator' => 'Vytváření tagu...',
            'update_load_indicator' => 'Aktualizace tagu...',
            'delete_load_indicator' => 'Odstraňování tagu...',
            'new_series_button_label' => 'Nový Tag',
            'create_button_label' => 'Vytvořit',
            'save_button_label' => 'Uložit',
            'create_and_close_button_label' => 'Vytvořit a Zavřít',
            'save_and_close_button_label' => 'Uložit a Zavřít',
            'cancel_button_label' => 'Zrušit',
            'or' => 'nebo',
        ],
        'series' => [
            'label' => 'Série',
            'description' => 'Popis',
            'status' => 'Status',

            'create_title' => 'Vytvořit Sérii',
            'edit_title' => 'Změnit sérii ":series"',
            'list_title' => 'Spravovat Série',
            'series_does_not_exist' => 'Tato série neexistuje',
            'no_series_message' => 'Nejsou žádné série. Začněte tím, že si nějaké vytvoříte',
            'no_posts_in_series' => 'V této sérii nejsou žádné články',
            'comment' => 'Vyberte sérii, do které blogový články patří',

            'title_invalid' => 'Názvy sérií mohou obsahovat pouze alfanumerické znaky, mezery, spojovníky a určitou interpunkci',
            'title_required' => 'Pole názvu série je povinné',
            'title_unique' => 'Tento název série je již použit',
            'title_too_short' => 'Minimální délka názvu série je :min',

            'slug_invalid' => 'Slugy série mohou obsahovat pouze alfanumerické znaky, mezery a pomlčky',
            'slug_required' => 'Slug série je povinný',
            'slug_unique' => 'Tento slug již byl použit',
            'slug_too_short' => 'Minimální délka pro slug série je :min',

            'create_load_indicator' => 'Vytváření série...',
            'update_load_indicator' => 'Aktualizace série...',
            'delete_load_indicator' => 'Odstraňování série...',
            'delete_confirm' => 'Opravdu chcete smazat tuto sérii?',
            'delete_bulk_confirm' => 'Opravdu chcete smazat vybrané série?',
            'delete_series_success' => 'Série byla úspěšně smazána',
            'new_series_button_label' => 'Nové Série',
            'create_button_label' => 'Vytvořit',
            'save_button_label' => 'Uložit',
            'create_and_close_button_label' => 'Vytvořit a Zavřít',
            'save_and_close_button_label' => 'Uložit a Zavřít',
            'cancel_button_label' => 'Zrušit',
            'or' => 'nebo',
            'return_to_list' => 'RZpátky na seznam sérií'
        ]
    ],

    'list' => [
        'columns' => [
            'title' => 'Titul',
            'posts' => 'Články',
            'series' => 'Série',
            'tag' => 'Tag',
            'tags' => 'Tagy',
            'status' => 'Status',
            'slug' => 'Slug'
        ]
    ],

    // navigation
    'navigation' => [
        'tags' => 'Tagy',
        'series' => 'Série',
        'taxonomy' => 'Taxonomy'
    ],

    // placeholders
    'placeholders' => [
        'tags' => 'Přidat tagy...',
        'series' => 'Vybrat série...',
        'categories' => 'Přidat kategorie...',
        'title' => 'Zadat titul...',
        'name' => 'Zadat jméno...',
        'slug' => 'Zadat slug...',
        'no_posts_available' => 'Žádné články nejsou k dispozici',
        'no_series_available' => 'Nejsou k dispozici žádné série'
    ],

    // component-specific strings
    'components' => [
        'partials' => [
            'published_in' => 'publikováno v',
            'displaying_number_of_posts' => 'Zobrazeno %d z %d článků',
            'viewing_page_of' => 'Prohlížení stránky %d z %d',
            'pagination_back' => 'Zpátky',
            'pagination_next' => 'Dopředu'
        ],
        'series_posts' => [
            'name' => 'Články v sérii',
            'description' => 'Seznam všech článků v dodávané sérii',
            'series_title' => 'Slug série',
            'series_description' => 'Vyhledejte sérii pomocí dodané hodnoty slugu z tohoto parametru URL',
            'posts_in_series' => 'Články zahrnuté do série',
            'no_posts_message' => 'Žádné články v sérii'
        ],
        'tag_list' => [
            'name' => 'Seznam Tagů',
            'description' => 'Zobrazit seznam tagů',

            'display_empty_title' => 'Zobrazit prázdné tagy',
            'display_empty_description' => 'Zobrazit tagy, které nebyly přiřazeny k žádným článkům',

            'order_title' => 'Seřadit Tagy',
            'order_description' => 'Jak by měly být tagy seřazeny',

            'tag_page_title' => 'Stránka Tagu',
            'tag_page_description' => 'Stránka, na které je zobrazen obsah jednoho tagu',

            'tags_page_title' => 'Stránka Tagů',
            'tags_page_description' => 'Stránka, na které jsou všechny tagy',

            'post_slug_title' => 'Slug článku',
            'post_slug_description' => 'Získejte tagy pro články určený hodnotou slugu z parametru URL',
            'fetch_posts_title' => 'Načíst označené články',
            'fetch_posts_description' => 'Načte označené články, aby byly k dispozici jako vlastnost `článků` položky tagu. Zpomaluje výkon',
            'include_series_tags_title' => 'Zahrnout tagy série',
            'include_series_tags_description' => 'Kromě toho obsahuje tagy použité na sérii článků, pokud má článek sérii a série obsahuje tagy',
            'fetch_series_post_count_title' => 'Načíst počet článků série',
            'fetch_series_post_count_description' => 'Dále načte počet článků, které patří do sérií označených tímto tagem',

            'no_tags_message' => 'Nebyly nalezeny žádné tagy',
            'all_tags_link' => 'Ukázat vše',

            'limit_validation_message' => 'Limit tagů musí být platné nezáporné celé číslo',

            'limit_group' => 'Limit',

            'limit_title' => 'Limit',
            'limit_description' => 'Počet tagů k zobrazení, 0 načte všechny tagy',
            'expose_total_count_title' => 'Zobrazit celkový počet',
            'expose_total_count_description' => 'Počítejte, zda je celkový počet tagů nebo počet tagů pouze pod „limitem“',
            'tag_filter_title' => 'Zahrnout filtr tagů',
            'tag_filter_description' => 'Zda zahrnout vstup filtru tagu nebo ne',

            'tag_filter_options' => [
                'never' => 'Nikdy',
                'always' => 'Vždy',
                'on_overflow' => 'Když celkový počet značek > limit'
            ],

            'special_group' => 'Speciální',
            'debug_output_title' => 'Debug výstupu',
            'debug_output_description' => 'Umožňuje povolit výstup ladění do konzoly prohlížeče. Záleží na tématu'
        ],
        'tag_posts' => [
            'name' => 'Články s tagem',
            'description' => 'Uvádí seznam všech článků s dodaným tagem',
            'no_posts_message' => 'Žádné články s tímto tagem',
            'posts_with_tag' => 'Články s tagem',
            'tag_title' => 'Slug tagu',
            'tag_description' => 'Vyhledejte tag pomocí zadané hodnoty slugu z tohoto parametru adresy URL',
            'include_series_posts_title' => 'Zahrnout články série',
            'include_series_posts_description' => 'Dále zahrňte články, které patří do série označené aktuálním tagem'
        ],
        'series_navigation' => [
            'name' => 'Navigace pro série článků',
            'description' => 'Poskytuje navigaci v rámci série pro jeden článek',

            'series_page_title' => 'Stránka Série',
            'series_page_description' => 'Stránka, na které se zobrazuje obsah jedné série',

            'post_slug_title' => 'Slug Článků',
            'post_slug_description' => 'Získejte navigaci v sérii pro článek určený hodnotou slugu z parametru URL',

            'links_group' => 'Odkazy',
            'part_of_a_series' => 'Tento článek je součástí série s názvem'
        ],
        'series_list' => [
            'name' => 'Seznam sérií',
            'description' => 'Zobrazí seznam sérií',

            'series_page_title' => 'Stránka Sérií',
            'series_page_description' => 'Stránka, na které se zobrazuje obsah jedné série',

            'series_slug_title' => 'Slug parametr Série',
            'series_slug_description' => 'Nastavení se musí rovnat parametru slugu používaného pro stránku Series (př. /blog/series/:series Vám dá :series)',

            'fetch_posts_title' => 'Načíst související články',
            'fetch_posts_description' => 'Načte související články, aby byly k dispozici jako vlastnost `článků` položky série. Zpomaluje výkon',

            'limit_title' => 'Limit',
            'limit_description' => 'Počet zobrazených sérií, 0 načte všechny série',

            'display_empty_title' => 'Zobrazit prázdnou sérii',
            'display_empty_description' => 'Zobrazit seriály, ke kterým nejsou přiřazeny žádné články',

            'order_title' => 'Pořadí Sérií',
            'order_description' => 'Jak by měl být seřazen seznam sérií',

            'no_series_message' => 'Nebyla nalezena žádná série',

            'limit_validation_message' => 'Limit série musí být platné nezáporné celé číslo'
        ],
        'related_posts' => [
            'name' => 'Související články',
            'description' => 'Poskytuje seznam článků souvisejících s tagy',

            'post_slug_title' => 'Slug článku',
            'post_slug_description' => 'Získejte související články pro článek určený hodnotou slugu z parametru URL',

            'limit_title' => 'Limit',
            'limit_description' => 'Počet článků k zobrazení, 0 načte všechny související články',
            'limit_validation_message' => 'Limit souvisejících článků musí být platné nezáporné celé číslo',

            'no_posts_message' => 'Nebyly nalezeny žádné související články',
            'related_posts' => 'Související články',
            'links_group' => 'Odkazy'
        ],
        'related_series' => [
            'name' => 'Související Série',
            'description' => 'Získá správně vyplněný seznam souvisejících sérií',
            'no_series_message' => 'Žádné související série',
        ],
        'post_list_abstract' => [
            'pagination_group' => 'Stránkování',
            'page_parameter_title' => 'Parametr stránky',
            'page_parameter_description' => 'Vypočítejte stránkování na základě tohoto parametru URL',
            'pagination_per_page_title' => 'Položky na stránce',
            'pagination_per_page_description' => 'Kolik položek (pokud existují) by se mělo zobrazit na stránce',
            'links_group' => 'Odkazy',
            'pagination_validation_message' => 'Číslo na stránku musí být platné nezáporné celé číslo',
            'filters_group' => 'Filtry',
            'include_categories_title' => 'Zahrnout kategorie',
            'include_categories_description' => 'Uveďte ID kategorie nebo slug oddělené čárkou, abyste je mohli zahrnout. Tato možnost zahrnuje pouze uvedené kategorie. Ale stále je lze odmítnout pomocí možnosti výjimky',
            'except_posts_title' => 'Nezahrnovat články',
            'except_posts_description' => 'Uveďte ID článků nebo slug oddělené čárkou, abyste je vyloučili ze seznamu',
            'except_categories_title' => 'Nezahrnovat kategiorie',
            'except_categories_description' => 'Chcete-li vyloučit články ze seznamu, uveďte ID kategorie nebo slug oddělené čárkou',
        ]
    ],

    // order-by options
    'order_options' => [
        'created_at_asc' => 'Vytvořeno (vzestupně)',
        'created_at_desc' => 'Vytvořeno (sestupně)',

        'name_asc' => 'Jméno (vzestupně)',
        'name_desc' => 'Jméno (sestupně)',

        'published_at_asc' => 'Publikováno (vzestupně)',
        'published_at_desc' => 'Publikováno (sestupně)',

        'post_count_asc' => 'Počet příspěvků (vzestupně)',
        'post_count_desc' => 'Počet příspěvků (sestupně)',

        'random' => 'Náhodný',

        'relevance_asc' => 'Relevance (vzestupně)',
        'relevance_desc' => 'Relevance (sestupně)',

        'title_asc' => 'Titul (vzestupně)',
        'title_desc' => 'Titul (sestupně)',

        'updated_at_asc' => 'Aktualizováno (vzestupně)',
        'updated_at_desc' => 'Aktualizováno (sestupně)',
    ]
];
