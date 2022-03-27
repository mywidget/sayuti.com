$('document').ready(function()
{ 
     /* validation */
	 $("#login-form").validate({
      rules:
	  {
			password: {
			required: true,
			},
			user_login: {
            required: true,
            },
			token: {
            required: true,
            },
	   },
       messages:
	   {
            password:{
                      required: "isi kata sandi"
                     },
            user_login: "isi user login",
       },
	   submitHandler: LoginForm	
       });  
	   /* validation */
	   
	   /* login submit */
	   function LoginForm()
	   {		
			var data = $("#login-form").serialize();
			$.ajax({
				
			type : 'POST',
			url  : 'cek_login.php',
			data : data,
			beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span>');
			},
			success :  function(response)
			   {						
					if (response=='ok'){

						$("#btn-login").html('<img src="img/loading.gif" /> ');
						setTimeout(' window.location.href = "index.php"; ',600);
					}
					else{
					$("#error").fadeIn(1000, function(){
					$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
					$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Masuk');
					});
					}
			  }
			});
				return false;
		}
	   /* login submit */
});