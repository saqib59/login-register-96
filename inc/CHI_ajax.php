<?php
class ajax_96{

		public $redirect_page;
	function __construct(){
		$this->redirect_page = get_option('redirect69');
		add_action( "wp_ajax_login_form96", array($this, 'login_form96'), 10 );
		add_action( "wp_ajax_nopriv_login_form96", array($this, 'registration'), 10 );

		add_action( "wp_ajax_register_form96", array($this, 'register_form96'), 10 );
		add_action( "wp_ajax_nopriv_register_form96", array($this, 'register_form96'), 10 );

	}
	function login_form96(){
		$username_email = $_POST['uname_email'];
    	$user_password = $_POST['pass'];

    if (empty($username_email)) {
        $emailErr      = "Email/User Login is required";
        $err['error']  = $emailErr;
        $err['status'] = false;
    } 
    else {
        $username_email = user_system_test_input($username_email);
        // check if e-mail address is well-formed
        if (!filter_var($username_email, FILTER_VALIDATE_EMAIL)) {
            // it's not a email
            $userlogin_emailStatus = true;
        } else {
            // it's not a login
            $userlogin_emailStatus = false;
        }
    }

    //password
    if (empty($user_password)) {
        $passwordErr   = "Password is required";
        $err['error']  = $passwordErr;
        $err['status'] = false;
    } else {
        $user_password = user_system_test_input($user_password);
    }

    //REMEMBER ME
    if (isset($_POST['user_system_remember'])) {
        $remember_me = true;
    } else {
        $remember_me = false;
    }
    if ($userlogin_emailStatus == true) {
        $get_user = get_user_by('login', $username_email);
    } else {
        $get_user = get_user_by('email', $username_email);
    }
    $user_role = $get_user->roles[0];
    if ($user_role == 'subscriber') {

        //$get_user = get_user_by( 'email', $shears_email );
        if ($get_user != false) {

        // echo "<pre>".var_dump($user_role)."</pre>";
        if (wp_check_password($user_password, $get_user->data->user_pass, $get_user->ID)) {
            $creds = array(
                'user_login' => $get_user->data->user_login,
                'user_password' => $user_password,
                'remember' => $remember_me
            );
            $user  = wp_signon($creds, false);
            if (is_wp_error($user)) {
                $passwordErr   = "Can't login";
                $err['error']  = $passwordErr;
                $err['status'] = false;
            } else {
                $redirect_dashboard  = home_url('/'.$this->redirect_page);
                $err['status']       = true;
                $err['redirect_url'] = $redirect_dashboard;
            }
        } 
        else {
            $passwordErr   = "Password is inncorrect";
            $err['error']  = $passwordErr;
            $err['status'] = false;
        }
      
    } else {
        $emailErr      = "User with this email doesn't exists";
        $err['error']  = $emailErr;
        $err['status'] = false;
    }
}
    else{
        $emailErr      = "User with this email doesn't exists";
        $err['error']  = $emailErr;
        $err['status'] = false;
    }

    return $this->response_json($err);
    
	}
	function register_form96(){
		$username = $_POST['uname'];
		$email = $_POST['uemail'];
		$upass = $_POST['upass'];

    if (empty($username) || empty($upass) ) {
         $response = array(
                    "message" =>"Fill out all required fields",
                    "error" => true
                );
    }
    if (email_exists(trim($email)) && !empty($email)) {
        $response = array(
                    "message" =>"The Email you enetered is already registered, Try another one.",
                    "error" => true
                );
    }
    if (username_exists(trim($username)) && !empty($username)) {
        $response = array(
                    "message" =>"Username , you enetered is already registered, Try another one.",
                    "error" => true
                );
    }
    else{
            /** FORM REGISTRATION  **/
            if (empty($email)) {
            	$userdata = array(
		            'user_login' => $username,
		            'user_pass' => $upass, // When creating a new user, `user_pass` is expected.
		            'role' => 'subscriber'
		        );
            }
            else{
            	$userdata = array(
		            'user_login' => $username,
		            'user_pass' => $upass, // When creating a new user, `user_pass` is expected.
		            'user_email' => $email,
		            'role' => 'josh-user'
		        );
            }
            
        $user_id  = wp_insert_user($userdata);
          $creds = array(
                'user_login' => $username,
                'user_password' => $upass
            );
            $user  = wp_signon($creds, false);
            if (is_wp_error($user)) {
                $passwordErr   = "Can't login";
                $response['error']  = $passwordErr;
                $response['status'] = false;
                //return $user->get_error_message();
            } else {
                $response['status']       = true;
                $response['message']       = "User Registered";
                $response['redirect_url'] = home_url().'/'.$this->redirect_page;
            } 
       
    }
        return $this->response_json($response);

	}
	function response_json($data){
		header('Content-Type: application/json');
	    echo json_encode($data);
	    wp_die();
	}
}
new ajax_96();
