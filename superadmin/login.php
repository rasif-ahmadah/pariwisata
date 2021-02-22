<?php
include '../connect.php';

if(isset($_SESSION['nama'])&&isset($_SESSION['email'])&&isset($_SESSION['idUser'])){
  header("location:$URL/admin/akun_dashboard");
}

if( 
    isset($_POST['email']) && isset($_POST['pass'])){
        $email = htmlentities(strip_tags(trim($_POST['email'])));
        $password = htmlentities(strip_tags(trim($_POST['pass'])));
      
        $message="Akun Tidak ditemukan";
        if(isEmailAvaiable($connect,$email)){
          $where = array (
            "email" => $email
          );
          $data=showAdmin($connect,$where);

          if(password_verify($password, $data[0]['password'])){
            session_start();
            $_SESSION['idUser']=$data[0]['id'];
            $_SESSION["email"]=$data[0]['email'];
            $_SESSION["nama"]=$data[0]['nama'];
            $message="Selamat Datang";

            header("location:$URL/admin/akun_dashboard");
          }
          else 
           $message="Password salah";
        }
        
         $_SESSION['pesan']=$message;
        // print_r($myvalue);
        // echo"masuk";
        header("location:$URL/masuk");
        // echo "masuk";
  }
  
  
?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai|Lato&display=swap" rel="stylesheet">
      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <link rel="stylesheet" href="superadmin/css/superadmin.css">

      <meta name="description" content="Website Sasmita Blitar" />
      <meta name="keywords" content="Kabupaten Blitar, Sasmita Blitar, Pariwisata, Pantai, Gunung, Dinas Pariwisata, Blitar Indah" />
      <meta name="author" content="Dandi Wibowo" />

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="icon" href="../images/logo.png" type="image/x-icon" />
      <title>Sasmita Blitar</title>
    </head>

    <body class="row" style="margin:0px; padding:0px; background:#f4f4f4;">
	  
    <div class="lform row col xl4 l4 m6 s12 push-xl4 push-l4 push-m3" style="background:white; text-align:center; padding:30px;">
      <p style="font-size:28px;">Login</p>
      <form style="text-align:left;" action="" method="post">

        <div class="col s12" style="padding: 0px; margin:0px;">
          Email: 
          <div class="col s12" style="padding: 0px; margin:0px;">
            <input type="text" name="email" placeholder="Email">
          </div>
        </div>

        <div class="col s12" style="padding: 0px; margin:0px;">
          Password: 
          <div class="col s12" style="padding: 0px; margin:0px;">
            <input id="pass" class="col s11" type="password" name="pass" placeholder="Password">
            <a id="showPass" onclick="changePassType()" href="#" class="material-icons col s1">visibility</a>
          </div>
        </div>
        <input class="btn red" type="submit" value="Login">
      </form>
    </div>
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	  <script>
        var passStat=0;
        $(document).ready(function(){
            $('.tooltipped').tooltip();
            $(".sidenav").sidenav();
            $(".tooltipped").tooltip();
            $(".collapsible").collapsible();
            $(".modal").modal();
            $('.dropdown-trigger').dropdown();
            $("#signinForm").css("display","none");
            $("#btAdd").attr("disabled","disabled");
        });

        function changePassType(){

          if(passStat == 1){
            $("#pass").attr("type","password");
            $("#showPass").html("visibility");
            passStat=0;

          }

          else{
            $("#pass").attr("type","text");
            $("#showPass").html("visibility_off");
            passStat=1;
          }
        }
  </script>

    </body>
  </html>
        