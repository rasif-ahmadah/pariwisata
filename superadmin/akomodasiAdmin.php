<?php
  include '../connect.php';
print_r($_POST);
  if(!isset($_SESSION['nama'])&&!isset($_SESSION['email'])&&!isset($_SESSION['idUser'])){
    header("location:$URL/masuk");
  }

  if( 
    isset($_POST['judul']) && isset($_POST['koordinat']) 
    && isset($_POST['id_wisata']) && isset($_POST['bintang'])&& 
    isset($_POST['pengunjung']) && isset($_POST['artikel'])&&
    isset($_POST['harga'])&&
    isset($_POST['sosmed'])&&isset($_POST['JrKec'])&&
    isset($_POST['JrProv'])&&isset($_POST['JrKab'])
    ){
      echo "masuk";
        $judul = htmlentities(strip_tags(trim($_POST['judul'])));
        $koordinat = htmlentities(strip_tags(trim($_POST['koordinat'])));
        $pengunjung = htmlentities(strip_tags(trim($_POST['pengunjung'])));
        $artikel = htmlentities(strip_tags(trim($_POST['artikel'])));
        // $alamat = htmlentities(strip_tags(trim($_POST['alamat'])));
        $bintang = htmlentities(strip_tags(trim($_POST['bintang'])));
        $harga = htmlentities(strip_tags(trim($_POST['harga'])));
        $idAkomodasi = htmlentities(strip_tags(trim($_POST['id_wisata'])));
        $sosmed = htmlentities(strip_tags(trim($_POST['sosmed'])));
        $JrProv = htmlentities(strip_tags(trim($_POST['JrProv'])));
        $JrKab = htmlentities(strip_tags(trim($_POST['JrKab'])));
        $JrKec = htmlentities(strip_tags(trim($_POST['JrKec'])));
        $file_dir="";
        if($_FILES["foto"]['error'] == 0){
          $nAkomodasi=$idAkomodasi;
          $foto=explode('.',$_FILES["foto"]["name"]);
          $ext= count($foto)-1;
          $target_dir = "../images/akomodasi/";
          $nama_file="akomodasi_$nAkomodasi.".$foto[$ext];
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
                  "id" => $idAkomodasi
                );
                $myvalue= array(
                  "foto"=>$file_dir
                );
                if(updateAkomodasi($connect,$where,$myvalue))
                  $message = "File berhasil ditambahkan";

              } else {
                  $message = "Sorry, there was an error uploading your file.";
              }
          }
                
        }
        
        $fasilitas=array();
        if(isset($_POST['F1'])){
          $fasilitas['F1']= htmlentities(strip_tags(trim($_POST['F1'])));
        }
        if(isset($_POST['F2'])){
          $fasilitas['F2']= htmlentities(strip_tags(trim($_POST['F2'])));
        }
        if(isset($_POST['F3'])){
          $fasilitas['F3']= htmlentities(strip_tags(trim($_POST['F3'])));
        }
        if(isset($_POST['F4'])){
          $fasilitas['F4']= htmlentities(strip_tags(trim($_POST['F4'])));
        }
        if(isset($_POST['F5'])){
          $fasilitas['F5']= htmlentities(strip_tags(trim($_POST['F5'])));
        }
        if(isset($_POST['F6'])){
          $fasilitas['F6']= htmlentities(strip_tags(trim($_POST['F6'])));
        }
        if(isset($_POST['F7'])){
          $fasilitas['F7']= htmlentities(strip_tags(trim($_POST['F7'])));
        }
        if(isset($_POST['F8'])){
          $fasilitas['F8']= htmlentities(strip_tags(trim($_POST['F8'])));
        }
        if(isset($_POST['F9'])){
          $fasilitas['F9']= htmlentities(strip_tags(trim($_POST['F9'])));
        }
        if(isset($_POST['F10'])){
          $fasilitas['F10']= htmlentities(strip_tags(trim($_POST['F10'])));
        }
        if(isset($_POST['F11'])){
          $fasilitas['F11']= htmlentities(strip_tags(trim($_POST['F11'])));
        }
        


        $JarakDestinasi = array(
          "Jarak Provinsi" => $JrProv,
          "Jarak Kabupaten" => $JrKab,
          "Jarak Kecamatan" => $JrKec,
        );
        $message="Data gagal diubah";
        // $file_dir=explode("../",$target_file);
        $myvalue = array(
          "judul"=>$judul,
          // "alamat" => $alamat,
          "pengunjung" => $pengunjung,
          "koordinat" => $koordinat,
          "bintang" => $bintang,
          "isi" => $artikel,
          "harga" => $harga,
          "jarak destinasi" => json_encode($JarakDestinasi),
          "fasilitas pendukung"=> json_encode($fasilitas), 
          "sosial media"=>$sosmed
        );
        $where = array(
          "id"=>$idAkomodasi
        );
        if(updateAkomodasi($connect,$where,$myvalue)){
          $message="Data berhasil diubah";
        }
        
        $_SESSION['pesan']=$message;
        // print_r($myvalue);
        // echo"masuk";
        echo "<script>window.location.href='$actual_link';</script>";
        // echo "masuk";
  }
  else if( 
    isset($_POST['judul']) && isset($_POST['koordinat']) && 
    isset($_POST['pengunjung']) && isset($_POST['artikel'])&& 
    isset($_POST['harga'])&&
    isset($_POST['sosmed'])&&isset($_POST['JrKec'])&&
    isset($_POST['JrProv'])&&isset($_POST['JrKab'])&&isset($_POST['bintang'])
    ){
        $judul = htmlentities(strip_tags(trim($_POST['judul'])));
        $koordinat = htmlentities(strip_tags(trim($_POST['koordinat'])));
        $pengunjung = htmlentities(strip_tags(trim($_POST['pengunjung'])));
        $artikel = htmlentities(strip_tags(trim($_POST['artikel'])));
        // $alamat = htmlentities(strip_tags(trim($_POST['alamat'])));
        $bintang = htmlentities(strip_tags(trim($_POST['bintang'])));
        $harga = htmlentities(strip_tags(trim($_POST['harga'])));
        $sosmed = htmlentities(strip_tags(trim($_POST['sosmed'])));
        $JrProv = htmlentities(strip_tags(trim($_POST['JrProv'])));
        $JrKab = htmlentities(strip_tags(trim($_POST['JrKab'])));
        $JrKec = htmlentities(strip_tags(trim($_POST['JrKec'])));
        $file_dir="";
        $fasilitas=array();

        if(isset($_POST['F1'])){
          $fasilitas['F1']= htmlentities(strip_tags(trim($_POST['F1'])));
        }
        if(isset($_POST['F2'])){
          $fasilitas['F2']= htmlentities(strip_tags(trim($_POST['F2'])));
        }
        if(isset($_POST['F3'])){
          $fasilitas['F3']= htmlentities(strip_tags(trim($_POST['F3'])));
        }
        if(isset($_POST['F4'])){
          $fasilitas['F4']= htmlentities(strip_tags(trim($_POST['F4'])));
        }
        if(isset($_POST['F5'])){
          $fasilitas['F5']= htmlentities(strip_tags(trim($_POST['F5'])));
        }
        if(isset($_POST['F6'])){
          $fasilitas['F6']= htmlentities(strip_tags(trim($_POST['F6'])));
        }
        if(isset($_POST['F7'])){
          $fasilitas['F7']= htmlentities(strip_tags(trim($_POST['F7'])));
        }
        if(isset($_POST['F8'])){
          $fasilitas['F8']= htmlentities(strip_tags(trim($_POST['F8'])));
        }
        if(isset($_POST['F9'])){
          $fasilitas['F9']= htmlentities(strip_tags(trim($_POST['F9'])));
        }
        if(isset($_POST['F10'])){
          $fasilitas['F10']= htmlentities(strip_tags(trim($_POST['F10'])));
        }
        if(isset($_POST['F11'])){
          $fasilitas['F11']= htmlentities(strip_tags(trim($_POST['F11'])));
        }
        
        $JarakDestinasi = array(
          "Jarak Provinsi" => $JrProv,
          "Jarak Kabupaten" => $JrKab,
          "Jarak Kecamatan" => $JrKec,
        );

        $message="Data gagal ditambahkan";
        // $file_dir=explode("../",$target_file);
        $myvalue = array(
          "judul"=>$judul,
          "pengunjung" => $pengunjung,
          "koordinat" => $koordinat,
          "isi" => $artikel,
          // "alamat" => $alamat,
          "bintang" => $bintang,
          "harga" => $harga,
          "jarak destinasi" => json_encode($JarakDestinasi),
          "fasilitas pendukung"=> json_encode($fasilitas),
          "sosial media"=>$sosmed
          
        );
        
        if(addToAkomodasi($connect,$myvalue)){
          $message="Data berhasil ditambahkan";
        }

        $dataAkomodasi=showAkomodasi($connect,$myvalue);
        $idAkomodasi=$dataAkomodasi[0]['id'];

        if($_FILES["foto"]['error'] == 0){
          $nAkomodasi=$idAkomodasi;
          $foto=explode('.',$_FILES["foto"]["name"]);
          $ext= count($foto)-1;
          $target_dir = "../images/akomodasi/";
          $nama_file="akomodasi_$nAkomodasi.".$foto[$ext];
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
          if ($_FILES['foto']["size"] > 500000) {
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
                  "id" => $idAkomodasi
                );
                $myvalue= array(
                  "foto"=>$file_dir
                );
                if(updateAkomodasi($connect,$where,$myvalue))
                  $message = "File berhasil ditambahkan";


              } else {
                  $message = "Sorry, there was an error uploading your file.";
              }
          }
                
        }
        
        
        
        $_SESSION['pesan']=$message;
        // print_r($myvalue);
        // echo"masuk";
        echo "<script>window.location.href='$actual_link';</script>";
        // echo "masuk";
  }
  
  else if( isset($_POST['deleteAkomodasi'])){
    $message="Data gagal dihapus";
    if(deleteAkomodasi($connect,"id",$_POST['deleteAkomodasi'])){
      $message="Data berhasil dihapus";
    }
    
    $_SESSION['pesan']=$message;
    // print_r($myvalue);
    // echo"masuk";
    echo "<script>window.location.href='$actual_link';</script>";
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
                <h5><b>Tambah Akomodasi</b></h5>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <b>Judul</b>
                            <input placeholder="Judul" id="judul" name="judul" type="text" class="validate">
                            
                        </div>
                        
                        <div class="input-field col m6 s12">
                            <b >Koordinat</b>
                            <input placeholder="Latitude, Longitude" id="koordinat" name="koordinat" type="text" class="validate">
                            
                        </div>
                        <div class="input-field col s12">
                            <b>Jumlah Pengunjung</b>
                            <input placeholder="Thn : Jml_Nusantara, Jml_Mancanegara; Thn : Jml_Nusantara2, Jml_Mancanegara2 " id="pengunjung" name="pengunjung" type="text" class="validate">
                            
                        </div>
                        <!-- <div class="input-field col s12">
                            <b>Alamat</b>
                            <input placeholder="Alamat Lengkap" id="alamat" name="alamat" type="text" class="validate">
                            
                        </div> -->
                        
                        
                        <div class="col s12 m6 input-field">
                            <p><b>Harga Mulai</b></p>
                            <input placeholder="Rp. " name="harga" type="text" class="validate">
                        </div>
                        <div class="col s12 m6 input-field">
                            <p><b>Bintang</b></p>
                            <input placeholder="Number " name="bintang" type="number" class="validate">
                        </div>

                        <div class="input-field col s12 ">
                            <p><b>Tulis Artikel</b></p>
                            <textarea id="artikel" class="materialize-textarea" name="artikel"></textarea>
                            
                        </div>

                        <div class="row">
                            <div class="col s12"><b>Jarak Destinasi Akomodasi</b></div>
                            <div class="input-field col m6 s12">
                                <b>Dari Ibu Kota Provinsi (Surabaya)</b>
                                <input placeholder="………….km/sekitar…………jam……….menit" name="JrProv" type="text" class="validate">
                            </div>
                            <div class="input-field col m6 s12">
                                <b>Dari Ibu Kota Kabupaten (Kanigoro)</b>
                                <input placeholder="………….km/sekitar…………jam……….menit" name="JrKab" type="text" class="validate">
                            </div>
                            <div class="input-field col m6 s12">
                                <b>Dari Kecamatan</b>
                                <input placeholder="………….km/sekitar…………jam……….menit" name="JrKec" type="text" class="validate">
                            </div>
                            <div class="input-field col m6 s12">
                              <b>Sosial Media</b>
                              <textarea class="materialize-textarea" name="sosmed">Facebook : http://www.facebook.com/your_name, Instagram : http://www.Instagram.com/your_name, Youtube : http://www.youtube.com/your_name, Twitter : http://www.Twitter.com/your_name, Pinterest : http://www.pinterest.com/your_name, Skype : http://www.skype.com/your_name, Yahoo : your_email, Google : your_email, Telephone : +62 your_number</textarea>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col s12"><b>Fasilitas Pendukung</b></div>
                          
                          <div class="input-field col m6 s12">
                            <label>
                              <input type="checkbox" class="filled-in" name="F1"/>
                              <span><b>Warung makan/restoran</b></span>
                            </label>
                          </div>
                          <div class="input-field col m6 s12">
                            <label>
                              <input type="checkbox" class="filled-in" name="F2"/>
                              <span><b>Toko Cenderamata</b></span>
                            </label>
                          </div>
                          <div class="input-field col m6 s12">
                            <label>
                              <input type="checkbox" class="filled-in" name="F3"/>
                              <span><b>Balai Pertemuan</b></span>
                            </label>
                          </div>
                          <div class="input-field col m6 s12">
                            <label>
                              <input type="checkbox" class="filled-in" name="F4"/>
                              <span><b>Peta dan Tanda Informasi</b></span>
                            </label>
                          </div>
                          <div class="input-field col m6 s12">
                            <label>
                              <input type="checkbox" class="filled-in" name="F5"/>
                              <span><b>Pusat Informasi Pariwisata</b></span>
                            </label>
                          </div>
                          <div class="input-field col m6 s12">
                            <label>
                              <input type="checkbox" class="filled-in" name="F6"/>
                              <span><b>Toilet Umum</b></span>
                            </label>
                          </div>
                          <div class="input-field col m6 s12">
                            <label>
                              <input type="checkbox" class="filled-in" name="F7"/>
                              <span><b>Area Parkir</b></span>
                            </label>
                          </div>
                          <div class="input-field col m6 s12">
                            <label>
                              <input type="checkbox" class="filled-in" name="F8"/>
                              <span><b>Tempat Sampah</b></span>
                            </label>
                          </div>
                          <div class="input-field col m6 s12">
                            <label>
                              <input type="checkbox" class="filled-in" name="F9"/>
                              <span><b>Jaringan Telekomunikasi</b></span>
                            </label>
                          </div>
                          <div class="input-field col m6 s12">
                            <label>
                              <input type="checkbox" class="filled-in" name="F10"/>
                              <span><b>Jaringan Listrik</b></span>
                            </label>
                          </div>
                          
                        </div>
                        <div class="col s12">
                            <div class="file-field input-field">
                                <p><b>Tambahkan Gambar  (Hanya gambar berformat JPG max 5MB)</b></p>
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file" name="foto">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
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
            <h5><b>Apakah anda yakin ingin menghapus artikel ini ?</b></h5>
            <form action="" method="POST">
                <input type="hidden" value="" name="deleteAkomodasi" id="idModAkomodasi">
                <input type="submit" class="btn red" value="Hapus">
                <div class="btn blue modal-close">Batalkan</div>
            </form>
          </div>
        </div>
    <!-- ========================================================================= -->
	  
	
	
	  <!--isi-->
	  <div class="col s12 l8 push-l3 isi">
      <h4><b>List Destinasi Akomodasi</b><a href="#modAddArtikel" class="modal-trigger btn-floating blue right"><i class="material-icons">add</i></a></h4>
      <table class=" striped highlight">
        <thead>
          <tr>
              <th>Judul Akomodasi</th>
              <th>Koordinat</th>
              <th>Pengunjung Hari Ini</th>
              <th></th>
              <th></th>
              <th></th>
          </tr>
        </thead>

        <tbody>
          <?php
            $dataAkomodasi=showAkomodasi($connect,"all");
            for($a=0;$a<sizeof($dataAkomodasi);$a++){
          ?>
          <tr>
            <td><?php echo $dataAkomodasi[$a]['judul']; ?></td>
            <td><?php echo $dataAkomodasi[$a]['koordinat']; ?></td>
            <td><?php echo $dataAkomodasi[$a]['pengunjung']; ?></td>
            <td><a href="<?php echo $URL."/detail_artikel?k=akomodasi&i=".$dataAkomodasi[$a]['id']; ?>" class="material-icons">visibility</a></td>
            <td><a href="#modEditArtikel" class="modal-trigger material-icons" onclick="setEdit(<?php echo $dataAkomodasi[$a]['id']; ?>)">edit</a></td>
            <td><a href="#modDelArtikel" class="modal-trigger material-icons"  onclick="setDelete(<?php echo $dataAkomodasi[$a]['id']; ?>)">delete</a></td>
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

        function setEdit(x){
          $("#editContent").load("<?php echo $URL; ?>/superadmin/modContent.php?editAkomodasi="+x);
        }

        function setDelete(x){
          document.getElementById("idModAkomodasi").value=x;
        }
  </script>

    </body>
  </html>
        