<?php
include '../connect.php';

if(!isset($_SESSION['nama'])&&!isset($_SESSION['email'])&&!isset($_SESSION['idUser'])){
  header("location:$URL/masuk");
}

  if( 
    isset($_POST['judul']) && isset($_POST['artikel'])&& isset($_POST['kategori']) && isset($_POST['id_artikel'])
    ){
        $judul = htmlentities(strip_tags(trim($_POST['judul'])));
        $artikel = htmlentities(strip_tags(trim($_POST['artikel'])));
        $kategori = htmlentities(strip_tags(trim($_POST['kategori'])));
        $idArtikel = htmlentities(strip_tags(trim($_POST['id_artikel'])));
        $file_dir="";
        if($_FILES["foto"]['error'] == 0){
          $nArtikel=$idArtikel;
          $foto=explode('.',$_FILES["foto"]["name"]);
          $ext= count($foto)-1;
          $target_dir = "../images/artikel/";
          $nama_file="artikel_$nArtikel.".$foto[$ext];
          $target_file = $target_dir .$nama_file;
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          // Check if image file is a actual image or fake image
          
          $check = getimagesize($_FILES['foto']["tmp_name"]);
          if($check !== false) {
              $message = "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
          } else {
              $message = "File is not an image.";
              $uploadOk = 0;
          }
          
          
          // Check file size
          if ($_FILES['foto']["size"] > (5*1048576)) {
              $message = "Sorry, your file is too large.";
              $uploadOk = 0;
          }
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
              $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              $uploadOk = 0;
          }
          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
              $message = "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
              if (move_uploaded_file($_FILES['foto']["tmp_name"], $target_file)) {
                $tmp_file_dir=explode("../",$target_file);
                $file_dir=$tmp_file_dir[1];
                $where = array(
                  "id" => $idArtikel
                );
                $myvalue= array(
                  "foto"=>$file_dir
                );
                if(updateArtikel($connect,$where,$myvalue))
                  $message = "File berhasil ditambahkan";
              } else {
                  $message = "Sorry, there was an error uploading your file.";
              }
          }
                
        }
       
        $message="Data gagal diubah";
        // $file_dir=explode("../",$target_file);
        $myvalue = array(
          "judul"=>$judul,
          "isi" => $artikel,
          "kategori" => $kategori,
        );
        
        $where = array(
          "id" => $_POST['id_artikel']
        );
        if(updateArtikel($connect,$where,$myvalue)){
          $message="Data berhasil diubah";
        }
        
        
        $_SESSION['pesan']=$message;
        // print_r($myvalue);
        // echo"masuk";
        header("location:$URL/admin/".$_GET['k']."_dashboard");
  }
  else if( 
    isset($_POST['judul']) && isset($_POST['artikel'])&& isset($_POST['kategori'])
    ){
        $judul = htmlentities(strip_tags(trim($_POST['judul'])));
        $artikel = htmlentities(strip_tags(trim($_POST['artikel'])));
        $kategori = htmlentities(strip_tags(trim($_POST['kategori'])));
        $file_dir="";

        $message="Data gagal ditambahkan";
        // $file_dir=explode("../",$target_file);
        $myvalue = array(
          "judul"=>$judul,
          "isi" => $artikel,
          "kategori" => $kategori,
        );
        
        if(addToArtikel($connect,$myvalue)){
          $message="Data berhasil ditambahkan";
        }

        $dataArtikel=showArtikel($connect,$myvalue);
        $idArtikel=$dataArtikel[0]['id'];

        if($_FILES["foto"]['error'] == 0){
          $nArtikel=$idArtikel;
          $foto=explode('.',$_FILES["foto"]["name"]);
          $ext= count($foto)-1;
          $target_dir = "../images/artikel/";
          $nama_file="artikel_$nArtikel.".$foto[$ext];
          $target_file = $target_dir .$nama_file;
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          // Check if image file is a actual image or fake image
          
          $check = getimagesize($_FILES['foto']["tmp_name"]);
          if($check !== false) {
              $message = "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
          } else {
              $message = "File is not an image.";
              $uploadOk = 0;
          }
          
          
          // Check file size
          if ($_FILES['foto']["size"] > (5*1048576)) {
              $message = "Sorry, your file is too large.";
              $uploadOk = 0;
          }
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
              $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              $uploadOk = 0;
          }
          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
              $message = "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
              if (move_uploaded_file($_FILES['foto']["tmp_name"], $target_file)) {
                $tmp_file_dir=explode("../",$target_file);
                $file_dir=$tmp_file_dir[1];
                $where = array(
                  "id" => $idArtikel
                );
                $myvalue= array(
                  "foto"=>$file_dir
                );
                if(updateArtikel($connect,$where,$myvalue))
                  $message = "File berhasil ditambahkan";
              } else {
                  $message = "Sorry, there was an error uploading your file.";
              }
          }
                
        }
        
        
        
        $_SESSION['pesan']=$message;
        // print_r($myvalue);
        // echo"masuk";
        header("location:$URL/admin/".$_GET['k']."_dashboard");
  }
  
  else if( isset($_POST['deleteArtikel'])){
    $message="Data gagal dihapus";
    if(deleteArtikel($connect,"id",$_POST['deleteArtikel'])){
      $message="Data berhasil dihapus";
    }
    
    $_SESSION['pesan']=$message;
    // print_r($myvalue);
    // echo"masuk";
    header("location:$URL/admin/".$_GET['k']."_dashboard");
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
                <h5><b>Tambah <?php echo $_GET['k']; ?></b></h5>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="input-field col s12">
                            <input placeholder="Judul" id="judul" name="judul" type="text" class="validate">
                            <label for="judul">Judul</label>
                        </div>
                        <input name="kategori" type="hidden" value=" <?php echo $_GET['k']; ?>">
                        <div class="col s12">
                            <div class="file-field input-field">
                                <p>Tambahkan Gambar  (Hanya gambar berformat JPG max 5MB)</p>
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file" name="foto">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="input-field col s12 ">
                            <textarea id="artikel" class="materialize-textarea" name="artikel"></textarea>
                            <label for="artikel">Tulis <?php echo $_GET['k']; ?></label>
                        </div>
                        
                    </div>
                    <input type="submit" class="btn" value="simpan">
                </form>
            </div>
        </div>
    <!-- ========================================================================= -->


    <!--=========================== Modal edit artikel ==============================-->
        <!-- Modal Structure -->
        <div id="modEditArtikel" class="modal">
          <div class="modal-content" id="editContent">
            <div class="progress">
                <div class="indeterminate"></div>
            </div>
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
	  
	
	
	  <!--isi-->
	  <div class="col s12 l8 push-l3 isi">
      <h4><b>List  <?php echo $_GET['k']; ?></b><a href="#modAddArtikel" class="modal-trigger btn-floating blue right"><i class="material-icons">add</i></a></h4>
      <table class="centered striped highlight">
        <thead>
          <tr>
              <th>Judul  <?php echo $_GET['k']; ?></th>
              <th></th>
              <th></th>
              <th></th>
          </tr>
        </thead>

        <tbody>
          <?php
            $where= array(
              "kategori" => $_GET['k']
            );
            $dataArtikel=showArtikel($connect,$where);
            for($a=0;$a<sizeof($dataArtikel);$a++){
          ?>
          <tr>
            <td><?php echo $dataArtikel[$a]['judul']; ?></td>
            <td><a href="<?php echo $URL."/detail_artikel?k=artikel&i=".$dataArtikel[$a]['id']; ?>" class="material-icons">visibility</a></td>
            <td><a href="#modEditArtikel" class="modal-trigger material-icons" onclick="setEdit(<?php echo $dataArtikel[$a]['id']; ?>)">edit</a></td>
            <td><a href="#modDelArtikel" class="modal-trigger material-icons"  onclick="setDelete(<?php echo $dataArtikel[$a]['id']; ?>)">delete</a></td>
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
        var kategori = "<?php echo $_GET['k']; ?>";
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

        function setEdit(x){
          $("#editContent").load("<?php echo $URL; ?>/superadmin/modContent.php?edit="+x+"&editKategori="+kategori);
        }

        function setDelete(x){
          $("#delContent").load("<?php echo $URL; ?>/superadmin/modContent.php?del="+x);
        }
	</script>
    </body>
  </html>
        