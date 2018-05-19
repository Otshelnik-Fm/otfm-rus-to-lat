<?php

/*

╔═╗╔╦╗╔═╗╔╦╗
║ ║ ║ ╠╣ ║║║ https://otshelnik-fm.ru
╚═╝ ╩ ╚  ╩ ╩

*/


// дополнительные символы транслитерации
function otfm_rtl_dop_simbols(){
    $dop_simbols = apply_filters('otfm_dop_symbols', array(
        "№"=>"N","#"=>"","$"=>"","%"=>"","^"=>"","&"=>"",
        //ukr
        "Ї"=>"Yi","ї"=>"i","Ґ"=>"G","ґ"=>"g",
        //kazakh
        "Ә"=>"A","Ғ"=>"G","Қ"=>"K","Ң"=>"N","Ө"=>"O","Ұ"=>"U","Ү"=>"U","H"=>"H",
        "ә"=>"a","ғ"=>"g","қ"=>"k","ң"=>"n","ө"=>"o", "ұ"=>"u","h"=>"h"
    ));

    return $dop_simbols;
}

// дополним таблицу транслита реколл (для вкладок, метакеев в полях профиля и форме публикации и заголовке - урле - прайм форума)
function otfm_rtl_transliteration_recall_add_symbols($simbols){
    $dop_simbols = otfm_rtl_dop_simbols();
    $merged_symbols = array_merge($simbols, $dop_simbols);

    return $merged_symbols;
}
add_filter('rcl_sanitize_gost', 'otfm_rtl_transliteration_recall_add_symbols');
add_filter('rcl_sanitize_iso', 'otfm_rtl_transliteration_recall_add_symbols');


// транслит заголовков ВП
add_filter('sanitize_title', 'rcl_sanitize_string', 9);


// транслит файлов ВП
function otfm_rtl_transliteration_file_name($filename){
    $dop_simbols = otfm_rtl_dop_simbols();

    $first_time = strtr($filename, $dop_simbols);                           // транслит дополнительных символов
    $translite = rcl_sanitize_string($first_time, false);                   // реколл транслит остального
    $fin_filename = preg_replace("/[^A-Za-z0-9_\-\.]/", '-', $translite);   // разрешенные символы (иероглифы и прочее не пройдет)

    return $fin_filename;
}
add_filter('sanitize_file_name', 'otfm_rtl_transliteration_file_name');
