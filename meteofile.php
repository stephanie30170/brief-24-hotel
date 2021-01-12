<?php
/**
 * @package meteo
 * @version 1.7.2
 */
/*
Plugin Name: meteo
Plugin URI: https://home.openweathermap.org/myservices
Description:  
Author: steph bois
Version: 007
uo8gd0K5phbcwU21scYzccSI1FTdWzYY
*/

function SWP_pluginmeteo_btn() {
	
	$info = '<a href="http://api.openweathermap.org/data/2.5/weather?q=Ales,fr&APPID=817dee42164420fa466cedda78926e2c
	"target="_blank" class="pluginmeteo">
	</a> ' ;
	echo $info;
	
}
add_action('wp_footer','SWP_pluginmeteo_btn');
// Register style sheet.
add_action('wp_enqueue_scripts','swp_register_plugin_styles');

/**
 * Register style sheet.
 */
function swp_register_plugin_styles() {
  wp_register_style('meteo-style',plugins_url('pluginmeteo/meteo.css'));
  wp_enqueue_style('meteo-style');
}
add_action( 'wp_footer', 'meteo' );
function meteo() {
$url = 'http://api.openweathermap.org/data/2.5/weather?q=Ales&lang=fr&APPID=817dee42164420fa466cedda78926e2c';
$raw = file_get_contents($url);
$json = json_decode($raw);
$ciel = $json->weather[0]->description;
$icone = $json->weather[0]->icon;
$temp = $json->main->temp - 273.15;

    echo "
    <div class='meteo'>
        <h2>Météo</h2>
        <h3>$temp °c</h3>
        <h3>$ciel</h3>
        </div>
    ";
};
