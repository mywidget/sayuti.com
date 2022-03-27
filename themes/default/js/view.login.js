var Login = {

	initialized: false,

	initialize: function() {

		if (this.initialized) return;
		this.initialized = true;

		this.build();
		this.events();

	},

	build: function() {

		this.validations();

	},

	events: function() {

		

	},

	validations: function() {

		$("#loginForm").validate({
			submitHandler: function(form) {

				$.ajax({
					type: "POST",
					url: "/addon/login-prosess.php",
					data: {
						"email_l": $("#loginForm #email_l").val(),
						"password_l": $("#loginForm #password_l").val(),
						"captcha_l": $("#loginForm #captcha_l").val()
					},
					dataType: "json",
					success: function (data) {
						if (data.status == "berhasil") {
							$("#loginSuccess").html(data.pesan);		
							setTimeout(' window.location.href = "/member"; ',600);
						}else if (data.status == "gagal") {
							reload_captcha();
							$("#captchaError").html(data.pesan);		
							$("#captchaError").removeClass("hidden");
							$("#captchaError").fadeTo(2000, 400).slideUp(400, function(){
							$("#captchaError").slideUp(400);
							});
							// $("#contactError").removeClass("hidden");
							$("#loginSuccess").addClass("hidden");

							if(($("#captchaError").position().top - 80) < $(window).scrollTop()){
								$("html, body").animate({
									 scrollTop: $("#captchaError").offset().top - 80
								}, 300);								
							}
						} else {
							reload_captcha();
							$("#captchaError").html(data.pesan);		
							$("#captchaError").removeClass("hidden");
							$("#captchaError").fadeTo(2000, 400).slideUp(400, function(){
							$("#captchaError").slideUp(400);
							});
							$("#loginSuccess").addClass("hidden");

							if(($("#captchaError").position().top - 80) < $(window).scrollTop()){
								$("html, body").animate({
									 scrollTop: $("#captchaError").offset().top - 80
								}, 300);								
							}

						}
					}

				});
			},
			rules: {
				email_l: {
					required: true,
					email: true
				},
				password_l: {
					required: true
				},
				captcha_l: {
					required: true
				}
			},
			highlight: function (element) {
				$(element)
					.closest(".control-group")
					.removeClass("success")
					.addClass("error");
			},
			success: function (element) {
				$(element)
					.closest(".control-group")
					.removeClass("error")
					.addClass("success");
			}
		});

	}

};

Login.initialize();
	$('#captcha_l_r').on('click',function(e){
	  e.preventDefault();
	  var d = new Date();
	  var src = $("img#captcha_image_l").attr("src");
	  src = src.split(/[?#]/)[0];
	  $("img#captcha_image_l").attr("src", src+'?'+d.getTime());
	});
function reload_captcha(){
	  var d = new Date();
	  var src = $("img#captcha_image_l").attr("src");
	  src = src.split(/[?#]/)[0];
	  $("img#captcha_image_l").attr("src", src+'?'+d.getTime());
	}