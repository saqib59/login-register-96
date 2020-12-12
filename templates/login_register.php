<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(CHI_PATH.'/inc/LoginRegister96.php');

// include CHI_PATH.'/inc/';
do_action( 'lms_scripts'); 
if (!empty($_POST)) {
  if (isset($_POST['save_login'])) {
      update_option('login_form_id96', $_POST['login_form_id96']);
      update_option('uname_email_login96', $_POST['uname_email_login96']);
      update_option('pwd_login96', $_POST['pwd_login96']);
      update_option('redirect69', $_POST['redirect69']);

      echo '<div class="notice notice-success is-dismissible"><p>Record updated!</p></div>';  
  }
  if (isset($_POST['save_register'])) {
      update_option('register_form_id96', $_POST['register_form_id96']);
      update_option('uname_register96', $_POST['uname_register96']);
      update_option('email_register96', $_POST['email_register96']);
      update_option('pass_register96', $_POST['pass_register96']);
      update_option('cpass_register96', $_POST['cpass_register96']);

      echo '<div class="notice notice-success is-dismissible"><p>Record updated!</p></div>';  
  }
  if (isset($_POST['save_pages'])) {
    
      $hide_logout = (isset($_POST['hide_logout']) )? implode(",",$_POST['hide_logout']) : '';
      $hide_login = (isset($_POST['hide_login']) )? implode(",",$_POST['hide_login']) : '';
      update_option('hide_logout96', $hide_logout);
      update_option('hide_login96', $hide_login);
      echo '<div class="notice notice-success is-dismissible"><p>Record updated!</p></div>';  
  }

}
?>


<div class="row">
  <div class="col-sm-6">

<div class="card">
  <div class="card-header">
  <h3>Login Page</h3>
  <p>Write field names and form id of your login form</p>
  </div>
  <div class="card-body">
<form accept="" method="POST">
  <div class="form-group row">
    <label for="login_form_id96" class="col-sm-2 col-form-label">Form Id:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="login_form_id96"  name="login_form_id96" placeholder="" value="<?php echo get_option('login_form_id96'); ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="uname_email_login96" class="col-sm-2 col-form-label">Username or Email:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="uname_email_login96" name="uname_email_login96" value="<?php echo get_option('uname_email_login96'); ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="pwd_login96" class="col-sm-2 col-form-label">Password:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="pwd_login96" name="pwd_login96" value="<?php echo get_option('pwd_login96'); ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="redirect69" class="col-sm-2 col-form-label">Redirect After Login:</label>
    <div class="col-sm-10">
      <select class="form-control" id="redirect69" name="redirect69">
        <option value="">Select Redirect Page</option>
        <?php
        $pages = get_pages();
        foreach ($pages as $page) {
         ?>
         <option value="<?= $page->post_name;?>" <?= ((get_option('redirect69') == $page->post_name)? 'selected': ''); ?>> <?= $page->post_title; ?></option>
         <?php
        }
        ?>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="update_login96" class="col-sm-2 col-form-label"></label>
    <div class="col-sm-10">
    	<button type="submit" id="update_login96" name="save_login" class="btn btn-primary">Update</button>
    </div>
  </div>
</form>
  </div>
</div>
  </div>


  <div class="col-sm-6">

<div class="card">
  <div class="card-header">
  <h3>Registration Page</h3>
  <p>Write field names and form id of your register form</p>
  </div>
  <div class="card-body">
<form method="POST">
  <div class="form-group row">
    <label for="register_form_id96" class="col-sm-2 col-form-label">Form Id:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="register_form_id96"  name="register_form_id96" value="<?php echo get_option('register_form_id96'); ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="uname_register96" class="col-sm-2 col-form-label">Username:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="uname_register96"  name="uname_register96" value="<?php echo get_option('uname_register96'); ?>">
    </div>
  </div>
   <div class="form-group row">
    <label for="email_register96" class="col-sm-2 col-form-label">Email:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="email_register96"  name="email_register96" value="<?php echo get_option('email_register96'); ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="pass_register96" class="col-sm-2 col-form-label">Password:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="pass_register96" name="pass_register96" value="<?php echo get_option('pass_register96'); ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="cpass_register96" class="col-sm-2 col-form-label">Confirm Password:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="cpass_register96" name="cpass_register96" value="<?php echo get_option('cpass_register96'); ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
    <div class="col-sm-10">
      <button type="submit" name="save_register" class="btn btn-primary">Update</button>
    </div>
  </div>
</form>


  </div>
</div>
  </div>

   <div class="col-sm-6">

<div class="card">
  <div class="card-header">
  <h3>Restrict Pages</h3>
  <p>Write field names and form id of your login form</p>
  </div>
  <div class="card-body">
<form accept="" method="POST">
  <div class="form-group row">
    <label for="redirect69" class="col-sm-2 col-form-label">Hide when logged in</label>
    <div class="col-sm-10">
      <select class="form-control" id="hide_login" name="hide_login[]" multiple="">
        <option value="0">Select Page(s)</option>
        <?php
        $pages = get_pages();
        foreach ($pages as $page) {
         ?>
         <option value="<?= $page->post_name;?>" <?= LoginRegister96::hidden_pages_on_log_in($page->post_name); ?>> <?= $page->post_title; ?></option>
         <?php
        }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="hide_logout" class="col-sm-2 col-form-label">Hide when logged out</label>
    <div class="col-sm-10">
      <select class="form-control" id="hide_logout" name="hide_logout[]" multiple="">
        <option value="0">Select Page(s)</option>
        <?php
        $pages = get_pages();
        foreach ($pages as $page) {
         ?>
         <option value="<?= $page->post_name;?>" <?= LoginRegister96::hidden_pages_on_log_out($page->post_name); ?>> <?= $page->post_title; ?></option>
         <?php
        }
        ?>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="update_login96" class="col-sm-2 col-form-label"></label>
    <div class="col-sm-10">
      <button type="submit" id="update_login96" name="save_pages" class="btn btn-primary">Update</button>
    </div>
  </div>
</form>
  </div>
</div>
  </div>

</div>
<script type="text/javascript">
  jQuery("#hide_login").select2({
placeholder: "eg: login-register, ",
allowClear: true
});
   jQuery("#hide_logout").select2({
placeholder: "eg: profile page ,dashboard",
allowClear: true
});
</script>



