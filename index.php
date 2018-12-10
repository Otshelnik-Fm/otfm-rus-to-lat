<?php

/*

╔═╗╔╦╗╔═╗╔╦╗
║ ║ ║ ╠╣ ║║║ https://otshelnik-fm.ru
╚═╝ ╩ ╚  ╩ ╩

*/

/*
 *      Доп заменяет ВП транслит:
 *          заголовков (записей, меток, рубрик)
 *          имена загружаемых файлов - в транслит
 *      WP-Recall транслит уже есть в ядре плагина. Он там уже в транслит переводит:
 *          слаги произвольных вкладок
 *          полей профиля (metakey)
 *          поля в форме публикации (metakey)
 *          все что надо для primeForum
 *      Дополнение для реколл дает фильтр - можно расширить таблицу символов и их транслит
 *          - полезно для других языковых групп
 */

if (!defined('ABSPATH')) exit;

// дополнительные символы транслитерации
function otfm_rtl_dop_simbols(){
    $dop_allowed = array(
        "№"=>"N","#"=>"","$"=>"","%"=>"","^"=>"","&"=>"",
        //ukr
        "Ї"=>"Yi","ї"=>"i","Ґ"=>"G","ґ"=>"g",
        //kazakh
        "Ә"=>"A","Ғ"=>"G","Қ"=>"K","Ң"=>"N","Ө"=>"O","Ұ"=>"U","Ү"=>"U","H"=>"H",
        "ә"=>"a","ғ"=>"g","қ"=>"k","ң"=>"n","ө"=>"o", "ұ"=>"u","h"=>"h"
    );
    $dop_simbols = apply_filters('otfm_dop_symbols', $dop_allowed);

    return $dop_simbols;
}


function otfm_rtl_settings(){
    $chr_page = get_current_screen();

    if($chr_page->base != 'wp-recall_page_rcl-options') return;
    if( isset($_COOKIE['otfmi_1']) && isset($_COOKIE['otfmi_2']) && isset($_COOKIE['otfmi_3']) )  return;

    require_once 'admin/for-settings.php';
}
add_action('admin_footer', 'otfm_rtl_settings');



// дополним таблицу транслита реколл
// применимо: для вкладок, метакеев в полях профиля и форме публикации и заголовке - урле - прайм форума)
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
