$(document).ready(() => {
  $("input[name='valor']").mask('0000000000.00', {reverse: true});

  const rules = {
    nome: {
      required: true,
      minlength: 4,
      maxlength: 100,
    },
    codigoDeBarras: {
      required: true,
      minlength: 4,
      maxlength: 30,
    },
    descricao: {
      required: true,
    },
    valor: {
      required: true,
    },
  };

  $("#cadastrar").validate({
    errorClass: "is-invalid",
    rules,
    submitHandler: () => {
      $("input[type='submit']").attr("disabled", true);
      $.ajax({
        type: "POST",
        url: root_path + "/produtos/register",
        data: $("#cadastrar").serialize(),
        dataType: "json",
        success: function (response) {
          if (response && response.success) {
            Swal.fire({
              type: "success",
              title: response.title,
              text: response.text,
            }).then(() => {
              window.location.href = root_path + "/produtos/gerenciar";
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
        url: root_path + "/produtos/update",
        data: $("#atualizar").serialize(),
        dataType: "json",
        success: function (response) {
          if (response && response.success) {
            Swal.fire({
              type: "success",
              title: response.title,
              text: response.text,
            }).then(() => {
              window.location.href = root_path + "/produtos/gerenciar";
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
    const idProduto = this.value;

    $.ajax({
      type: "POST",
      url: root_path + "/produtos/active",
      data: { ativo, idProduto },
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
