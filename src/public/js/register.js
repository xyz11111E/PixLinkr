$(document).ready(function () {
  $("#register-form").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "/register",
      method: "POST",
      data: $(this).serialize(),
      beforeSend: function () {
        $("#register-form button").text("Please wait...");
      },
      success: function (response) {
        $("#register-form button").text("Register");
        $("#form-success").text("").css("display", "none");
        $("#form-error").text("").css("display", "none");

        if (response.success) {
          $("#form-success")
            .text(response.success)
            .css("display", "inline-block");
        } else {
          $("#form-error").text(response.error).css("display", "inline-block");
        }
      },
      error: function () {
        $("#register-form button").text("Register");

        $("#form-error")
          .text("something_went_wrong")
          .css("display", "inline-block");
      },
    });
  });
});
