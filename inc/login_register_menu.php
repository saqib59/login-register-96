<?php 
 function login_register_main_menu(){require CHI_PATH.'/templates/login_register.php';}
add_action('lms_scripts', 'lms_scripts_styles');
function lms_scripts_styles(){
	echo '<link rel="stylesheet" href="'.CHI_URL.'assets/css/bootstrap.css">';
}
add_action("admin_menu", "cspd_imdb_options_submenu");
function cspd_imdb_options_submenu() {
  add_submenu_page(
        'options-general.php',
        'Login Register 96',
        'Login Register 96',
        'administrator',
        'login-register-96',
        'login_register_main_menu' );
}

