<?php

return [

    'mode' => 'utf-8',
    'format' => 'A4',
    'default_font_size' => '12',
    'default_font' => 'sans-serif',
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_top' => 10,
    'margin_bottom' => 10,
    'margin_header' => 0,
    'margin_footer' => 0,
    'orientation' => 'P',
    'title' =>env('APP_NAME'),
    'author' => env('APP_NAME'),
    'watermark' => '',
    'show_watermark' => false,
    'watermark_font' => 'sans-serif',
    'display_mode' => 'fullpage',
    'defaultCSS ' => '',
    'watermark_text_alpha' => 0.1,
    'custom_font_dir' => base_path('storage/fonts/'), // don't forget the trailing slash!
    'custom_font_data' => [
        'SolaimanLipi' => [
            'R' => 'SolaimanLipi.ttf',    // regular font
            'B' => 'SolaimanLipi_Bold_10-03-12.ttf',       // optional: bold font
            //'I'  => 'ExampleFont-Italic.ttf',     // optional: italic font
            //'BI' => 'ExampleFont-Bold-Italic.ttf' // optional: bold-italic font
            'useOTL' => 0xFF,
        ],
        'Nikosh' => [
            'R' => 'Nikosh.ttf',    // regular font
            'useOTL' => 0xFF,
        ],
        'kalpurush' => [
            'R' => 'kalpurush.ttf',    // regular font
            'useOTL' => 0xFF,
        ],
        'NikoshBAN' => [
            'R' => 'NikoshBAN.ttf',    // regular font
            'useOTL' => 0xFF,
        ],
        'NikoshLight' => [
            'R' => 'NikoshLight.ttf',    // regular font
            'useOTL' => 0xFF,
        ],
        // ...add as many as you want.
    ],
    'auto_language_detection' => false,
    'temp_dir' => rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR),
    'pdfa' => false,
    'pdfaauto' => false,
    'use_active_forms' => false,
];
?>
