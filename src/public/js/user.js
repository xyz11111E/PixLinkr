$(document).ready(function () {
  // --- 1. Add User Role ---
  $("#role-form").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "/add-user-role",
      method: "POST",
      data: $(this).serialize(),
      beforeSend: function () {
        $("#role-form button").text("Please wait...");
      },
      success: function (response) {
        $("#role-form button").text("Add Role");
        $("#page-success").text("").css("display", "none");
        $("#page-error").text("").css("display", "none");

        if (response.success) {
          $("#page-success")
            .text(response.success)
            .css("display", "inline-block");
        } else {
          $("#page-error").text(response.error).css("display", "inline-block");
        }
      },
      error: function () {
        $("#role-form button").text("Add Role");

        $("#page-error")
          .text("something_went_wrong")
          .css("display", "inline-block");
      },
    });
  });

  // --- 2. Delete User Role ---
  $(".del-role-form").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "/del-user-role",
      method: "POST",
      data: $(this).serialize(),
      beforeSend: function () {
        $(this).find("button").text("Please wait...");
      },
      success: function (response) {
        $(this).find("button").text("Delete Role");
        $("#page-success").text("").css("display", "none");
        $("#page-error").text("").css("display", "none");

        if (response.success) {
          $("#page-success")
            .text(response.success)
            .css("display", "inline-block");
        } else {
          $("#page-error").text(response.error).css("display", "inline-block");
        }
      },
      error: function () {
        $(this).find("button").text("Delete Role");

        $("#page-error")
          .text("something_went_wrong")
          .css("display", "inline-block");
      },
    });
  });
});
