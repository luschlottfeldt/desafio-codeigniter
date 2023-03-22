$(document).ready(() => {
  const rules = {
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
  };

  $("#cadastrar").validate({
    errorClass: "is-invalid",
    rules,
    submitHandler: () => {
      $("input[type='submit']").attr("disabled", true);
      $.ajax({
        type: "POST",
        url: root_path + "/usuarios/register",
        data: $("#cadastrar").serialize(),
        dataType: "json",
        success: function (response) {
          if (response && response.success) {
            Swal.fire({
              type: "success",
              title: response.title,
              text: response.text,
            }).then(() => {
              window.location.href = root_path + "/usuarios/gerenciar";
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
            title: response.responseJSON.title,
            text: response.responseJSON.text,
          });
        },
      });
    },
  });

  $("#atualizar").validate({
    errorClass: "is-invalid",
    rules,
    submitHandler: () => {
      $("input[type='submit']").attr("disabled", true);
      $.ajax({
        type: "POST",
        url: root_path + "/usuarios/update",
        data: $("#atualizar").serialize(),
        dataType: "json",
        success: function (response) {
          if (response && response.success) {
            Swal.fire({
              type: "success",
              title: response.title,
              text: response.text,
            }).then(() => {
              window.location.href = root_path + "/usuarios/gerenciar";
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
            title: response.responseJSON.title,
            text: response.responseJSON.text,
          });
        },
      });
    },
  });

  $("input[name='ativo']").change(function () {
    const ativo = this.checked;
    const idUsuario = this.value;

    $.ajax({
      type: "POST",
      url: root_path + "/usuarios/active",
      data: { ativo, idUsuario },
      dataType: "json",
      success: function (response) {
        if (!response) {
          Swal.fire({
            type: "error",
            title: default_error_title,
            text: default_error_text,
          });
        }
      },
      error: function (response) {
        Swal.fire({
          type: "error",
          title: response.responseJSON.title,
          text: response.responseJSON.text,
        });
      },
    });
  });
});
