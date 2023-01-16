$(document).ready(function () {
   $("#info-btn").on("click", function () {
      $("#main-box").addClass("show-left");
   });

   $("#left").on("click", function () {
      $("#main-box").removeClass("show-left");
   })


   $("#send").on("click", function () {
      if ($("#message").val() !== "") {
         $.ajax({
            url: "http://localhost/telecord/save_message.php",
            method: "POST",
            contentType: "application/json",
            datatype: "json",
            data: JSON.stringify({
               user_id: $(".userId").attr("id"),
               message: $("#message").val(),
            }),
            success: function (data) {
               if (data === "saved") {
                  $("#message").val("");
               }
            }
         });
      }
   });

   $("#message").on("keyup", function (e) {
      if (e.keyCode === 13) {
         $("#send").click();
      }
   });

   setInterval(() => {
      $("#members-wrapper").load("load_members.php");
      $("#messages").load("load_messages.php");
   }, 50);
});
