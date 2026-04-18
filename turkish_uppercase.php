<?php
// =============================================
// PHP 7.0+ — mb_strtoupper doğrudan kullan
// mbstring PHP 7.0 ile birlikte varsayılan gelir
// *** Burada aşağıdaki test için fonksiyon kullanılmıştır isternise direkt mb_strtoupper kullanılabilir.
// =============================================
function turkish_uppercase_70(string $text): string {
    return mb_strtoupper($text, 'UTF-8');
}


// =============================================
// PHP 5.6 — mb_strtoupper var ama mbstring
// her sunucuda yüklü olmayabilir, kontrol şart
// =============================================
function turkish_uppercase_56($text) {
    if (function_exists('mb_strtoupper')) {
        return mb_strtoupper($text, 'UTF-8');
    }

    // mbstring yoksa elle çevir
    $search  = ['ı', 'i', 'ş', 'ö', 'ğ', 'ç', 'ü'];
    $replace = ['I', 'İ', 'Ş', 'Ö', 'Ğ', 'Ç', 'Ü'];
    return strtoupper(str_replace($search, $replace, $text));
}


// =============================================
// PHP 5.3 — mb_ güvenilmez, elle çeviri zorunlu
// =============================================
function turkish_uppercase_53($text) {
    $search  = array('ı', 'i', 'ş', 'ö', 'ğ', 'ç', 'ü');
    $replace = array('I', 'İ', 'Ş', 'Ö', 'Ğ', 'Ç', 'Ü');
    return strtoupper(str_replace($search, $replace, $text));
}


// =============================================
// PHP 4 — hiçbir modern özellik yok,
// array() zorunlu, type hint yok
// =============================================
function turkish_uppercase_4($text) {
    $search  = array('ı', 'i', 'ş', 'ö', 'ğ', 'ç', 'ü');
    $replace = array('I', 'İ', 'Ş', 'Ö', 'Ğ', 'Ç', 'Ü');
    $text    = str_replace($search, $replace, $text);
    return strtoupper($text);
}


// =============================================
// TEST
// =============================================
$tests = array(
    'istanbul şehri',
    'ışık ve gölge',
    'çiğdem ile ümit',
);

$methods = array(
    'PHP 7.0+' => 'turkish_uppercase_70',
    'PHP 5.6'  => 'turkish_uppercase_56',
    'PHP 5.3'  => 'turkish_uppercase_53',
    'PHP 4'    => 'turkish_uppercase_4',
);

foreach ($tests as $input) {
    echo "Girdi : " . $input . "\n";
    foreach ($methods as $label => $fn) {
        printf("  %-10s → %s\n", $label, $fn($input));
    }
    echo "\n";
}
