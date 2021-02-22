<?php
include '../connect.php';

if(!isset($_SESSION['nama'])&&!isset($_SESSION['email'])&&!isset($_SESSION['idUser'])){
  header("location:$URL/masuk");
}

if( 
    isset($_POST['nama']) && isset($_POST['email']) && 
    isset($_POST['password'])){
        $nama = htmlentities(strip_tags(trim($_POST['nama'])));
        $email = htmlentities(strip_tags(trim($_POST['email'])));
        $password = htmlentities(strip_tags(trim($_POST['password'])));

        $where = array (
          "id" => $_SESSION['idUser']
        );

        $dataAdmin= showAdmin($connect,$where);

        if($dataAdmin[0]['email']!=$_SESSION['email']){
          if(isEmailAvaiable($connect,$email)){
            $_SESSION["email"]=$email;
          }
        }

        if($dataAdmin[0]['password']!=$password){
          $password=password_hash($password, PASSWORD_DEFAULT);
        }

        
         
        $message="Data gagal diubah";
        // $file_dir=explode("../",$target_file);
        $myvalue = array(
          "nama"=>$nama,
          "email" => $email,
          "password" => $password,
          "status" => "aktif"
          
        );
        
        if(updateAdmin($connect,$where,$myvalue)){
          $message="Data berhasil diubah";
        }
        
        $_SESSION['pesan']=$message;
        // print_r($myvalue);
        // echo"masuk";
        header("location:$URL/admin/setting_dashboard");
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
      <link rel="stylesheet" href="../superadmin/css/superadmin.css">

      <meta name="description" content="Website Sasmita Blitar" />
      <meta name="keywords" content="Kabupaten Blitar, Sasmita Blitar, Pariwisata, Pantai, Gunung, Dinas Pariwisata, Blitar Indah" />
      <meta name="author" content="Dandi Wibowo" />

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="icon" href="../images/logo.png" type="image/x-icon" />
      <title>Sasmita Blitar</title>
    </head>

    <body class="row" style="margin:0px; padding:0px; background:#f4f4f4;">
	
	  <!--isi-->
	  <div class="col s12 l8 push-l3 isi">
      <h4><b>Setting</b></h4>
      <?php 
        $dataAdmin=showAdmin($connect, array("id" => $_SESSION['idUser']));
      ?>
      <form action="" method="POST">
          <div class="row">
              <div class="input-field col s12">
                  <input placeholder="Nama Lengkap" id="nama" value="<?php echo $dataAdmin[0]['nama']; ?>" name="nama" type="text" class="validate">
                  <label for="nama">Nama Lengkap</label>
              </div>
              
              <div class="input-field col m6 s12">
                  <input placeholder="Email" id="email" value="<?php echo $dataAdmin[0]['email']; ?>" name="email" type="email" class="validate">
                  <label for="email">Email</label>
              </div>
              <div class="input-field col m6 s12">
                  <input placeholder="Password" id="password" value="<?php echo $dataAdmin[0]['password']; ?>" name="password" type="password" class="validate">
                  <label for="password">Password</label>
              </div>                        
          </div>
          <input type="submit" class="btn" value="simpan">
      </form>
    </div>
		
		
	
	  
	  <!--navbar-->
	  <?php include 'nav.php';?>
  
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	  <script>

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

        function setDelete(x){
          $("#delContent").load("<?php echo $URL; ?>/superadmin/modContent.php?delAdmin="+x);
        }
  </script>

    </body>
  </html>
        