$(document).ready(function () {
   $("#send_contact").on("click", function () {
      if (
         $("#contact_name").val() === "" &&
         $("#contact_email").val() !== "" &&
         $("#contact_message").val() !== ""
      ) {
         if ($("#modal-content").hasClass("success")) {
            $("#modal-content").removeClass("success");
         }

         if (!$("#modal-content").hasClass("error")) {
            $("#errorModal").html(
               '<i class="bi bi-emoji-frown-fill"></i> Please fill your name.'
            );
            $("#modal-content").addClass("error");
         } else if ($("#modal-content").hasClass("error")) {
            $("#errorModal").html(
               '<i class="bi bi-emoji-frown-fill"></i> Please fill your name.'
            );
         }
      } else if (
         $("#contact_name").val() !== "" &&
         $("#contact_email").val() === "" &&
         $("#contact_message").val() !== ""
      ) {
         if ($("#modal-content").hasClass("success")) {
            $("#modal-content").removeClass("success");
         }

         if (!$("#modal-content").hasClass("error")) {
            $("#errorModal").html(
               '<i class="bi bi-emoji-frown-fill"></i> Please fill your email.'
            );
            $("#modal-content").addClass("error");
         } else if ($("#modal-content").hasClass("error")) {
            $("#errorModal").html(
               '<i class="bi bi-emoji-frown-fill"></i> Please fill your email.'
            );
         }
      } else if (
         $("#contact_name").val() !== "" &&
         $("#contact_email").val() !== "" &&
         $("#contact_message").val() === ""
      ) {
         if ($("#modal-content").hasClass("success")) {
            $("#modal-content").removeClass("success");
         }

         if (!$("#modal-content").hasClass("error")) {
            $("#errorModal").html(
               '<i class="bi bi-emoji-frown-fill"></i> Please fill your message.'
            );
            $("#modal-content").addClass("error");
         } else if ($("#modal-content").hasClass("error")) {
            $("#errorModal").html(
               '<i class="bi bi-emoji-frown-fill"></i> Please fill your message.'
            );
         }
      } else if (
         $("#contact_name").val() !== "" &&
         $("#contact_email").val() !== "" &&
         $("#contact_message").val() !== ""
      ) {
         let re = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
         let emailFormat = re.test($("#contact_email").val());

         if (emailFormat) {
            $.ajax({
               url: "http://localhost/telecord/save_contacts.php",
               method: "POST",
               contentType: "application/json",
               datatype: "json",
               data: JSON.stringify({
                  contact_name: $("#contact_name").val(),
                  contact_email: $("#contact_email").val(),
                  contact_message: $.trim($("#contact_message").val()),
               }),
               success: function (data) {
                  if (!$("#modal-content").hasClass("error")) {
                     $("#modal-content").addClass("success");
                  } else {
                     $("#modal-content").removeClass("error");
                     $("#modal-content").addClass("success");
                  }

                  $("#contact_name").val("");
                  $("#contact_email").val("");
                  $("#contact_message").val("");
               },
               error: function (data) {
                  if (!$("#modal-content").hasClass("error")) {
                     $("#errorModal").html(
                        '<i class="bi bi-emoji-frown-fill"></i> Send Failed.'
                     );
                     $("#modal-content").addClass("error");
                  } else {
                     $("#errorModal").html(
                        '<i class="bi bi-emoji-frown-fill"></i> Send Failed.'
                     );
                  }
               },
            });
         } else {
            if ($("#modal-content").hasClass("success")) {
               $("#modal-content").removeClass("success");
            }

            if (!$("#modal-content").hasClass("error")) {
               $("#errorModal").html(
                  '<i class="bi bi-emoji-frown-fill"></i> Your email format is incorrect.'
               );
               $("#modal-content").addClass("error");
            } else if ($("#modal-content").hasClass("error")) {
               $("#errorModal").html(
                  '<i class="bi bi-emoji-frown-fill"></i> Your email format is incorrect.'
               );
            }
         }
      } else {
         if ($("#modal-content").hasClass("success")) {
            $("#modal-content").removeClass("success");
         }

         if (!$("#modal-content").hasClass("error")) {
            $("#errorModal").html(
               '<i class="bi bi-emoji-frown-fill"></i> Please fill your data before contacting us.'
            );
            $("#modal-content").addClass("error");
         } else if ($("#modal-content").hasClass("error")) {
            $("#errorModal").html(
               '<i class="bi bi-emoji-frown-fill"></i> Please fill your data before contacting us.'
            );
         }
      }
   });

   $("#left").on("click", function () {
      if (
         $("#modal-content").hasClass("error") === true &&
         $("#modal-content").hasClass("success") === false
      ) {
         $("#modal-content").removeClass("error");
      } else if (
         $("#modal-content").hasClass("error") === false &&
         $("#modal-content").hasClass("success") === true
      ) {
         $("#modal-content").removeClass("success");
      } else if (
         $("#modal-content").hasClass("error") === true &&
         $("#modal-content").hasClass("success") === true
      ) {
         $("#modal-content").removeClass("error");
         $("#modal-content").removeClass("success");
      }
   });
});
