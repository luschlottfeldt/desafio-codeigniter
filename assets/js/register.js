$(document).ready(() => {
  $("#register").validate({
    errorClass: "is-invalid",
    rules: {
      nome: {
        required: true,
        minlength: 4,
        maxlength: 100,
      },
      email: {
        required: true,
        email: true,
      },
      senha: {
        required: true,
        minlength: 8,
      },
      senha2: {
        required: true,
        equalTo: 'input[name="senha"]',
      },
    },
    submitHandler: () => {
      $("input[type='submit']").attr("disabled", true);
      $.ajax({
        type: "POST",
        url: root_path + "/register/register",
        data: $("#register").serialize(),
        dataType: "json",
        success: function (response) {
          if (response && response.success) {
            Swal.fire({
              type: "success",
              title: response.title,
              text: response.text,
            }).then(() => {
              window.location.href = root_path + "/login";
            });
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
            title: response.title,
            text: response.text,
          });
        },
      });
    },
  });
});
