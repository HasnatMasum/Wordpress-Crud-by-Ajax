(function($) {
  //For insert data
  $(document).on("submit", "#person-form", function(e) {
    e.preventDefault();
    $(".sacrud-message").html("");
    var saname = $("#name").val();
    var saemail = $("#email").val();
    var saage = $("#age").val();
    if (saname == "") {
      $(".sacrud-name-msg").html("Name is Required");
      $(".sacrud-name-msg").css("color", "red");
    }
    if (saemail == "") {
      $(".sacrud-email-msg").html("Email is Required");
      $(".sacrud-email-msg").css("color", "red");
    }
    if (saage == "") {
      $(".sacrud-age-msg").html("Age is Required");
      $(".sacrud-age-msg").css("color", "red");
    }
    if (saname != "" && saemail != "" && saage != "") {
      var sa_fd = new FormData(this);
      var action = "sacrud_entry";
      sa_fd.append("action", action);

      $.ajax({
        data: sa_fd,
        type: "POST",
        url: sacrud_ajax.ajaxurl,
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
          var res = JSON.parse(response);
          $(".sacrud-message").html(res.message);
          if (res.rescode != "404") {
            $("#person-form")[0].reset();
            $(".sacrud-message").css("color", "green");
          } else {
            $(".sacrud-message").css("color", "red");
          }
        }
      });
    } else {
      return false;
    }
  });

  //For Update Data
  $(document).on("submit", "#person-form-upd", function(e) {
    e.preventDefault();
    $(".sacrud-message").html("");
    var saname = $("#name").val();
    var saemail = $("#email").val();
    var saage = $("#age").val();
    if (saname == "") {
      $(".sacrud-name-msg").html("Name is Required");
    }
    if (saemail == "") {
      $(".sacrud-email-msg").html("Email is Required");
    }
    if (saage == "") {
      $(".sacrud-age-msg").html("Age is Required");
      $(".sacrud-age-msg").css("color", "red");
    }
    if (saname != "" && saemail != "" && saage != "") {
      var sa_fd = new FormData(this);
      var action = "sacrud_edit";
      sa_fd.append("action", action);

      $.ajax({
        data: sa_fd,
        type: "POST",
        url: sacrud_ajax.ajaxurl,
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
          var res = JSON.parse(response);
          $(".sacrud-message").html(res.message);
          if (res.rescode != "404") {
            $(".sacrud-message").css("color", "green");
          } else {
            $(".sacrud-message").css("color", "red");
          }
        }
      });
    } else {
      return false;
    }
  });
  $(".dp-person").css("width", "95%");
})(jQuery);
