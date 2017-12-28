//make navbar menu item active on click
// $(document).ready(function(){
//     'use strict';
    
//     $('.navbar-nav li a').click(function()
//     {
//         'use strict';
        
//         $('.navbar-nav li a').parent().removeClass("active");

//         //add class to the just clicked menu item (this)
//         //is added to the parent class (li) since we are targeting <a> child
//         $(this).parent().addClass('active');
//     });
// });

//add auto padding to header based on device width size!!
// $(document).ready(function() {
   
//    'use strict';
   
//    // setInterval(function(){
//       'use strict';
      
//       var windowHeight = $(window).height();
      
//       var containerHeight = $(".header-container").height();
      
//       //padding based on window's height
//       var padTop = windowHeight - containerHeight;
      
//       $(".header-container").css({
            // 'padding-top': Math.round(padTop/2) + 'px',    
//             'padding-bottom': Math.round(padTop / 2) + 'px'
//       });
      
//    // }, 1000);
// });

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
                // $('nav').removeClass("navbar-fixed-top");
                $('nav').addClass("mobile-nav");
            }
            else
            {
                $('nav').removeClass("mobile-nav");
                // $('nav').addClass("navbar-fixed-top");
            }
        });  
    }
});


//for when android device clicks on keyboard in landscape
// $(document).ready(function()
// {
//     'use strict';
   
//        if($(window).height() > $(window).width())
//        {
          
//              $("#sign-up-form-name").on("focus", function()
//              {
//                 if (/Android/.test(navigator.userAgent))
//                 {
                   
//                   $('nav').removeClass("navbar-fixed-top");

//                 }

//              });
             
//              $("#sign-up-form-name").on("blur", function()
//              {
//                 if (/Android/.test(navigator.userAgent))
//                 {
                   
//                   $('nav').addClass("navbar-fixed-top");

//                 }

//              });
//        }
// });


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