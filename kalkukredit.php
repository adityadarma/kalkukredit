<?php
/*
  Plugin Name: Kalkulator Kredit
  Plugin URI: https://adityadarma.dev
  Description: Updates user rating based on number of posts.
  Version: 1.0
  Author: Aditya Darma
  Author URI: https://adityadarma.dev
 */

wp_register_style ( 'cssbootstrap', plugins_url ( 'css/bootstrap.css', __FILE__ ) );
wp_register_style ( 'stylekredit', plugins_url ( 'css/style.css', __FILE__ ) );


wp_register_script ( 'jsbootstrap', plugins_url ( 'js/bootstrap.min.js', __FILE__ ) );
wp_register_script ( 'jsnumeral', plugins_url ( 'js/numeral.js', __FILE__ ) );
wp_register_script ( 'jscurformatter', plugins_url ( 'js/curFormatter.js', __FILE__ ) );
wp_register_script ( 'scriptkredit', plugins_url ( 'js/script.js', __FILE__ ) );


require_once('fungsi.php');
