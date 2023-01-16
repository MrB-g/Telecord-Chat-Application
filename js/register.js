$(document).ready(function () {
   $(".profile-pic-div").on("mouseenter", function () {
      $("#profile_upload_btn").css("display", "block");
   });

   $(".profile-pic-div").on("mouseleave", function () {
      $("#profile_upload_btn").css("display", "none");
   });

   $("#profile_pic_input").on("change", function () {
      const choosedFile = this.files[0];
      const choosedFileType = choosedFile.type.substring(6);
      if (choosedFile) {
         if (
            choosedFileType != "png" &&
            choosedFileType != "jpg" &&
            choosedFileType != "jpeg"
         ) {
            $("#profile_pic_icon").attr("src", "./logo/profile-icon.png");
            $("#image-type-error").text(
               "Your image format must be jpg, png or jpeg."
            );
            $("#image-type-error").css("display", "block");
         } else {
            const reader = new FileReader();

            reader.addEventListener("load", function () {
               $("#image-type-error").css("display", "none");

               $("#profile_pic_icon").attr("src", reader.result);
            });
            reader.readAsDataURL(choosedFile);
         }
      }
   });

   $("#sign-up").on("click", function () {
      $("#image-type-error").css("display", "none");

      let input_val = $("form").serializeArray();
      let noerror = true;

      $.each(input_val, function (index, value) {
         if (value.value == "") {
            $(`#${value.name}`).parent().addClass("error");
            noerror = false;
         } else {
            if ($(`#${value.name}`).parent().hasClass("error")) {
               $(`#${value.name}`).parent().removeClass("error");
            }
         }
      });

      if ($("#profile_pic_input")[0].files.length !== 0) {
         let imgT = $("#profile_pic_input")[0].files[0].type;
         let imageType = imgT.substring(6);
         if (imageType != "png" && imageType != "jpg" && imageType != "jpeg") {
            $("#image-type-error").text(
               "Your image format must be jpg, png or jpeg."
            );

            $("#image-type-error").css("display", "block");
            noerror = false;
         }
      } else {
         $("#image-type-error").text("Please select image for your profile.");
         $("#image-type-error").css("display", "block");
         noerror = false;
      }

      if (noerror) {
         let re = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
         let emailFormat = re.test($("#email").val());

         if (emailFormat) {
            if ($("#password").val() !== $("#confirm-password").val()) {
               $("#password").parent().addClass("noteq");
               $("#confirm-password").parent().addClass("noteq");
            } else {
               if ($("#password").parent().hasClass("noteq")) {
                  $("#password").parent().removeClass("noteq");
                  $("#confirm-password").parent().removeClass("noteq");
               }

               let name = input_val[0].value;
               let email = input_val[1].value;
               let password = input_val[2].value;
               let file_data = $("#profile_pic_input").prop("files")[0];
               let form_data = new FormData();

               form_data.append("name", name);
               form_data.append("email", email);
               form_data.append("password", password);
               form_data.append("file", file_data);

               $.ajax({
                  url: "http://localhost/telecord/save_register.php",
                  dataType: "text",
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: form_data,
                  type: "post",
                  success: function (data) {
                     if (data === "emailExist") {
                        $("#error-email").text(
                           "* Your email is already exist."
                        );
                        $("#email").parent().addClass("error");
                     } else if ((data = "done")) {
                        if ($("#email").parent().hasClass("error")) {
                           $("#email").parent().removeClass("error");
                        }
                        window.location.replace(
                           "http://localhost/telecord/login.php"
                        );
                     }
                  },
               });
            }
         } else {
            $("#error-email").text("* Your email format is incorrect.");
            $("#email").parent().addClass("error");
         }
      }
   });
});
