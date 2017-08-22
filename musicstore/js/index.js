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
  

  $(document).on("click", ".login__forgot", function(e) {
    if (animating) return;
    animating = true;
    var that = this;
    ripple($(that), e);
    $(that).addClass("processing");
    setTimeout(function() {
      $(that).addClass("success");
      setTimeout(function() {
        $forgot.show();
        $app.show();    //added
        //$forgot.css("top");
        $forgot.addClass("active");
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
               password1_signup: { 
                 required: true,
                    
               } , 

               password2_signup: { 
                    required: true,
                    equalTo: "#password1_signup",
                     
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
  $("#username_signup").blur(function(){
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
    var pwd1 = $("#password1_signup").val();
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
  $('#firstname_signup').keyup(function()
  {
    var pattern = /^[a-zA-Z0-9]+$/;
    var firstname = $(this).val();

    if(firstname.length > 0 && firstname.match(pattern))
    {
      $('#firstname_exist').html('OK');
      $('#firstname_exist').removeClass();
      $('#firstname_exist').addClass('strong');
    }
    else
    {
      $('#firstname_exist').html('');
    }
  })

  $('#lastname_signup').keyup(function()
  {
    var pattern = /^[a-zA-Z0-9]+$/;
    var lastname = $(this).val();

    if(lastname.length > 0 && lastname.match(pattern))
    {
      $('#lastname_exist').html('OK');
      $('#lastname_exist').removeClass();
      $('#lastname_exist').addClass('strong');
    }
    else
    {
      $('#lastname_exist').html('');
    }
  })


  $('#password1_signup').keyup(function()
  {
    $('#password_strong').html(checkStrength($('#password1_signup').val()))
  })

  function checkStrength(password)
  {
    //initial strength
    var strength = 0
    
    //if the password length is less than 6, return message.
    if (password.length < 8) { 
      $('#password_strong').removeClass()
      $('#password_strong').addClass('short')
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
      $('#password_strong').removeClass()
      $('#password_strong').addClass('weak')
      return 'Weak'     
    }
    else if (strength == 4 )
    {
      $('#password_strong').removeClass()
      $('#password_strong').addClass('good')
      return 'Good'   
    }
    else
    {
      $('#password_strong').removeClass()
      $('#password_strong').addClass('strong')
      return 'Strong'
    }
  }

  $('#password1_signup').focus(function()
  {
    if ( $('#password_strong').text().trim() == '') 
    {
      $('#password_strong').html('Upper Lower Num Special min 8 char');
      $('#password_strong').removeClass();
      $('#password_strong').addClass('short');
    }  
  })

  $('#password1_signup').blur(function()
  {
    if ( $('#password_strong').text().trim() == 'Upper Lower Num Special min 8 char') 
    {
      $('#password_strong').html("");
    }  
  })


  $('#username_signup').keyup(function()
  {
     var pattern = /^[a-z0-9]+$/;
     var name = $(this).val();
/*
     if(name.length < 5)
      {
        $('#username_exist').html('Lower Numeric min 5 char');
        $('#username_exist').removeClass()
        $('#username_exist').addClass('short')
      }
*/
     if(name.length >= 5 &&  name.match(pattern) )
     {
      $.ajax({
      type: 'post',
      url: 'php/checkdata.php',
      data: {
       user_name:name,
      },
      success: function (response) {
       $( '#username_exist' ).html(response);
       if( $('#username_exist').text().trim() =='OK') 
       {
        $('#username_exist').removeClass()
        $('#username_exist').addClass('strong')
          
       }
       else
       {
        $('#username_exist').removeClass()
        $('#username_exist').addClass('weak')
         
       }
      }
      });
     }
     else
     {
        $('#username_exist').html('Lower Numeric min 5 char');
        $('#username_exist').removeClass()
        $('#username_exist').addClass('short')
     }
  })

  $('#username_signup').focus(function()
  {
    if ( $('#username_exist').text().trim() == '') 
    {
      $('#username_exist').html('Lower Numeric min 5 char');
      $('#username_exist').removeClass();
      $('#username_exist').addClass('short');
    }  
  })

  $('#username_signup').blur(function()
  {
    if ( $('#username_exist').text().trim() == 'Lower Numeric min 5 char') 
    {
      $('#username_exist').html("");
    }  
  })


  $('#email_signup').keyup(function()
  {
    var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    var email = $(this).val();
    
    if(email.match(pattern))
    {
      $.ajax({
        type: 'post',
        url: 'php/checkdata.php',
        data: {
         user_email:email,
        }, 
        success: function(result){
         $( '#email_exist' ).html(result);
         
         if( $('#email_exist').text().trim() == 'OK' ) 
         {
          $('#email_exist').removeClass();
          $('#email_exist').addClass('strong');
            
         }
         else
         {
          $('#email_exist').removeClass();
          $('#email_exist').addClass('weak');
           
         }
        }
      });
    }
    else
    {
      $( '#email_exist' ).html('A@Y.COM');
      $('#email_exist').removeClass();
      $('#email_exist').addClass('short');
    }
  })

  $('#email_signup').focus(function()
  {
    if ( $('#email_exist').text().trim() == '') 
    {
      $('#email_exist').html('A@Y.COM');
      $('#email_exist').removeClass();
      $('#email_exist').addClass('short');
    }  
  })

  $('#email_signup').blur(function()
  {
    if ( $('#email_exist').text().trim() == 'A@Y.COM') 
    {
      $('#email_exist').html("");
    }  
  })


  $('#signup__form').submit(function(e)
  {
    var firstname_status = $('#firstname_exist').text().trim();
    var lastname_status = $('#lastname_exist').text().trim();
    var email_status = $('#email_exist').text().trim();
    var username_status = $('#username_exist').text().trim();
    var password_status = $('#password_strong').text().trim();
    var firstname = $('#firstname_signup').val();
    var lastname = $('#lastname_signup').val();
    var username = $('#username_signup').val();
    var email = $('#email_signup').val();
    var password = $('#password1_signup').val();

    if (firstname_status == 'OK' && lastname_status == 'OK' && email_status == 'OK' && username_status == 'OK' && (password_status == 'Good' || password_status == 'Strong')) 
    {
      $.ajax({
        type: 'post',
        url: 'php/signup.php',
        data: {
          user_firstname:firstname,
          user_lastname:lastname,
          user_email:email,
          user_username:username,
          user_password:password,
         
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


  $('#login__form').submit(function(e)
  {
    e.preventDefault();
    var username_login = $('#username').val();
    var password_login = $('#password').val();

    $.ajax({
        type: 'post',
        url: 'php/login.php',
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
          window.location.href= "index1.php";

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
         
      }

    });

  })
  

  
});