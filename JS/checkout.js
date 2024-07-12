    $('#button').click(function(){
        $("#box").css({
            'display' : 'none',
            
        });
        $("#box_2").css({
            'display' : 'flex',
        });

    });
    
    $('#butt').click(function(){
        $("#box_2").css({
            'display' : 'none',
        });
        $("#box_3").css({
            'display' : 'flex',
        });
    });


    /********************************************* */
    $('.checkout_1').next().hide();
    $('.checkout_1').click(function(){
    $(this).next().slideToggle();
    $('.checkout_1').not(this).next().stop(true,true).slideUp();
    });
    $('.checkout_2').next().hide();
    $('.checkout_2').click(function(){
    $(this).next().slideToggle();
    $('.checkout_2').not(this).next().stop(true,true).slideUp();
    });

    $('.checkout_3').next().hide();
    $('.checkout_3').click(function(){
    $(this).next().slideToggle();
    $('.checkout_3').not(this).next().stop(true,true).slideUp();
    });
/*
    $(document).ready(function() { 
        $("A#trigger").toggle(function() { 
          // Отображаем скрытый блок 
          $("DIV#box").fadeIn(); // fadeIn - плавное появление
          return false; // не производить переход по ссылке
        },  
        function() { 
          // Скрываем блок 
          $("DIV#box").fadeOut(); // fadeOut - плавное исчезновение 
          return false; // не производить переход по ссылке
        }); // end of toggle() 
      }); // end of ready() */