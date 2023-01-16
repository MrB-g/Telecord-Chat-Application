$(document).ready(function () {
   $("#login").submit(function (e) {
      let email = $("#email").val();
      let password = $("#password").val();

      if (email == "" && password == "") {
         $("#error-email").text("* Email is required.");
         $("#email-div").addClass("error");
         $("#error-password").text("* Password is required.");
         $("#password-div").addClass("error");
      } else if (email != "" && password == "") {
         if ($("#email-div").hasClass("error")) {
            $("#email-div").removeClass("error");
         }
         $("#error-password").text("* Password is required.");
         $("#password-div").addClass("error");
      } else if (email == "" && password != "") {
         if ($("#password-div").hasClass("error")) {
            $("#password-div").removeClass("error");
         }
         $("#error-email").text("* Email is required.");
         $("#email-div").addClass("error");
      } else {
         if ($("#email-div").hasClass("error")) {
            $("#email-div").removeClass("error");
         }
         if ($("#password-div").hasClass("error")) {
            $("#password-div").removeClass("error");
         }
         let re = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
         let emailFormat = re.test(email);
         if (emailFormat) {
            $.ajax({
               url: "http://localhost/telecord/check_auth.php",
               method: "POST",
               contentType: "application/json",
               datatype: "json",
               data: JSON.stringify({
                  email: email,
                  password: password,
               }),
               success: function (data) {
                  if (data == "ADMIN") {
                     $("#email").val("");
                     $("#password").val("");
                     window.location.replace(
                        "http://localhost/telecord/admin.php"
                     );
                  } else if (data == "WRONG") {
                     $("#inv-message").css("display", "block");
                  } else {
                     $("#email").val("");
                     $("#password").val("");
                     window.location.replace(
                        "http://localhost/telecord/chat.php?userId=" + data
                     );
                  }
               },
            });
         } else {
            $("#error-email").text("* Please check your email format.");
            $("#email-div").addClass("error");
         }
      }

      e.preventDefault();
   });
});
