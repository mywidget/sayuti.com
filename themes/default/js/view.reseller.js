$("#show-form").hide();
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
					url: "/addon/reseller-form.php",
					data: {
						"name": $("#contactForm #name").val(),
						"email": $("#contactForm #email").val(),
						"nohp": $("#contactForm #nohp").val(),
						"alamat": $("#contactForm #alamat").val(),
						"captcha": $("#contactForm #captcha").val()
					},
					dataType: "json",
					success: function (data) {
						if (data.status == "berhasil") {
							reload_captcha();
							$("#contactSuccess").html(data.pesan);
							$("#contactSuccess").removeClass("hidden");
							$("#contactError").addClass("hidden");
							$("#hide-form").hide();
							$("#show-form").show();
							$("#contactForm #name, #contactForm #email, #contactForm #nohp, #contactForm #alamat, #contactForm #captcha").val("").blur().closest(".control-group").removeClass("success").removeClass("error")
								
							if(($("#contactSuccess").position().top - 80) < $(window).scrollTop()){
								$("html, body").animate({
									 scrollTop: $("#contactSuccess").offset().top - 80
								}, 300);
							$("#contactSuccess").fadeTo(2000, 1000).slideUp(1000, function(){
							$("#contactSuccess").slideUp(1000);
							});
							}
						}else if (data.status == "gagal") {
							reload_captcha();
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
							reload_captcha();
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
				nohp: {
					required: true
				},
				alamat: {
					required: true
				},
				captcha: {
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
	$('#captcha_k').on('click',function(e){
	  e.preventDefault();
	  var d = new Date();
	  var src = $("img#captcha_imagek").attr("src");
	  src = src.split(/[?#]/)[0];
	  $("img#captcha_imagek").attr("src", src+'?'+d.getTime());
	});
function reload_captcha(){
	  var d = new Date();
	  var src = $("img#captcha_imagek").attr("src");
	  src = src.split(/[?#]/)[0];
	  $("img#captcha_imagek").attr("src", src+'?'+d.getTime());
	}
$('#show-form').on('click',function(){
 $("#hide-form").show();
 $("#show-form").hide();
});