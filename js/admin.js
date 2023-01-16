$(document).ready(function () {
   $(document).on("click", "button[id='reply']", function () {
      $(
         `div[id=${$(this)
            .parent()
            .parent()
            .attr("id")}] div[id='contact-buttons']`
      ).css("display", "none");
      $(
         `div[id=${$(this).parent().parent().attr("id")}] div[id='reply-box']`
      ).css("display", "block");
   });

   $(document).on("click", 'button[id="cancel"]', function () {
      $.ajax({
         url: "http://localhost/telecord/delete_contact.php",
         method: "POST",
         datatype: "text",
         data: {
            delete_id: $(this).parent().parent().attr("id"),
         },
         success: function (data) {
            $("#contact-forms-box").load("contact_forms_load.php");
         },
      });
   });

   $(document).on("click", "button[id='reply-cancel']", function () {
      $(
         `div[id=${$(this)
            .parent()
            .parent()
            .parent()
            .attr("id")}] div[id='contact-buttons']`
      ).css("display", "flex");
      $(
         `div[id=${$(this)
            .parent()
            .parent()
            .parent()
            .attr("id")}] div[id='reply-box']`
      ).css("display", "none");
   });

   $(document).on("click", 'button[id="reply-send"]', function () {
      $(this).html("<div class='loading'></div>");
      let isSent = "false";
      let id = $(this).parent().parent().parent().attr("id");
      let get_email = $(
         `div[id=${$(this)
            .parent()
            .parent()
            .parent()
            .attr("id")}] p[id="contact-email"]`
      ).text();
      let email = get_email.slice(2, get_email.length - 1);

      $.ajax({
         url: "http://localhost/telecord/reply_contact.php",
         method: "POST",
         contentType: "application/json",
         datatype: "json",
         data: JSON.stringify({
            id: id,
            message: $(
               `div[id=${$(this)
                  .parent()
                  .parent()
                  .parent()
                  .attr("id")}] textarea`
            ).val(),
            email: email,
         }),
         success: function (data) {
            $(`div[id=${id}] #reply-send`).html("<i class='bi bi-check2'></i>");
            setTimeout(() => {
               $.ajax({
                  url: "http://localhost/telecord/delete_contact.php",
                  method: "POST",
                  datatype: "text",
                  data: {
                     delete_id: id,
                  },
                  success: function (data) {
                     $("#contact-forms-box").load("contact_forms_load.php");
                  },
               });
            }, 1000);
         },
      });
      
   });

   $("#refresh").on("click", function () {
      if ($("#contact-forms-box").children().attr("id") == "no-contact") {
         $("#no-contact").css("display", "none");
      }
      $("#contact-forms-box").load("contact_forms_load.php");
   });

   setInterval(() => {
      $("#noti").load(
         "noti_load.php?num=" +
            $("#contact-forms-box").children().length +
            "&child=" +
            $("#contact-forms-box").children().attr("id")
      );
   }, 50);
});
