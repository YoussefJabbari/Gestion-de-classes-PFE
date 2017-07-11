$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});


$(".register-form .show_cne").change(function(event){
   event.preventDefault();
   $('.register-form .cne').attr("disabled",false);
});


$('.form .registerform .show_cne').change(function(){
   $('.form .register-form .cne').animate({height: "toggle", opacity: "toggle"}, "slow");
});