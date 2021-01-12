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
uo8gd0K5phbcwU21scYzccSI1FTdWzYY*/

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

$curl = curl_init('http://api.openweathermap.org/data/2.5/weather?q=Ales&lang=fr&APPID=817dee42164420fa466cedda78926e2c');

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$data =curl_exec($curl);

if($data===false){
var_dump(curl_error($curl));
}
else{

$data = json_decode($data,true);
$weather = $data['weather'][0]['description'];
$temp = $data['main']['temp']- 273.15;
    
/*echo 
       '<h3>'.'la météo : '.'la température est de '.$temp.'°C'.' et '.
       $weather.'</h3>';*/
/*echo '<pre>';
var_dump($data);
echo'<pre>';*/
    echo "
    <div class='meteo'>
        <h2>Bonjour, voici la Météo :</h2>
        <h3>la temperature est $temp °c</h3>
        <h3>$weather</h3>
        <h5>j'ai eu l'honneur d'élaborer ce plugin météo en 25 jours,
         je tiens à remercier mon formateur Jérémie, alias 'le 
        tortionnaire'</h5>
        </div>
    ";
}

curl_close($curl);
}
