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

        $message="Maaf, Email sudah digunakan";
        if(!isEmailAvaiable($connect,$email)){
         
          $message="Data gagal ditambahkan";
          // $file_dir=explode("../",$target_file);
          $myvalue = array(
            "nama"=>$nama,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "status" => "aktif"
            
          );
          
          if(addToAdmin($connect,$myvalue)){
            $message="Data berhasil ditambahkan";
          }
        }
        $_SESSION['pesan']=$message;
        // print_r($myvalue);
        // echo"masuk";
        header("location:$URL/admin/akun_dashboard");
        // echo "masuk";
  }
  
  else if( isset($_POST['deleteAdmin'])){
    $message="Data gagal dihapus";
    if(deleteAdmin($connect,"id",$_POST['deleteAdmin'])){
      $message="Data berhasil dihapus";
    }
    
    $_SESSION['pesan']=$message;
    // print_r($myvalue);
    // echo"masuk";
    header("location:$URL/admin/akun_dashboard");
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
	  <!--=========================== Modal tambah akomodasi ==============================-->
        <!-- Modal Structure -->
        <div id="modAddArtikel" class="modal">
            <div class="modal-content">
                <h5><b>Tambah Admin</b></h5>
                <form action="" method="POST">
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="Nama Lengkap" id="nama" name="nama" type="text" class="validate">
                            <label for="nama">Nama Lengkap</label>
                        </div>
                        
                        <div class="input-field col m6 s12">
                            <input placeholder="Email" id="email" name="email" type="email" class="validate">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Password" id="password" name="password" type="text" class="validate">
                            <label for="password">Password</label>
                        </div>                        
                    </div>
                    <input type="submit" class="btn" value="simpan">
                </form>
            </div>
        </div>
    <!-- ========================================================================= -->

    <!--=========================== Modal Delete ==============================-->
        <!-- Modal Structure -->
        <div id="modDelArtikel" class="modal">
          <div class="modal-content" id="delContent">
            <div class="progress">
                <div class="indeterminate"></div>
            </div>
          </div>
        </div>
    <!-- ========================================================================= -->
	  <div class="col s12 l8 push-l3 ">
       <!-- ============================== Balok balok ===================================== -->

       <div class="row" style=" margin:0px;">
        <div class="" style="text-align:center; padding-top:30px; font-family: 'Amaranth', sans-serif;">
          

          <div class="row" style="margin-top:70px;margin-bottom:0px;">

            <div class="row col  m4 s12" style="padding :20px !important;">
              <a class="orange col s12 " href="<?php echo $URL."/destinasi";?>" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); color:white; padding:10px;">
                <div class="col s12">
                  <span class="" style="font-size:50px;"><?php echo sizeof(showWisata($connect,"all"));?></span>
                  <i style="font-size:55px;" class="material-icons">local_florist</i>
                </div>
                
                <div class="col s12" style="font-size:20px; border-top:1px solid white">
                  Destinasi Wisata
                </div>
              </a>
            </div>
            
            <div class="row col  m4 s12" style="padding :20px !important;">
              <a class="blue col s12 " href="<?php echo $URL."/akomodasi";?>" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); color:white; padding:10px;">
                <div class="col s12">
                  <span class="" style="font-size:50px;"><?php echo sizeof(showAkomodasi($connect,"all"));?></span>
                  <i style="font-size:55px;" class="material-icons">apartment</i>
                </div>
                
                <div class="col s12" style="font-size:20px; border-top:1px solid white">
                  Akomodasi
                </div>
              </a>
            </div>

            <div class="row col  m4 s12" style="padding :20px !important;">
              <a class="purple col s12 " href="<?php echo $URL."/kuliner";?>" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); color:white; padding:10px;">
                <div class="col s12">
                  <span class="" style="font-size:50px;"><?php echo sizeof(showKuliner($connect,"all"));?></span>
                  <i style="font-size:55px;" class="material-icons">store</i>
                </div>
                
                <div class="col s12" style="font-size:20px; border-top:1px solid white">
                  Kuliner
                </div>
              </a>
            </div>

            <div class="row col  m4 s12" style="padding :20px !important;">
              <a class="green  col s12 " href="<?php echo $URL."/event";?>" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); color:white; padding:10px;">
                <div class="col s12">
                  <span class="" style="font-size:50px;"><?php echo sizeof(showEvent($connect,"all"));?></span>
                  <i style="font-size:55px;" class="material-icons">category</i>
                </div>
                
                <div class="col s12" style="font-size:20px; border-top:1px solid white">
                  Event
                </div>
              </a>
            </div>

            <div class="row col  m4 s12" style="padding :20px !important;">
              <a class="yellow darken-2  col s12 " href="<?php echo $URL."/news";?>" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); color:white; padding:10px;">
                <div class="col s12">
                  <span class="" style="font-size:50px;"><?php echo sizeof(showArtikel($connect,array("kategori"=>"news")));?></span>
                  <i style="font-size:55px;" class="material-icons">menu_book</i>
                </div>
                
                <div class="col s12" style="font-size:20px; border-top:1px solid white">
                  news
                </div>
              </a>
            </div>

            <div class="row col  m4 s12" style="padding :20px !important;">
              <a class="red  col s12 " href="<?php echo $URL."/event";?>" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); color:white; padding:10px;">
                <div class="col s12">
                  <span class="" style="font-size:50px;"><?php echo sizeof(showAdmin($connect,"all"));?></span>
                  <i style="font-size:55px;" class="material-icons">group</i>
                </div>
                
                <div class="col s12" style="font-size:20px; border-top:1px solid white">
                  Admin
                </div>
              </a>
            </div>

          </div>
        </div>
      </div>

      <!-- ================================================================================ -->

    </div>
	
	
	  <!--isi-->
	  <div class="col s12 l8 push-l3 listAdminSheet">

      <h4><b>List Akun</b><a href="#modAddArtikel" class="modal-trigger btn-floating blue right"><i class="material-icons">add</i></a></h4>
      <table class=" striped highlight">
        <thead>
          <tr>
              <th>Nama</th>
              <th>Email</th>
              <th>Status</th>
              <th></th>
          </tr>
        </thead>

        <tbody>
          <?php
            $dataAdmin=showAdmin($connect,"all");
            for($a=0;$a<sizeof($dataAdmin);$a++){
          ?>
          <tr>
            <td><?php echo $dataAdmin[$a]['nama']; ?></td>
            <td><?php echo $dataAdmin[$a]['email']; ?></td>
            <td><?php echo $dataAdmin[$a]['status']; ?></td>
            <td><a href="#modDelArtikel" class="modal-trigger material-icons"  onclick="setDelete(<?php echo $dataAdmin[$a]['id']; ?>)">delete</a></td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
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
        