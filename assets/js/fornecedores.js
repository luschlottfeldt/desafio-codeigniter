$(document).ready(() => {
  $("input[name='cnpj']").mask("00.000.000.000/0000-00");
  $("input[name='telefone']").mask("(00) 00009-0000");
  $("input[name='cep']").mask("00000-000");

  const rules = {
    razaoSocial: {
      required: true,
      minlength: 4,
      maxlength: 100,
    },
    nomeFantasia: {
      required: true,
      minlength: 4,
      maxlength: 100,
    },
    cnpj: {
      required: true,
      maxlength: 22,
    },
    nomeResponsavel: {
      required: true,
      minlength: 4,
      maxlength: 100,
    },
    email: {
      required: true,
      email: true,
    },
    telefone: {
      required: true,
      maxlength: 15,
    },
    cep: {
      required: true,
      maxlength: 9,
    },
    endereco: {
      required: true,
      maxlength: 100,
    },
    numero: {
      required: true,
      maxlength: 8,
    },
    bairro: {
      required: true,
      maxlength: 100,
    },
    cidade: {
      required: true,
      maxlength: 100,
    },
    estado: {
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
        url: root_path + "/fornecedores/register",
        data: $("#cadastrar").serialize(),
        dataType: "json",
        success: function (response) {
          if (response && response.success) {
            Swal.fire({
              type: "success",
              title: response.title,
              text: response.text,
            }).then(() => {
              window.location.href = root_path + "/fornecedores/gerenciar";
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
        url: root_path + "/fornecedores/update",
        data: $("#atualizar").serialize(),
        dataType: "json",
        success: function (response) {
          if (response && response.success) {
            Swal.fire({
              type: "success",
              title: response.title,
              text: response.text,
            }).then(() => {
              window.location.href = root_path + "/fornecedores/gerenciar";
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
    const idFornecedor = this.value;

    $.ajax({
      type: "POST",
      url: root_path + "/fornecedores/active",
      data: { ativo, idFornecedor },
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

  $("input[name='cep']").on("keyup", async function (e) {
    e.preventDefault();
    const count = $(this).val();

    if (count.length === 9) {
      const cep = count.split("-").join("");
      $(this).blur();

      const result = await getCep(cep);

      if (result.erro) {
        Swal.fire({
          type: "error",
          title: 'Ops...',
          text: 'Endereço não encontrado.',
        });
        return;
      }
      
      $("input[name='endereco']").val(result.logradouro);
      $("input[name='bairro']").val(result.bairro);
      $("input[name='cidade']").val(result.localidade);
      $("select[name='estado']").val(result.uf);
      $("input[name='numero']").focus();
    }
  });

  async function getCep(cep) {
    return await $.getJSON("https://viacep.com.br/ws/" + cep + "/json/");
  }
});
