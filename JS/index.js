/*Loader
  ==================================================*/
  $(document).ready(function(){
    setTimeout(function(){
      $('body').addClass('loaded');
    },3700);  
  })

/* Menu
  ==================================================*/
    $(document).ready(function()
    {
     $('.icon').click(function()
     {
        $('.icon').toggleClass('active');
     });
    });   
  
    $(document).ready(function()
    {
      $('.icon').on('click', function()
      {
        $('.block').toggle(500, function()
        {
          if($(this).css('display') === 'none')
          {
              $(this).removeAttr('style');
          } 
        });
      });
    });


$(function() 
{
  $(window).click(function() 
  {
    if($(this).scrollTop() != 0)
    {
      $('.scroll-top').fadeIn(); 
    }
    else
    {
      $('.scroll-top').fadeOut();
    }
  });
  $('.scroll-top').click(function()
  { 
    $('body,html').animate({scrollTop:0},900);
  });
});
