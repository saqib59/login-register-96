<?php
ini_set('max_execution_time', 0);

class LoginRegister96{

    public $loginregister96_login = array();
    public $loginregister96_register = array();

        function __construct(){
            add_action( 'wp_enqueue_scripts', array($this , 'login_register96_scripts') );
            add_action('admin_enqueue_scripts',array($this, 'login_register96_scripts'));
            add_action('get_header',array($this, 'redirect_home_if_log_out'));
            add_action('get_header',array($this, 'redirect_home_if_log_in'));

      }
          public function login_register96_scripts(){
           wp_enqueue_script( 'sweet-alert', 'https://cdn.jsdelivr.net/npm/sweetalert2@9','','',true);
           wp_enqueue_script( 'global-css', CHI_URL.'/assets/css/global.css');
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
      public static function hidden_pages_on_log_in($page_slug){
           $hidden_when_login =  explode(",",get_option('hide_login96'));
           if (in_array($page_slug, $hidden_when_login)){
              return "selected";
          }
      }
      public static function hidden_pages_on_log_out($page_slug){
           $hidden_when_login =  explode(",",get_option('hide_logout96'));
           if (in_array($page_slug, $hidden_when_login)){
              return "selected";
          }
      }
      public function redirect_home_if_log_out(){
            $current_user_id = get_current_user_id();
            $pages =  explode(",",get_option('hide_logout96'));
                foreach ($pages as $index => $page_slug) {
                if (is_page($pages[$index]) && $current_user_id == 0) {
                    wp_redirect(home_url());
                }
            }
        }

        public function redirect_home_if_log_in(){
           $current_user_id = get_current_user_id();;
           $pages =  explode(",",get_option('hide_login96'));
                foreach ($pages as $index => $page_slug) {
                if (is_page($pages[$index]) && $current_user_id != 0) {
                    wp_redirect(home_url());
                }
            }
        }

}
$LoginRegister96 = new LoginRegister96();