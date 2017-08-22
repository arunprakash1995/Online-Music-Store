$(document).ready(function() {
  
  var animating = false,
      submitPhase1 = 300,
      submitPhase2 = 200,
      logoutPhase1 = 600,
      $login = $(".login"),
      $app = $(".app__logout"),
      $signup = $(".signup"),
      $forgot = $(".forgot");
  
  function ripple(elem, e) {
    $(".ripple").remove();
    var elTop = elem.offset().top,
        elLeft = elem.offset().left,
        x = e.pageX - elLeft,
        y = e.pageY - elTop;
    var $ripple = $("<div class='ripple'></div>");
    $ripple.css({top: y, left: x});
    elem.append($ripple);
  };
  
/*  $(document).on("click", ".login__submit", function(e) {
    if (animating) return;
    animating = true;
    var that = this;
    ripple($(that), e);
    $(that).addClass("processing");
    setTimeout(function() {
      $(that).addClass("success");
      setTimeout(function() {
        $app.show();
        $app.css("top");
        $app.addClass("active");
      }, submitPhase2 - 70);
      setTimeout(function() {
        $login.hide();
        $login.addClass("inactive");
        animating = false;
        $(that).removeClass("success processing");
      }, submitPhase2);
    }, submitPhase1);
  });
  
*/


  $(document).on("click", ".app__logout", function(e) {
    if (animating) return;
    $(".ripple").remove();
    animating = true;
    var that = this;
    $(that).addClass("clicked");
    setTimeout(function() {
      $app.removeClass("active");
      $signup.removeClass("active");  //added
      $forgot.removeClass("active");  //added
      $login.show();
      //$login.css("top");
      $login.removeClass("inactive");
    }, logoutPhase1 - 120);
    setTimeout(function() {
      $app.hide();
      $signup.hide();   //added
      $forgot.hide();   //added
      animating = false;
      $(that).removeClass("clicked");
    }, logoutPhase1);
  });

  //added on 20th july

  $(document).on("click", ".login__signup", function(e) {
    if (animating) return;
    animating = true;
    var that = this;
    ripple($(that), e);
    $(that).addClass("processing");
    setTimeout(function() {
      $(that).addClass("success");
      setTimeout(function() {
        $signup.show();
        $app.show();    //added
        //$app.css("top");
        $signup.addClass("active");
        $app.addClass("active");    //added
      }, submitPhase2 - 100);
      setTimeout(function() {
        $login.hide();
        $login.addClass("inactive");
        animating = false;
        $(that).removeClass("success processing");
      }, submitPhase2);
    }, submitPhase1);
  });
  

  /*

  $("#signup__form").validate({
          rules: {
               new_admin_pass: { 
                 required: true,
                    
               } , 

               password2_signup: { 
                    required: true,
                    equalTo: "#new_admin_pass",
                     
               }


          },
          messages:{
                password2_signup: "Please enter valid confirm password"
          },
          submitHandler:function(){$('#signup__form').submit();}

  }); 


  $(".signup_form").submit(function(e){
      e.preventDefault();
      $("#p1").removeClass();
      if($("#user").val()== '' || $("#pass").val()== '' || $("#phone").val()== '')
      {
        $("#p1").text("all fields should be filled").addClass("Error");

      }
      else if($("#user").val().length < 6 || $("#pass").val().length < 6)
      {
        $("#p1").text("Username and Password should be atleast 6 chars").addClass("Error");
      }
      else if(!$("#phone").val().match(/^\d+$/) )
      {
        $("#p1").text("Phone number should be numeric").addClass("Error");
      }
      else
      {
        $("#p1").text("Success").addClass("Success");
      }
    });

*/
/*
  $("#new_admin").blur(function(){
    //$("#user").text("").removeClass();
    var user = $.trim( $(this).val() );
    if(user != '')
    {
      var regx = /^[A-Za-z0-9]+$/;
      if (!regx.test(user)) 
      {
        $("#user").text("Error").addClass("error");
      }
      else{
        $("#user").text("OK").addClass("ok");
      }
    }
  }); 

  

  $("#password2_signup").blur(function(){
    var pwd1 = $("#new_admin_pass").val();
    //$("#pwd").text("").removeClass();
    var pwd2 = $(this).val();
    if (pwd1 != pwd2) {
      //$(".signup__form").submit(function(e){
      //e.preventDefault();
      //});
      $("#signup").prop("disabled",true);
    } 
    else if(pwd1 == pwd2) {
      $("#signup").prop("disabled",false);
    }
  });   

*/
 


  $('#new_admin_pass').keyup(function()
  {
    $('#new_admin_pass_status').html(checkStrength($('#new_admin_pass').val()))
  })

  function checkStrength(password)
  {
    //initial strength
    var strength = 0
    
    //if the password length is less than 6, return message.
    if (password.length < 8) { 
      $('#new_admin_pass_status').removeClass()
      $('#new_admin_pass_status').addClass('short')
      return 'Upper Lower Num Special min 8 char' 
    }
    
    //length is ok, lets continue.
    
    //if length is 8 characters or more, increase strength value
    if (password.length > 8) strength += 1
    
    //if password contains both lower and uppercase characters, increase strength value
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
    
    //if it has numbers and characters, increase strength value
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
    
    //if it has one special character, increase strength value
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
    
    //if it has two special characters, increase strength value
    if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
    
    //now we have calculated strength value, we can return messages
    
    //if value is less than 2
    if (strength < 4 )
    {
      $('#new_admin_pass_status').removeClass()
      $('#new_admin_pass_status').addClass('weak')
      return 'Weak'     
    }
    else if (strength == 4 )
    {
      $('#new_admin_pass_status').removeClass()
      $('#new_admin_pass_status').addClass('good')
      return 'Good'   
    }
    else
    {
      $('#new_admin_pass_status').removeClass()
      $('#new_admin_pass_status').addClass('strong')
      return 'Strong'
    }
  }

  $('#new_admin_pass').focus(function()
  {
    if ( $('#new_admin_pass_status').text().trim() == '') 
    {
      $('#new_admin_pass_status').html('Upper Lower Num Special min 8 char');
      $('#new_admin_pass_status').removeClass();
      $('#new_admin_pass_status').addClass('short');
    }  
  })

  $('#new_admin_pass').blur(function()
  {
    if ( $('#new_admin_pass_status').text().trim() == 'Upper Lower Num Special min 8 char') 
    {
      $('#new_admin_pass_status').html("");
    }  
  })


  $('#new_admin').keyup(function()
  {
     var pattern = /^[a-z0-9]+$/;
     var name = $(this).val();
/*
     if(name.length < 5)
      {
        $('#new_admin_status').html('Lower Numeric min 5 char');
        $('#new_admin_status').removeClass()
        $('#new_admin_status').addClass('short')
      }
*/
     if(name.length >= 5 &&  name.match(pattern) )
     {
      $.ajax({
      type: 'post',
      url: 'php/checkadmin.php',
      data: {
       user_name:name,
      },
      success: function (response) {
       $( '#new_admin_status' ).html(response);
       if( $('#new_admin_status').text().trim() =='OK') 
       {
        $('#new_admin_status').removeClass()
        $('#new_admin_status').addClass('strong')
          
       }
       else
       {
        $('#new_admin_status').removeClass()
        $('#new_admin_status').addClass('weak')
         
       }
      }
      });
     }
     else
     {
        $('#new_admin_status').html('Lower Numeric min 5 char');
        $('#new_admin_status').removeClass()
        $('#new_admin_status').addClass('short')
     }
  })

  $('#new_admin').focus(function()
  {
    if ( $('#new_admin_status').text().trim() == '') 
    {
      $('#new_admin_status').html('Lower Numeric min 5 char');
      $('#new_admin_status').removeClass();
      $('#new_admin_status').addClass('short');
    }  
  })

  $('#new_admin').blur(function()
  {
    if ( $('#new_admin_status').text().trim() == 'Lower Numeric min 5 char') 
    {
      $('#new_admin_status').html("");
    }  
  })


  $('#signup__form').submit(function(e)
  {
    var username_status = $('#new_admin_status').text().trim();
    var password_status = $('#new_admin_pass_status').text().trim();
    var oldadmin = $('#exist_admin').val();
    var oldpassword = $('#exist_admin_pass').val();
    var newadmin = $('#new_admin').val();
    var newpassword = $('#new_admin_pass').val();

    if (username_status == 'OK' && (password_status == 'Good' || password_status == 'Strong')) 
    {
      $.ajax({
        type: 'post',
        url: 'php/signup_admin.php',
        data: {
          old_admin:oldadmin,
          old_pass:oldpassword,
          new_admin:newadmin,
          new_pass:newpassword,
         
        }, 
        success: function(result){
         $( '#signup_status' ).html(result);
         
         if( $('#signup_status').text().trim() == 'Account Created' ) 
         {
          $('#signup_status').removeClass();
          $('#signup_status').addClass('strong');
            
         }
         else
         {
          $('#signup_status').removeClass();
          $('#signup_status').addClass('weak');
           
         }
        }
      });
    }
    else
    {
      $( '#signup_status' ).html('Error!');
      $('#signup_status').removeClass();
      $('#signup_status').addClass('weak');
    }
    e.preventDefault();
  })

  //$('#admin_task').hide();

  $('#login__form').submit(function(e)
  {
    e.preventDefault();
    var username_login = $('#username').val();
    var password_login = $('#password').val();

    $.ajax({
        type: 'post',
        url: 'php/login_admin.php',
        data: {
          user_name:username_login,
          pass_word:password_login,
                   
        }, 
        success: function(result){
         $( '#login_incorrect' ).html(result);
         
         if( $('#login_incorrect').text().trim() == 'Incorrect Credentials' ) 
         {
          $('#login_incorrect').removeClass();
          $('#login_incorrect').addClass('incorrect');
            
         }
         else
         {
          //$('#login_incorrect').removeClass();
          //$('#login_incorrect').addClass('incorrect');
          window.location.href= "admin.php";
          //$('#admin_task').show();
         }
        }
      });
    

  })

  $('#logout').click(function()
  {
    
    $.ajax({
      type:'get',
      url:'../php/logout.php',
      success: function(result){
        window.location.href= "index1.php";
        //$('#admin_task').hide();
         
      }

    });

  })

  
});