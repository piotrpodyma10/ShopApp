$(document).ready(function(){
    $("#signup_btn").click(function(){
        $("#main").animate({left:"22.5%"},400); 
        $("#main").animate({left:"30%"},500); 
        $("#loginform").css("visibility","hidden");
        $("#loginform").animate({left:"25%"},400);
        
        $("#signupform").animate({left:"75%"},400);
        $("#signupform").animate({left:"40%"},500);
        //$("#signupform").animate({visibility: "visible"});
        //$("#signupform").css("visibility","visible");
        $("#signupform").css({opacity: 0, visibility: "visible"}).animate({opacity: 1}, 200)
    }); 
    
    $("#login_btn").click(function(){
        $("#main").animate({left:"40.5%"},400); 
        $("#main").animate({left:"70%"},500);
        $("#signupform").css("visibility","hidden");
        $("#signupform").animate({left:"75%"},400);
        
        $("#loginform").animate({left:"25%"},400);
        $("#loginform").animate({left:"70%"},500);
        $("#loginform").css("visibility","visible");
    });
});








