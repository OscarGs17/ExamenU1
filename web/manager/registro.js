const regex_pass = /^[0-9]{8,}$/;
const regex_user = /^[a-zA-Z0-9]{3,16}$/;

const val_user = (valor) => !regex_user.test(valor);
const val_pass = (valor) => !regex_pass.test(valor);

const showAlert = (title, text, icon) => {
  Swal.fire({
    title: title,
    text: text,
    icon: icon
  });
};

const val_general = () => {
  const usuario = $('#reg_usuario').val();
  const password = $('#reg_password').val();

  if (val_user(usuario)) {
    showAlert("Bad job!", "Usuario Invalido", "error");
    return;
  }

  if (val_pass(password)) {
    showAlert("Bad job!", "Password Invalido", "error");
    return;
  }

  console.log('Evaluación de datos correctos...');
  console.log('User: ' + usuario);
  console.log('Password: ' + password);
  console.log('Iniciando construcción de objeto AJAX...');

  $.ajax({
    type: 'POST',
    data: {
      usuario: usuario,
      password: password
    },
    url: './control/registro.php',
    success: (r) => {
      console.log('Respuesta desde el Servidor:');
      console.log(r);
      switch (parseInt(r)) {
        case 9:
          showAlert("Bad job!", "Usuario Invalido", "error");
          break;
        case 8:
          showAlert("Bad job!", "Password Invalido", "error");
          break;
        case 7:
          showAlert("Bad job!", "El usuario ya existe", "error");
          break;
        case 0:
          showAlert("Good job!", "Usuario creado en el sistema", "success");
          break;
        default:
          showAlert("Bad job!", "Error al crear el usuario", "error");
          break;
      }
    }
  });
};

$(document).ready(() => {
  console.log('Carga de vista: registro... 100%');
  $('#btn_registro').click(() => {
    console.log('Btn_registro: evento click... OK');
    val_general();
  });
});
