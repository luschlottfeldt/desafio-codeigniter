$(document).ready(() => {
  $('#cadastrar').submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: root_path + "/webservice/register",
      data: $("#cadastrar").serialize(),
      dataType: "json",
      success: function (response) {
        if (response && response.success) {
          Swal.fire({
            type: "success",
            title: response.title,
            text: response.text,
          }).then(() => {
            window.location.href = root_path + "/webservice/gerenciar";
          });
        } else {
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
  })

  $("input[name='ativo']").change(function () {
    const ativo = this.checked;
    const idToken = this.value;

    $.ajax({
      type: "POST",
      url: root_path + "/webservice/active",
      data: { ativo, idToken },
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
