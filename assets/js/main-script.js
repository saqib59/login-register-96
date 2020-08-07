(function($){

	// Login Form Credebtials
	var loginform_id96 = object96.loginregister96_login_cred.login_form_id96;
	var uname_email_login96 = object96.loginregister96_login_cred.uname_email_login96;
	var pwd_login96 = object96.loginregister96_login_cred.pwd_login96;
	$(loginform_id96).submit(function(event) {
    event.preventDefault();

    var validation = {rules:{}, messages:{}} // fill in normal rules if there are any.

	validation.rules[uname_email_login96 ] = {required: true}
	validation.messages[uname_email_login96 ] = "Please Enter Your Username or Email"
	validation.rules[pwd_login96 ] = {required: true}
	validation.messages[pwd_login96 ] = "Please Enter your password"

	$(this).validate(validation)

    var valid = $(this).valid();
    if (valid) {
      	$("button[type=submit]").append('<i class="fa fa-circle-o-notch fa-spin" style="font-size:20px"></i>');
    	$("button[type=submit]").prop("disabled",true);
    	var uname_email_login96_value = $('input[name='+uname_email_login96+']').val();
    	var pwd_login96_value = $('input[name='+pwd_login96+']').val();
            $.ajax({
                type:"POST",
                url: object96.ajax_url,
                data: {"uname_email":uname_email_login96_value,"pass":pwd_login96_value,"action":"login_form96"},
                dataType : 'json',
              success: function (response) {
          	    	$("button[type=submit]").children().remove();
					$("button[type=submit]").prop("disabled",false);
                    console.log(response);
                    var error = response.status;
                    if (error) { 
                        window.location.href = response.redirect_url;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: response.error,
                            });
                       // console.log(response);
                    }
                },
            	error: function (errorThrown) {
                        console.log(errorThrown);
                    },
            });
    }
      
  });

	// Register Form Credebtials
	var registerform_id96 = object96.loginregister96_register_cred.register_form_id96;
	var uname_register96 = object96.loginregister96_register_cred.uname_register96;
	var email_register96 = object96.loginregister96_register_cred.email_register96;
	var pwd_register96 = object96.loginregister96_register_cred.pass_register96;
	var cpwd_register96 = object96.loginregister96_register_cred.cpass_register96;


	$(registerform_id96).submit(function(event) {
    event.preventDefault();

    var register96_pid = $("input[name="+pwd_register96+"]").attr('id');
    var validation = {rules:{}, messages:{}} // fill in normal rules if there are any.

	validation.rules[uname_register96] = {required: true}
	validation.messages[uname_register96] = "Please Enter Your Username"

	validation.rules[email_register96] = {required: true}
	validation.messages[email_register96] = "Please Enter A Valid Email Address"

	validation.rules[pwd_register96 ] = {required: true}

	validation.rules[cpwd_register96] = {equalTo: "#"+register96_pid}
	validation.messages[cpwd_register96] = "Your Password Does not Match"

	$(this).validate(validation)

    var valid = $(this).valid();
    if (valid) {
      	$("button[type=submit]").append('<i class="fa fa-circle-o-notch fa-spin" style="font-size:20px"></i>');
    	$("button[type=submit]").prop("disabled",true);
    	var uname_register96_value = $('input[name='+uname_register96+']').val();
    	var email_register96_value = $('input[name='+email_register96+']').val();
    	var cpwd_register96_value = $('input[name='+cpwd_register96+']').val();
            $.ajax({
                type:"POST",
                url: object96.ajax_url,
                data: {"uname":uname_register96_value,"uemail":email_register96_value,"upass":cpwd_register96_value,"action":"register_form96"},
                dataType : 'json',
              success: function (response) {
          	    	$("button[type=submit]").children().remove();
					$("button[type=submit]").prop("disabled",false);
                    console.log(response);
                    var error = response.status;
                    if (error) { 
                        window.location.href = response.redirect_url;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: response.message,
                            });
                       // console.log(response);
                    }
                },
            	error: function (errorThrown) {
                        console.log(errorThrown);
                    },
            });
    }
      
  });
})(jQuery)