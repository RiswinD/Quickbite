<?php
function getCurrentLanguage() {
    $languages = ['en' => 'English', 'ta' => 'தமிழ்', 'hi' => 'हिन्दी'];
    $default = 'en';
    
    if (isset($_GET['lang']) && array_key_exists($_GET['lang'], $languages)) {
        $_SESSION['lang'] = $_GET['lang'];
        return $_SESSION['lang'];
    }
    
    return isset($_SESSION['lang']) ? $_SESSION['lang'] : $default;
}

function getMenuData($category) {
    // In a real app, this would come from a database
    static $menu_items = [
        'coffee' => [
            // Your coffee items array
        ],
        'tea' => [
            // Your tea items array
        ],
        'milkshake' => [
            // Milkshake items
        ],
        'juice' => [
            // Juice items
        ]
    ];
    
    return $menu_items[$category] ?? [];
}

function getPageTitle($category) {
    $titles = [
        'coffee' => [
            'en' => 'Premium Coffees - Quickbite',
            'ta' => 'பிரீமியம் காபிகள் - Quickbite',
            'hi' => 'प्रीमियम कॉफी - Quickbite'
        ],
        'tea' => [
            'en' => 'Authentic Teas - Quickbite',
            'ta' => 'உண்மையான தேயிலைகள் - Quickbite',
            'hi' => 'प्रामाणिक चाय - Quickbite'
        ],
        // Add other categories
    ];
    
    $lang = getCurrentLanguage();
    return $titles[$category][$lang] ?? $titles[$category]['en'];
}
?>