$(document).ready(() => {
  $("#login").validate({
    errorClass: "is-invalid",
    rules: {
      email: {
        required: true,
        email: true,
      },
      senha: {
        required: true,
        minlength: 8,
      }
    },
    submitHandler: () => {
      $("input[type='submit']").attr("disabled", true);
      $.ajax({
        type: "POST",
        url: root_path + "/login/login",
        data: $("#login").serialize(),
        dataType: "json",
        success: function (response) {
          if (response && response.success) {
            window.location.href = root_path + "/home";
          } else {
            $("input[type='submit']").attr("disabled", false);
            Swal.fire({
              type: "error",
              title: default_error_title,
              text: default_error_text,
            });
          }
        },
        error: function (response) {
          $("input[type='submit']").attr("disabled", false);
          Swal.fire({
            type: "error",
            title: response.responseJSON.title,
            text: response.responseJSON.text,
          });
        },
      });
    },
  });
});
