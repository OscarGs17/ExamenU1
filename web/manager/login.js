const regex_pass = /^[0-9]{8,}$/;
const regex_user = /^[a-zA-Z0-9]{3,16}$/;

const val_user = valor => !(regex_user.test(valor))
const val_pass = valor => !(regex_pass.test(valor))

$(document).ready(()=>{
  console.log('Carga de vista: registro... 100%');


  $('#btn_login').click(()=>{
    console.log('Btn_login: evento click... OK');

    $.ajax({
      type: 'POST',
      data:{
        "usuario": $('#in_usuario').val(),
        "password": $('#in_password').val()
      },
      url:"./control/login.php",
      success: r => {

        console.log('Respuesta desde el Servidor:');
        console.log(r);

        console.log('Parseando...');
        let obj=JSON.parse(r);
        console.log(obj);
      
        if(parseInt(obj.valor) == 9){
          Swal.fire({
            title: "Bad job!",
            text: "No hay coincidencias",
            icon: "error"
          });
        }
        
        if(parseInt(obj.valor) == 0){
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Bienvenido\n\n" + obj.usuario + "\n\nTu id es: " + obj.id,
            showConfirmButton: false,
            timer: 5000
          }).then((value) => {
            window.location = "home";
          });
        } 
      }
    });
  });
});