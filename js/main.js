
//handle dynamic sizing of navbar
$(document).ready(function()
{
    'use strict';
    
    if($(window).width() >= 768)
    {
        $(window).scroll(function()
        {
            'use strict';
            
            //if scroll top is greater than 50px, shrink
            if($(window).scrollTop() > 50)
            {
                $('nav').addClass("shrink");
    
            }
            else
            {
                $('nav').removeClass("shrink");
            }
        });        
    }
    else if($(window).width() <= 767)
    {
        $(window).scroll(function()
        {
            'use strict';
            
            //if scroll top is greater than 50px, remove fixed-top
            if($(window).scrollTop() > 50)
            {
                $('nav').addClass("mobile-nav");
            }
            else
            {
                $('nav').removeClass("mobile-nav");
            }
        });  
    }
});

//handle strange keyboard behavior of android keyboard
$(document).ready(function()
{
    'use strict';
    
    $("#sign-up-form-name").on("focus", function()
    {
       'use strict';
        
       if (/Android/.test(navigator.userAgent))
       {
          
         $(".page-wrap").addClass("kboard");

       }
    });
    
    $("#sign-up-form-name").on("blur", function()
    {
       
       if (/Android/.test(navigator.userAgent))
       {
          
          $(".page-wrap").removeClass("kboard");

       }
       
    });
    
    $("#sign-up-form-email").on("focus", function()
    {
       'use strict';
        
       if (/Android/.test(navigator.userAgent))
       {
          
         $(".page-wrap").addClass("kboard");

       }
    });
    
    $("#sign-up-form-email").on("blur", function()
    {
       
       if (/Android/.test(navigator.userAgent))
       {
          
         $(".page-wrap").removeClass("kboard");

       }
       
    });
    
});
