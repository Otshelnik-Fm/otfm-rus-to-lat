<?php

// транслит заголовков
add_filter('sanitize_title', 'rcl_sanitize_string', 9);

// транслит файлов
function otfm_transliteration_file_name($filename){
    $dop_simbols = array(
        "№"=>"N","#"=>"","$"=>"","%"=>"","^"=>"","&"=>"",
        //ukr
        "Ї"=>"Yi","ї"=>"i","Ґ"=>"G","ґ"=>"g",
        //kazakh
        "Ә"=>"A","Ғ"=>"G","Қ"=>"K","Ң"=>"N","Ө"=>"O","Ұ"=>"U","Ү"=>"U","H"=>"H",
        "ә"=>"a","ғ"=>"g","қ"=>"k","ң"=>"n","ө"=>"o", "ұ"=>"u","h"=>"h"
    );
    
    $first_time = strtr($filename, $dop_simbols);                           // транслит дополнительных символов
    $translite = rcl_sanitize_string($first_time, false);                   // реколл транслит остального
    $fin_filename = preg_replace("/[^A-Za-z0-9_\-\.]/", '-', $translite);   // разрешенные символы (иероглифы и прочее не пройдет)
    
    return $fin_filename;
}
add_filter('sanitize_file_name', 'otfm_transliteration_file_name');

