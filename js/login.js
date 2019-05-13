$(document).ready(function(){
  $("#clicko").on("click",function(){

    var user = document.getElementById("logge").value;
    var pass = document.getElementById("passe").value;

    if(user != "" && pass != ""){
        $.ajax({
        type: "POST",
        url: "../utility/login.php",
        dataType: "json",
        data: {
          username: JSON.stringify(user),
          password: JSON.stringify(pass)
        },
        success: function(login){
          if(login == true){
            location.reload();
          }else{
            user = '';
            pass = '';
          }
        }
      });

      }
  });
});
