$(document).ready(() => {
  $("form.addProdutos").submit(function (e) {
    e.preventDefault();

    $.ajax({
      type: "POST",
      url: root_path + "/pedidos/addToCart",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response && response.success) {
          Swal.fire({
            type: "success",
            title: response.title,
            text: response.text,
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
  });

  $("form#cadastrar").submit(function (e) {
    e.preventDefault();

    $.ajax({
      type: "POST",
      url: root_path + "/pedidos/finish",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response && response.success) {
          Swal.fire({
            type: "success",
            title: response.title,
            text: response.text,
          }).then(() => {
            window.location.href = root_path + "/pedidos/gerenciar";
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
  });

  $("form.alterarProdutos").submit(function (e) {
    e.preventDefault();

    $.ajax({
      type: "POST",
      url: root_path + "/pedidos/changeProduct",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response && response.success) {
          Swal.fire({
            type: "success",
            title: response.title,
            text: response.text,
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
  });

  $("form#alterar").submit(function (e) {
    e.preventDefault();

    $.ajax({
      type: "POST",
      url: root_path + "/pedidos/update",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response && response.success) {
          Swal.fire({
            type: "success",
            title: response.title,
            text: response.text,
          }).then(() => {
            window.location.href = root_path + "/pedidos/gerenciar";
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
  });

  $('#finalizarPedido').click(function() {
    const idPedido = $(this).data('id');
    
    $.ajax({
      type: "POST",
      url: root_path + "/pedidos/finalizeOrder",
      data: { idPedido },
      dataType: "json",
      success: function (response) {
        if (response && response.success) {
          Swal.fire({
            type: "success",
            title: response.title,
            text: response.text,
          }).then(() => {
            window.location.href = root_path + "/pedidos/gerenciar";
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
});
