<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 *  ╔═╗╔╦╗╔═╗╔╦╗
 *  ║ ║ ║ ╠╣ ║║║ https://otshelnik-fm.ru
 *  ╚═╝ ╩ ╚  ╩ ╩
 *
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
// дополнительные символы транслитерации
function otfm_rtl_character_table_extension() {
	$ext_allowed = array(
		// symb
		"№"	 => "N", "#"	 => "", "$"	 => "", "%"	 => "", "^"	 => "", "&"	 => "",
		//ukr
		"Ї"	 => "Yi", "ї"	 => "i", "Ґ"	 => "G", "ґ"	 => "g",
		//kazakh
		"Ә"	 => "A", "Ғ"	 => "G", "Қ"	 => "K", "Ң"	 => "N", "Ө"	 => "O", "Ұ"	 => "U", "Ү"	 => "U", "H"	 => "H",
		"ә"	 => "a", "ғ"	 => "g", "қ"	 => "k", "ң"	 => "n", "ө"	 => "o", "ұ"	 => "u", "h"	 => "h"
	);
	$all_simbols = apply_filters( 'otfm_dop_symbols', $ext_allowed );

	return $all_simbols;
}

add_action( 'admin_footer', 'otfm_rtl_settings' );
function otfm_rtl_settings() {
	$chr_page = get_current_screen();

	if ( $chr_page->base != 'wp-recall_page_rcl-options' )
		return;
	if ( isset( $_COOKIE['otfmi_1'] ) && isset( $_COOKIE['otfmi_2'] ) && isset( $_COOKIE['otfmi_3'] ) )
		return;

	require_once 'admin/for-settings.php';
}

// дополним таблицу транслита реколл
// применимо: для вкладок, метакеев в полях профиля и форме публикации и заголовке - урле - прайм форума)
function otfm_rtl_transliteration_recall_add_symbols( $simbols ) {
	$ext_simbols = otfm_rtl_character_table_extension();
	$all_simbols = array_merge( $simbols, $ext_simbols );

	return $all_simbols;
}

add_filter( 'rcl_sanitize_gost', 'otfm_rtl_transliteration_recall_add_symbols' );
add_filter( 'rcl_sanitize_iso', 'otfm_rtl_transliteration_recall_add_symbols' );
// транслит заголовков ВП
function otfm_rtl_transliteration_title( $title, $raw_title, $context ) {
	if ( $context === 'query' )
		return $title;

	$new_name = otfm_rtl_process( $title );

	return $new_name;
}

add_filter( 'sanitize_title', 'otfm_rtl_transliteration_title', 9, 3 );
// транслит файлов ВП
function otfm_rtl_transliteration_file_name( $filename ) {
	$new_filename = otfm_rtl_process( $filename );

	return $new_filename;
}

add_filter( 'sanitize_file_name', 'otfm_rtl_transliteration_file_name' );
function otfm_rtl_process( $need_translit ) {
	$transliteration	 = rcl_sanitize_string( $need_translit, false ); // реколл транслит остального.
	$fin_transliteration = preg_replace( '/[^A-Za-z0-9_\-\.]/', '-', $transliteration );  // разрешенные символы (иероглифы и прочее не пройдет).

	return $fin_transliteration;
}
