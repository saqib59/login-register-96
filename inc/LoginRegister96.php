<?php
ini_set('max_execution_time', 0);

class LoginRegister96{

    public $loginregister96_login = array();
    public $loginregister96_register = array();

    function __construct(){
        add_action( 'wp_enqueue_scripts', array($this , 'login_register96_scripts') );
        add_action('admin_enqueue_scripts',array($this, 'login_register96_scripts'));
        
  }
  public function login_register96_scripts(){
   wp_enqueue_script( 'sweet-alert', 'https://cdn.jsdelivr.net/npm/sweetalert2@9','','',true);
    wp_enqueue_script( 'jquery-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js','','',true);
    wp_enqueue_script( 'main-script96', CHI_URL.'/assets/js/main-script.js', '', '', true );
    
    $this->loginregister96_login['login_form_id96'] = get_option( 'login_form_id96' );
    $this->loginregister96_login['uname_email_login96'] = get_option( 'uname_email_login96' );
    $this->loginregister96_login['pwd_login96'] = get_option( 'pwd_login96' );

    $this->loginregister96_register['register_form_id96'] = get_option( 'register_form_id96' );
    $this->loginregister96_register['uname_register96'] = get_option( 'uname_register96' );
    $this->loginregister96_register['email_register96'] = get_option( 'email_register96' );
    $this->loginregister96_register['pass_register96'] = get_option( 'pass_register96' );
    $this->loginregister96_register['cpass_register96'] = get_option( 'cpass_register96' );

    wp_localize_script('main-script96', 'object96',
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'loginregister96_login_cred' => $this->loginregister96_login,
            'loginregister96_register_cred' => $this->loginregister96_register,
        )
    );
    ?>
    <?php

  }

}
$LoginRegister96 = new LoginRegister96();