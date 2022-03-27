var Contact = {

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

		$("#contactForm").validate({
			submitHandler: function(form) {

				$.ajax({
					type: "POST",
					url: "/addon/kontak-form.php",
					data: {
						"name": $("#contactForm #name").val(),
						"email": $("#contactForm #email").val(),
						"subject": $("#contactForm #subject").val(),
						"message": $("#contactForm #message").val(),
						"captchak": $("#contactForm #captchak").val()
					},
					dataType: "json",
					success: function (data) {
						if (data.status == "berhasil") {
							reload_captchak();
							$("#contactSuccess").removeClass("hidden");
							$("#contactError").addClass("hidden");

							$("#contactForm #name, #contactForm #email, #contactForm #subject, #contactForm #message, #contactForm #captchak")
								.val("")
								.blur()
								.closest(".control-group")
								.removeClass("success")
								.removeClass("error")
								
							if(($("#contactSuccess").position().top - 80) < $(window).scrollTop()){
								$("html, body").animate({
									 scrollTop: $("#contactSuccess").offset().top - 80
								}, 300);
							$("#contactSuccess").fadeTo(2000, 400).slideUp(400, function(){
							$("#contactSuccess").slideUp(400);
							});
							}
						}else if (data.status == "gagal") {
							reload_captchak();
							$("#captchaError").html(data.pesan);		
							$("#captchaError").removeClass("hidden");
							$("#captchaError").fadeTo(2000, 400).slideUp(400, function(){
							$("#captchaError").slideUp(400);
							});
							// $("#contactError").removeClass("hidden");
							$("#contactSuccess").addClass("hidden");

							if(($("#captchaError").position().top - 80) < $(window).scrollTop()){
								$("html, body").animate({
									 scrollTop: $("#captchaError").offset().top - 80
								}, 300);								
							}
						} else {
							$("#captchaError").html(data.pesan);		
							$("#captchaError").removeClass("hidden");
							$("#captchaError").fadeTo(2000, 400).slideUp(400, function(){
							$("#captchaError").slideUp(400);
							});
							// $("#contactError").removeClass("hidden");
							$("#contactSuccess").addClass("hidden");

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
				name: {
					required: true
				},
				email: {
					required: true,
					email: true
				},
				subject: {
					required: true
				},
				message: {
					required: true
				},
				captchak: {
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

Contact.initialize();
	$('#captcha_r').on('click',function(e){
	  e.preventDefault();
	  var d = new Date();
	  var src = $("img#captcha_imgk").attr("src");
	  src = src.split(/[?#]/)[0];
	  $("img#captcha_imgk").attr("src", src+'?'+d.getTime());
	});
function reload_captchak(){
	  var d = new Date();
	  var src = $("img#captcha_imgk").attr("src");
	  src = src.split(/[?#]/)[0];
	  $("img#captcha_imgk").attr("src", src+'?'+d.getTime());
	}