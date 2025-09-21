$(document).ready(function () {
  $("#login-form").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "/login",
      method: "POST",
      data: $(this).serialize(),
      beforeSend: function () {
        $("#login-form button").text("Please wait...");
      },
      success: function (response) {
        $("#login-form button").text("Login");
        $("#form-success").text("").css("display", "none");
        $("#form-error").text("").css("display", "none");

        if (response.success) {
          $("#form-success")
            .text(response.success)
            .css("display", "inline-block");

          window.location.href = "/account";
        } else {
          $("#form-error").text(response.error).css("display", "inline-block");
        }
      },
      error: function () {
        $("#login-form button").text("Register");

        $("#form-error")
          .text("something_went_wrong")
          .css("display", "inline-block");
      },
    });
  });
});
