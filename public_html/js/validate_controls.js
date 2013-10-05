//    $(document).ready(function(){
//     
//    $.validator.addMethod("passwords_not_same", function(value, element) {
//    	return $('#password').val() != $('#password_again').val()
//    	}, "* Passwords must match");
//    	
//    $('#create-user').validate(
//    {
//    rules: {
//    	email: {
//    	    required: true,
//    	    email: true
//    	    },
//    	username: {
//    		maxlength: 45,
//    	    required: true
//    	    },
//    	password {
//    	    minlength: 8,
//    	    requied: true
//    	    }
//    	password_again: {
//    		password_not_same: true,
//    	},
//    },
//    highlight: function(element) {
//    $(element).closest('.control-group').removeClass('success').addClass('error');
//    },
//    success: function(element) {
//    element
//    .text('OK!').addClass('valid')
//    .closest('.control-group').removeClass('error').addClass('success');
//    }
//    });
//    }); // end document.ready 