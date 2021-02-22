<?php
  include 'connect.php';
  // echo "<pre>";
  // print_r($_POST);
  // echo "</pre>";
  if(!isset($_GET['k'])&&!isset($_GET['i'])){
    header("location : $URL");
  }
  else if(isset($_GET['k'])&&isset($_GET['i'])){
    $kategori=$_GET['k'];
    $idArtikel=$_GET['i'];

    $where=array(
      "id"=>$idArtikel
    );
    if($kategori == "wisata"){
      $data=showWisata($connect,$where);
    }
    else if($kategori == "akomodasi"){
      $data=showAkomodasi($connect,$where);
    }
    else if($kategori == "kuliner"){
      $data=showKuliner($connect,$where);
    }
    else if($kategori == "event"){
      $data=showEvent($connect,$where);
    }
        
    else {
        $data=showArtikel($connect,$where);
    }
  }

  if(isset($_POST['pengirim'])&&isset($_POST['komentar'])){
    $nama = htmlentities(strip_tags(trim($_POST['pengirim'])));
    $pesan = htmlentities(strip_tags(trim($_POST['komentar'])));
    // echo "masuk";
    $myvalue = array(
      "receiver"=>0,
      "sender"=>$nama,
      "message"=>$pesan,
      "kategori"=>$_GET['k'],
      "id_destinasi"=>$_GET['i']
    );
    if(addToComment($connect,$myvalue)){
      $message = "Komentar telah di tambahkan";
    }
    else{
      $message = "Komentar gagal di tambahkan, coba ulangi lagi";
    }


    $_SESSION['pesan']=$message;
    echo "<script>window.location.href='$actual_link';</script>";
  }
  else if(isset($_POST['idComment'])&&isset($_POST['pesan'])){
    $idComment = htmlentities(strip_tags(trim($_POST['idComment'])));
    $pesan = htmlentities(strip_tags(trim($_POST['pesan'])));

    $myvalue = array(
      "receiver"=>$idComment,
      "sender"=>"dinas",
      "message"=>$pesan,
      "kategori"=>$_GET['k'],
      "id_destinasi"=>$_GET['i']
    );
    if(addToComment($connect,$myvalue)){
      $message = "Komentar telah di tambahkan";
    }
    else{
      $message = "Komentar gagal di tambahkan, coba ulangi lagi";
    }


    $_SESSION['pesan']=$message;
    echo "<script>window.location.href='$actual_link';</script>";
  }
  else if(isset($_POST['deleteComment'])){
    $idComment = htmlentities(strip_tags(trim($_POST['deleteComment'])));


    if(deleteComment($connect,"id",$idComment)){
      $message = "Komentar telah di hapus";
    }
    else{
      $message = "Komentar gagal di hapus, coba ulangi lagi";
    }


    $_SESSION['pesan']=$message;
    echo "<script>window.location.href='$actual_link';</script>";
  }
?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Amaranth|Caveat|Jaldi&display=swap" rel="stylesheet">
      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <link rel="stylesheet" href="css/detailArtikel.css">

      <meta name="description" content="Disnaker Madiun" />
      <meta name="keywords" content="Disnaker, Madiun, Lowongan Pekerjaan, Tenaga Kerja KOta Madiun, Kota Madiun" />
      <meta name="author" content="Dandi Wibowo" />

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="icon" href="images/logo.png" type="image/x-icon" />
      <title>Sasmita Blitar</title>
    </head>

    <body class="bg_full">

        <!-- Modal Grafik -->
        <div id="showGrafik" class="modal">
          <div class="modal-content">
            
            <div id="curve_chart" style="width: 100%; height: 100%;"></div>
            <div id="curve_chart_2" style="width: 100%; height: 100%; margin-top:20px;"></div>
          </div>
          
        </div>

        <!-- Modal add Comment -->
        <div id="addComment" class="modal">
          <div class="modal-content">
            <h5> Tulis Komentar</h5>  

            <form action="<?php echo $actual_link;?>" method="post">
              <div class="input-field col s12 m6">
                <input name="pengirim" id="pengirim" type="text" class="validate" required>
                <label for="pengirim">Nama : </label>
              </div>
              <div class="input-field col s12">
                <textarea id="komentar" name="komentar" class="materialize-textarea" required></textarea>
                <label for="komentar">Pesan : </label>
              </div>
              <input type="submit" class="btn" value="kirim">
            </form>

          </div>
          
        </div>

        <!-- Modal Reply Comment -->
        <div id="replyComment" class="modal">
          <div class="modal-content">
            <h5> Balas Komentar</h5>  

            <form action="<?php echo $actual_link;?>" method="post">
              
              <div class="input-field col s12">
                <textarea id="pesan" name="pesan" class="materialize-textarea"></textarea>
                <label for="pesan">Pesan : </label>
              </div>
              <input type="hidden" name="idComment" class="idComment" value="">
              <input type="submit" class="btn" value="kirim">
            </form>

          </div>
        </div>

        <!-- Modals Delete Comment -->
        <div id="delComment" class="modal">
          <div class="modal-content" id="delContent">
            <h5><b>Apakah anda yakin ingin menghapus artikel ini ?</b></h5>
            <form action="<?php echo $actual_link;?>" method="POST">
                <input type="hidden" value="" name="deleteComment" class="idComment">
                <input type="submit" class="btn red" value="Hapus">
                <div class="btn blue modal-close">Batalkan</div>
            </form>
          </div>
        </div>

        <!-- Modal Show Comment -->
        <div id="comment" class="modal bottom-sheet">
          <div class="modal-content col s12 m8 push-m2">
            <div class="row">
              <h5 class="left">Tulis Komentar</h5>
              <a class="modal-trigger btn-floating blue right" href="#addComment"><i class="material-icons">add</i></a>
            </div>

            <ul class="collection">
              <?php
                $where=array(
                  "kategori"=>$_GET['k'],
                  "id_destinasi"=>$_GET['i'],
                );
                $dataComment= showComment($connect,$where);

                $dataReal=filterData($dataComment,array("receiver"),array("0"));
                $dataBalas=filterData($dataComment,array("sender"),array("dinas"));

                for($a=0;$a<sizeof($dataReal);$a++){

              ?>
              <li class="collection-item avatar">
                <i class="material-icons circle green">face</i>
                <span class="title"><?php echo $dataReal[$a]['sender']; ?></span>
                <p><?php echo $dataReal[$a]['message']; ?></p>
                
                  <?php
                    $balasanComment=filterData($dataBalas,array("receiver"),array($dataReal[$a]['id']));
                    for($b=(sizeof($balasanComment)-1);$b>=0;$b--){
                  ?>
                    <p><i class="material-icons left">subdirectory_arrow_right</i><?php echo $balasanComment[$b]['message']; ?></p>
                  <?php
                    }
                  ?>
                <div  class="secondary-content">
                  <?php
                    if(isset($_SESSION['nama'])&&isset($_SESSION['email'])&&isset($_SESSION['idUser'])){
                  ?>
                  <a href="#replyComment" class="modal-trigger " onclick="setMyValue(<?php echo $dataReal[$a]['id']; ?>)"><i class="material-icons blue-text">send</i></a><br>
                  <a href="#delComment" class="modal-trigger " onclick="setMyValue(<?php echo $dataReal[$a]['id']; ?>)"><i class="material-icons red-text">delete</i></a>
                  <?php
                    }
                  ?>
                
                </div>
              </li>

              <?php
                }
              ?>
            </ul>
            
          </div>
        </div>
        
        

       
        <div class="row sec1">
            <div class="col s12 m10 push-m1 pageCV">
              <?php 
                if($kategori=="wisata"){
                  ?>
                    <div class="row">
                      <!-- <div class="col s12">
                        <ul class="tabs">
                          <li class="tab col s3"><a class="active"  href="#deskripsi">Deskripsi</a></li>
                          <li class="tab col s3"><a href="#detail">Detail Informasi</a></li>
                        </ul>
                      </div> -->
                      <!-- <div id="deskripsi" class="col s12"> -->

                        <div class="sub1 center" >
                            <img src="<?php echo $data[0]['foto']; ?>" id="artikelFoto">
                        </div>
                        
                        <div class="sub2 " style="padding: 60px 30px 90px 30px !important;">
                            <h4 style="border-bottom: solid 2px silver; font-family: 'Amaranth', sans-serif;"><?php echo $data[0]['judul']; ?></h4>
                            <!-- <p>Alamat : <?php echo $data[0]['alamat']; ?> </p> -->
                            <pre class="col s12">
                              <?php echo $data[0]['isi']; ?>
                            </pre>
                            <p>Tanggal terbit : <?php echo $data[0]['tanggal']; ?> </p>
                        </div>

                      <!-- </div> -->
                      <!-- <div id="detail" class="col s12"> -->
                        
                        <div class="row" style="padding: 20px;">
                          <div class="col m6 s12">
                          <?php 
                              $dataTiket = json_decode($data[0]['tiket'],true); 
                            
                          ?>
                            <p><b>Harga Tiket Per Orang</b></p>
                            <table class="striped">
                              <thead>
                                <tr>
                                    <th>Jenis Wisatawan</th>
                                    <th>Weekday</th>
                                    <th>Weekend</th>
                                </tr>
                              </thead>

                              <tbody>
                                <tr>
                                  <td>Wisatawan Nusantara</td>
                                  <td><?php echo $dataTiket['Nusantara Weekday']; ?></td>
                                  <td><?php echo $dataTiket['Nusantara Weekend']; ?></td>
                                </tr>
                                <tr>
                                  <td>Wisatawan Mancanegara</td>
                                  <td><?php echo $dataTiket['Mancanegara Weekday']; ?></td>
                                  <td><?php echo $dataTiket['Mancanegara Weekend']; ?></td>
                                </tr>
                                
                              </tbody>
                            </table>
                          </div>

                          <div class="col m6 s12">
                            <p><b>Rata - Rata Kunjungan/Hari</b></p>
                            <?php 
                                $rPengunjung = json_decode($data[0]['rata rata kunjungan'],true); 
                            ?>
                            <table class="striped">
                              <thead>
                                <tr>
                                    <th>Jenis Wisatawan</th>
                                    <th>Weekday</th>
                                    <th>Weekend</th>
                                </tr>
                              </thead>

                              <tbody>
                                <tr>
                                  <td>Wisatawan Nusantara</td>
                                  <td><?php echo $rPengunjung['Nusantara Weekday']; ?></td>
                                  <td><?php echo $rPengunjung['Nusantara Weekend']; ?></td>
                                </tr>
                                <tr>
                                  <td>Wisatawan Mancanegara</td>
                                  <td><?php echo $rPengunjung['Mancanegara Weekday']; ?></td>
                                  <td><?php echo $rPengunjung['Mancanegara Weekend']; ?></td>
                                </tr>
                                
                              </tbody>
                            </table>
                          </div>
                        </div>

                        <div class="row" style="padding: 20px; margin-top :50px !important;">
                          <div class="col m6 s12">
                            <p><b>Jarak Destinasi</b></p>
                            <?php 
                                $jDestinasi = json_decode($data[0]['jarak destinasi'],true); 
                            ?>
                            <table class="striped">
                              <thead>
                                <tr>
                                    <th>Jarak Dari</th>
                                    <th>Jarak / Jam</th>
                                    
                                </tr>
                              </thead>

                              <tbody>
                                <tr>
                                  <td>Ibukota Provinsi (Surabaya)</td>
                                  <td><?php echo $jDestinasi['Jarak Provinsi']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Ibukota Kabupaten (Kanigoro)</td>
                                  <td><?php echo $jDestinasi['Jarak Kabupaten']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Kecamatan</td>
                                  <td><?php echo $jDestinasi['Jarak Kecamatan']; ?></td>
                                  
                                </tr>
                                
                              </tbody>
                            </table>
                          </div>

                          <div class="col m6 s12">
                            <p><b>Jumlah Kunjungan (Orang)</b> <a class="modal-trigger" href="#showGrafik"><i class="right material-icons white-text ">bar_chart</i></a></p>
                            <?php 
                                $dPengunjung = explode(";",$data[0]['pengunjung']); 
                            ?>
                            <table class="striped">
                              <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Wisatawan Nusantara</th>
                                    <th>Wisatawan Mancanegara</th>
                                    
                                </tr>
                              </thead>

                              <tbody>
                                <?php
                                  
                                    for($a=0;$a<sizeof($dPengunjung);$a++){
                                      if(preg_match("/:/",$dPengunjung[$a])){
                                        $dPertahun=explode(":",$dPengunjung[$a]);
                                        $dWisatawan=explode(",",$dPertahun[1]);
                                        echo "
                                          <tr>
                                            <td>".$dPertahun[0]."</td>
                                            <td>".$dWisatawan[0]."</td>
                                            <td>".$dWisatawan[1]."</td>
                                            
                                          </tr>
                                        ";
                                      }
                                    }
                                  
                                ?>
                                
                              </tbody>
                            </table>
                          </div>
                        </div>

                        <div class="row" style="padding: 20px; margin-top:50px !important;">

                          <div class="col m6 s12">
                            <p><b>Jam Operasional Wisata </b></p>
                            <?php 
                                $jOperasional = json_decode($data[0]['jam operasional'],true); 
                            ?>
                            <table class="striped">
                              <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    
                                </tr>
                              </thead>

                              <tbody>
                                <tr>
                                  <td>Senin</td>
                                  <td><?php echo $jOperasional['Senin']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Selasa</td>
                                  <td><?php echo $jOperasional['Selasa']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Rabu</td>
                                  <td><?php echo $jOperasional['Rabu']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Kamis</td>
                                  <td><?php echo $jOperasional['Kamis']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Jum'at</td>
                                  <td><?php echo $jOperasional['Jumat']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Sabtu</td>
                                  <td><?php echo $jOperasional['Sabtu']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Minggu</td>
                                  <td><?php echo $jOperasional['Minggu']; ?></td>
                                  
                                </tr>
                                
                              </tbody>
                            </table>
                          </div>

                          <div class="col s12 m6">
                            <div class="row col s12">
                              <?php 
                                  $fPendukung = json_decode($data[0]['fasilitas pendukung'],true); 
                              ?>
                              <div class="col s12"><p><b>Fasilitas Pendukung</b></p></div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F1" <?php echo (array_key_exists("F1",$fPendukung)&&$fPendukung['F1']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Penginapan/Homestay</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F2" <?php echo (array_key_exists("F2",$fPendukung)&&$fPendukung['F2']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Warung makan/restoran</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F3" <?php echo (array_key_exists("F3",$fPendukung)&&$fPendukung['F3']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Toko Cenderamata</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F4" <?php echo (array_key_exists("F4",$fPendukung)&&$fPendukung['F4']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Balai Pertemuan</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F5" <?php echo (array_key_exists("F5",$fPendukung)&&$fPendukung['F5']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Peta dan Tanda Informasi</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F6" <?php echo (array_key_exists("F6",$fPendukung)&&$fPendukung['F6']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Pusat Informasi Pariwisata</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F7" <?php echo (array_key_exists("F7",$fPendukung)&&$fPendukung['F7']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Toilet Umum</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F8" <?php echo (array_key_exists("F8",$fPendukung)&&$fPendukung['F8']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Area Parkir</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F9" <?php echo (array_key_exists("F9",$fPendukung)&&$fPendukung['F9']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Tempat Sampah</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F10" <?php echo (array_key_exists("F10",$fPendukung)&&$fPendukung['F10']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Jaringan Telekomunikasi</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F11" <?php echo (array_key_exists("F11",$fPendukung)&&$fPendukung['F11']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Jaringan Listrik</b></span>
                              </label>
                              </div>
                              
                            </div>
                          </div>

                        </div>
                        <div class="row " style="padding: 20px !important; margin-top:50px !important; text-align:center;">
                          <h5><b>Check It on Our Social Media</b></h5>
                          <div class="row">
                          <?php 
                            $dSosmed = explode(',',$data[0]['sosial media']); 
                            for($a=0;$a<sizeof($dSosmed);$a++){
                              $dPerakun=explode(" : ",$dSosmed[$a]);
                              if(strtolower(trim($dPerakun[1]))!="-"){
                                if(strtolower(trim($dPerakun[0]))=='telephone'){
                                  ?>
                                  <a href="#" onclick="callNumber('<?php echo trim($dPerakun[1]); ?>')" class="fa fa-phone"></a>
                                  <?php
                                }
                                else
                                  echo "<a href='".trim($dPerakun[1])."' class='fa fa-".trim(strtolower($dPerakun[0]))."'></a>";
                              }
                              
                            }
                          ?>
                            <a href=" https://www.google.com/maps/search/?api=1&query=<?php echo $data[0]['koordinat']; ?>" target="_blank" style="margin-top:-15px !important;" class='btn-floating btn-large waves-effect red'><i class="material-icons" style="font-size: 30px;">place</i></a>
                            <!-- <a href=" https://www.google.com/maps/search/?api=1&query=<?php echo $data[0]['koordinat']; ?>" target="_blank"><img src="images/gmap.png" style="width:50px; position:relative; margin:20px 10px 0px 10px !important;"></a> -->
                          </div>
                        </div>
                        <!-- <a class="btn blue col s12" href=" https://www.google.com/maps/search/?api=1&query=<?php echo $data[0]['koordinat']; ?>" target="_blank">Buka di GMap</a> -->

                      <!-- </div> -->
                      
                    </div>
                  <?php
                }
                else if($kategori=="kuliner"){
                  ?>
                    <div class="row">
                      
                        <div class="sub1 center" >
                            <img src="<?php echo $data[0]['foto']; ?>" id="artikelFoto">
                        </div>
                        
                        <div class="sub2 " style="padding: 60px 30px 90px 30px !important;">
                            <h4 style="border-bottom: solid 2px silver; font-family: 'Amaranth', sans-serif;"><?php echo $data[0]['judul']; ?></h4>
                            <!-- <p>Alamat : <?php echo $data[0]['alamat']; ?> </p> -->
                            <pre class="col s12">
                              <?php echo $data[0]['isi']; ?>
                            </pre>
                            <p>Tanggal terbit : <?php echo $data[0]['tanggal']; ?> </p>
                        </div>

                      
                        
                        <div class="row" style="padding: 20px;">
                          <div class="col m6 s12">
                          
                            <p><b>Harga Minimal :</b> <?php echo $data[0]['harga']; ?></p>
                            
                          </div>

                          <div class="col m6 s12">
                            <p><b>Rata - Rata Kunjungan/Hari</b></p>
                            <?php 
                                $rPengunjung = json_decode($data[0]['rata rata kunjungan'],true); 
                            ?>
                            <table class="striped">
                              <thead>
                                <tr>
                                    <th>Jenis Wisatawan</th>
                                    <th>Weekday</th>
                                    <th>Weekend</th>
                                </tr>
                              </thead>

                              <tbody>
                                <tr>
                                  <td>Wisatawan Nusantara</td>
                                  <td><?php echo $rPengunjung['Nusantara Weekday']; ?></td>
                                  <td><?php echo $rPengunjung['Nusantara Weekend']; ?></td>
                                </tr>
                                <tr>
                                  <td>Wisatawan Mancanegara</td>
                                  <td><?php echo $rPengunjung['Mancanegara Weekday']; ?></td>
                                  <td><?php echo $rPengunjung['Mancanegara Weekend']; ?></td>
                                </tr>
                                
                              </tbody>
                            </table>
                          </div>
                        </div>

                        <div class="row" style="padding: 20px; margin-top :50px !important;">
                          <div class="col m6 s12">
                            <p><b>Jarak Destinasi</b></p>
                            <?php 
                                $jDestinasi = json_decode($data[0]['jarak destinasi'],true); 
                            ?>
                            <table class="striped">
                              <thead>
                                <tr>
                                    <th>Jarak Dari</th>
                                    <th>Jarak / Jam</th>
                                    
                                </tr>
                              </thead>

                              <tbody>
                                <tr>
                                  <td>Ibukota Provinsi (Surabaya)</td>
                                  <td><?php echo $jDestinasi['Jarak Provinsi']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Ibukota Kabupaten (Kanigoro)</td>
                                  <td><?php echo $jDestinasi['Jarak Kabupaten']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Kecamatan</td>
                                  <td><?php echo $jDestinasi['Jarak Kecamatan']; ?></td>
                                  
                                </tr>
                                
                              </tbody>
                            </table>
                          </div>

                          <div class="col m6 s12">
                            <p><b>Jumlah Kunjungan (Orang)</b> <a class="modal-trigger" href="#showGrafik"><i class="right material-icons white-text ">bar_chart</i></a></p>
                            <?php 
                                $dPengunjung = explode(";",$data[0]['pengunjung']); 
                            ?>
                            <table class="striped">
                              <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Wisatawan Nusantara</th>
                                    <th>Wisatawan Mancanegara</th>
                                    
                                </tr>
                              </thead>

                              <tbody>
                                <?php
                                  
                                    for($a=0;$a<sizeof($dPengunjung);$a++){
                                      if(preg_match("/:/",$dPengunjung[$a])){
                                        $dPertahun=explode(":",$dPengunjung[$a]);
                                        $dWisatawan=explode(",",$dPertahun[1]);
                                        echo "
                                          <tr>
                                            <td>".$dPertahun[0]."</td>
                                            <td>".$dWisatawan[0]."</td>
                                            <td>".$dWisatawan[1]."</td>
                                            
                                          </tr>
                                        ";
                                      }
                                    }
                                  
                                ?>
                                
                              </tbody>
                            </table>
                          </div>
                        </div>

                        <div class="row" style="padding: 20px; margin-top:50px !important;">

                          <div class="col m6 s12">
                            <p><b>Jam Operasional Wisata </b></p>
                            <?php 
                                $jOperasional = json_decode($data[0]['jam operasional'],true); 
                            ?>
                            <table class="striped">
                              <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    
                                </tr>
                              </thead>

                              <tbody>
                                <tr>
                                  <td>Senin</td>
                                  <td><?php echo $jOperasional['Senin']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Selasa</td>
                                  <td><?php echo $jOperasional['Selasa']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Rabu</td>
                                  <td><?php echo $jOperasional['Rabu']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Kamis</td>
                                  <td><?php echo $jOperasional['Kamis']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Jum'at</td>
                                  <td><?php echo $jOperasional['Jumat']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Sabtu</td>
                                  <td><?php echo $jOperasional['Sabtu']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Minggu</td>
                                  <td><?php echo $jOperasional['Minggu']; ?></td>
                                  
                                </tr>
                                
                              </tbody>
                            </table>
                          </div>

                          <div class="col s12 m6">
                            <div class="row col s12">
                              <?php 
                                  $fPendukung = json_decode($data[0]['fasilitas pendukung'],true); 
                              ?>
                              <div class="col s12"><p><b>Fasilitas Pendukung</b></p></div>
                              
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F1" <?php echo (array_key_exists("F1",$fPendukung)&&$fPendukung['F1']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Toko Oleh-Oleh</b></span>
                              </label>
                              </div>
                              
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F2" <?php echo (array_key_exists("F2",$fPendukung)&&$fPendukung['F2']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Balai Pertemuan</b></span>
                              </label>
                              </div>
                              
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F3" <?php echo (array_key_exists("F3",$fPendukung)&&$fPendukung['F3']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Toilet Umum</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F4" <?php echo (array_key_exists("F4",$fPendukung)&&$fPendukung['F4']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Area Parkir</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F5" <?php echo (array_key_exists("F5",$fPendukung)&&$fPendukung['F5']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Tempat Sampah</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F6" <?php echo (array_key_exists("F6",$fPendukung)&&$fPendukung['F6']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Jaringan Telekomunikasi</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F7" <?php echo (array_key_exists("F7",$fPendukung)&&$fPendukung['F7']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Jaringan Listrik</b></span>
                              </label>
                              </div>
                              
                            </div>
                          </div>

                        </div>
                        <div class="row " style="padding: 20px !important; margin-top:50px !important; text-align:center;">
                          <h5><b>Check It on Our Social Media</b></h5>
                          <div class="row">
                          <?php 
                            $dSosmed = explode(',',$data[0]['sosial media']); 
                            for($a=0;$a<sizeof($dSosmed);$a++){
                              $dPerakun=explode(" : ",$dSosmed[$a]);
                              if(strtolower(trim($dPerakun[1]))!="-"){
                                if(strtolower(trim($dPerakun[0]))=='telephone'){
                                  ?>
                                  <a href="#" onclick="callNumber('<?php echo trim($dPerakun[1]); ?>')" class="fa fa-phone"></a>
                                  <?php
                                }
                                else
                                  echo "<a href='".trim($dPerakun[1])."' class='fa fa-".trim(strtolower($dPerakun[0]))."'></a>";
                              }
                              
                            }
                          ?>
                            <a href=" https://www.google.com/maps/search/?api=1&query=<?php echo $data[0]['koordinat']; ?>" target="_blank" style="margin-top:-15px !important;" class='btn-floating btn-large waves-effect red'><i class="material-icons" style="font-size: 30px;">place</i></a>
                            <!-- <a href=" https://www.google.com/maps/search/?api=1&query=<?php echo $data[0]['koordinat']; ?>" target="_blank"><img src="images/gmap.png" style="width:50px; position:relative; margin:20px 10px 0px 10px !important;"></a> -->
                          </div>
                        </div>
                      <!-- </div> -->
                      
                    </div>
                  <?php
                }
                else if($kategori=="akomodasi"){
                  ?>
                    <div class="row">
                      
                        <div class="sub1 center" >
                            <img src="<?php echo $data[0]['foto']; ?>" id="artikelFoto">
                        </div>
                        
                        <div class="sub2 " style="padding: 60px 30px 90px 30px !important;">
                            <h4 style="border-bottom: solid 2px silver; font-family: 'Amaranth', sans-serif;"><?php echo $data[0]['judul']; ?></h4>
                            <!-- <p>Alamat : <?php echo $data[0]['alamat']; ?> </p> -->
                            <pre class="col s12">
                              <?php echo $data[0]['isi']; ?>
                            </pre>
                            <p>Tanggal terbit : <?php echo $data[0]['tanggal']; ?> </p>
                        </div>

                      
                        
                        <div class="row" style="padding: 20px;">
                          <div class="col m6 s12">
                          
                            <p><b>Harga Minimal :</b> <?php echo $data[0]['harga']; ?></p>
                            
                          </div>

                          <div class="col m6 s12">
                            <p><b>Rata - Rata Kunjungan/Hari</b></p>
                            <?php 
                                $rPengunjung = json_decode($data[0]['rata rata kunjungan'],true); 
                            ?>
                            <table class="striped">
                              <thead>
                                <tr>
                                    <th>Jenis Wisatawan</th>
                                    <th>Weekday</th>
                                    <th>Weekend</th>
                                </tr>
                              </thead>

                              <tbody>
                                <tr>
                                  <td>Wisatawan Nusantara</td>
                                  <td><?php echo $rPengunjung['Nusantara Weekday']; ?></td>
                                  <td><?php echo $rPengunjung['Nusantara Weekend']; ?></td>
                                </tr>
                                <tr>
                                  <td>Wisatawan Mancanegara</td>
                                  <td><?php echo $rPengunjung['Mancanegara Weekday']; ?></td>
                                  <td><?php echo $rPengunjung['Mancanegara Weekend']; ?></td>
                                </tr>
                                
                              </tbody>
                            </table>
                          </div>
                        </div>

                        <div class="row" style="padding: 20px; margin-top :50px !important;">
                          <div class="col m6 s12">
                            <p><b>Jarak Destinasi</b></p>
                            <?php 
                                $jDestinasi = json_decode($data[0]['jarak destinasi'],true); 
                            ?>
                            <table class="striped">
                              <thead>
                                <tr>
                                    <th>Jarak Dari</th>
                                    <th>Jarak / Jam</th>
                                    
                                </tr>
                              </thead>

                              <tbody>
                                <tr>
                                  <td>Ibukota Provinsi (Surabaya)</td>
                                  <td><?php echo $jDestinasi['Jarak Provinsi']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Ibukota Kabupaten (Kanigoro)</td>
                                  <td><?php echo $jDestinasi['Jarak Kabupaten']; ?></td>
                                  
                                </tr>
                                <tr>
                                  <td>Kecamatan</td>
                                  <td><?php echo $jDestinasi['Jarak Kecamatan']; ?></td>
                                  
                                </tr>
                                
                              </tbody>
                            </table>
                          </div>

                          <div class="col m6 s12">
                            <p><b>Jumlah Kunjungan (Orang)</b> <a class="modal-trigger" href="#showGrafik"><i class="right material-icons white-text ">bar_chart</i></a></p>
                            <?php 
                                $dPengunjung = explode(";",$data[0]['pengunjung']); 
                            ?>
                            <table class="striped">
                              <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Wisatawan Nusantara</th>
                                    <th>Wisatawan Mancanegara</th>
                                    
                                </tr>
                              </thead>

                              <tbody>
                                <?php
                                  
                                    for($a=0;$a<sizeof($dPengunjung);$a++){
                                      if(preg_match("/:/",$dPengunjung[$a])){
                                        $dPertahun=explode(":",$dPengunjung[$a]);
                                        $dWisatawan=explode(",",$dPertahun[1]);
                                        echo "
                                          <tr>
                                            <td>".$dPertahun[0]."</td>
                                            <td>".$dWisatawan[0]."</td>
                                            <td>".$dWisatawan[1]."</td>
                                            
                                          </tr>
                                        ";
                                      }
                                    }
                                  
                                ?>
                                
                              </tbody>
                            </table>
                          </div>
                        </div>

                        <div class="row" style="padding: 20px; margin-top:50px !important;">

                          <div class="col m6 s12">
                            <p><b>Bintang</b></p>
                            <?php 
                               for($bin=0;$bin<$data[0]['bintang'];$bin++){
                                 echo "<i style='color:yellow;' class='material-icons' >grade</i>";
                               } 
                            ?>
                            
                          </div>

                          <div class="col s12 m6">
                            <div class="row col s12">
                              <?php 
                                  $fPendukung = json_decode($data[0]['fasilitas pendukung'],true); 
                              ?>
                              <div class="col s12"><p><b>Fasilitas Pendukung</b></p></div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F1" <?php echo (array_key_exists("F1",$fPendukung)&&$fPendukung['F1']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Warung makan/restoran</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F2" <?php echo (array_key_exists("F2",$fPendukung)&&$fPendukung['F2']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Toko Cenderamata</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F3" <?php echo (array_key_exists("F3",$fPendukung)&&$fPendukung['F3']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Balai Pertemuan</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F4" <?php echo (array_key_exists("F4",$fPendukung)&&$fPendukung['F4']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Peta dan Tanda Informasi</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F5" <?php echo (array_key_exists("F5",$fPendukung)&&$fPendukung['F5']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Pusat Informasi Pariwisata</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F6" <?php echo (array_key_exists("F6",$fPendukung)&&$fPendukung['F6']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Toilet Umum</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F7" <?php echo (array_key_exists("F7",$fPendukung)&&$fPendukung['F7']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Area Parkir</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F8" <?php echo (array_key_exists("F8",$fPendukung)&&$fPendukung['F8']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Tempat Sampah</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F9" <?php echo (array_key_exists("F9",$fPendukung)&&$fPendukung['F9']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Jaringan Telekomunikasi</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F10" <?php echo (array_key_exists("F10",$fPendukung)&&$fPendukung['F10']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Jaringan Listrik</b></span>
                              </label>
                              </div>
                              
                              
                            </div>
                          </div>

                        </div>
                        <div class="row " style="padding: 20px !important; margin-top:50px !important; text-align:center;">
                          <h5><b>Check It on Our Social Media</b></h5>
                          <div class="row" >
                          <?php 
                            $dSosmed = explode(',',$data[0]['sosial media']); 
                            for($a=0;$a<sizeof($dSosmed);$a++){
                              $dPerakun=explode(" : ",$dSosmed[$a]);
                              if(strtolower(trim($dPerakun[1]))!="-"){
                                if(strtolower(trim($dPerakun[0]))=='telephone'){
                                  ?>
                                  <a href="#" onclick="callNumber('<?php echo trim($dPerakun[1]); ?>')" class="fa fa-phone"></a>
                                  <?php
                                }
                                else
                                  echo "<a href='".trim($dPerakun[1])."' class='fa fa-".trim(strtolower($dPerakun[0]))."'></a>";
                              }
                              
                            }
                          ?>
                            <a href=" https://www.google.com/maps/search/?api=1&query=<?php echo $data[0]['koordinat']; ?>" target="_blank" style="margin-top:-15px !important;" class='btn-floating btn-large waves-effect red'><i class="material-icons" style="font-size: 30px;">place</i></a>
                            <!-- <a href=" https://www.google.com/maps/search/?api=1&query=<?php echo $data[0]['koordinat']; ?>" target="_blank"><img src="images/gmap.png" style="width:50px; position:relative; margin:20px 10px 0px 10px !important;"></a> -->
                          </div>
                        </div>
                      <!-- </div> -->
                      
                    </div>
                  <?php
                }
                else if($kategori=="event"){
                  ?>
                    <div class="row">
                      
                        <div class="sub1 center" >
                            <img src="<?php echo $data[0]['foto']; ?>" id="artikelFoto">
                        </div>
                        
                        <div class="sub2 " style="padding: 60px 30px 20px 30px !important;">
                            <h4 style="border-bottom: solid 2px silver; font-family: 'Amaranth', sans-serif;"><?php echo $data[0]['judul']; ?></h4>
                            <pre class="col s12">
                              <?php echo $data[0]['isi']; ?>
                            </pre>
                            <p>Tanggal terbit : <?php echo $data[0]['tanggal']; ?> </p>
                        </div>

                      
                        
                        <div class="row" style="padding: 20px !important;">
                          
                          <div class="col m6 s12">
                            <p><b>Rata - Rata Kunjungan/Hari</b></p>
                            <?php 
                                $rPengunjung = json_decode($data[0]['rata rata kunjungan'],true); 
                            ?>
                            <table class="striped">
                              <thead>
                                <tr>
                                    <th>Jenis Wisatawan</th>
                                    <th>Weekday</th>
                                    <th>Weekend</th>
                                </tr>
                              </thead>

                              <tbody>
                                <tr>
                                  <td>Wisatawan Nusantara</td>
                                  <td><?php echo $rPengunjung['Nusantara Weekday']; ?></td>
                                  <td><?php echo $rPengunjung['Nusantara Weekend']; ?></td>
                                </tr>
                                <tr>
                                  <td>Wisatawan Mancanegara</td>
                                  <td><?php echo $rPengunjung['Mancanegara Weekday']; ?></td>
                                  <td><?php echo $rPengunjung['Mancanegara Weekend']; ?></td>
                                </tr>
                                
                              </tbody>
                            </table>
                          </div>
                              

                          <div class="col s12 m6">
                            <div class="row col s12">
                              <?php 
                                  $fPendukung = json_decode($data[0]['fasilitas pendukung'],true); 
                              ?>
                              <div class="col s12"><p><b>Fasilitas Pendukung</b></p></div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F1" <?php echo (array_key_exists("F1",$fPendukung)&&$fPendukung['F1']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Penginapan/Homestay</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F2" <?php echo (array_key_exists("F2",$fPendukung)&&$fPendukung['F2']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Warung makan/restoran</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F3" <?php echo (array_key_exists("F3",$fPendukung)&&$fPendukung['F3']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Toko Cenderamata</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F4" <?php echo (array_key_exists("F4",$fPendukung)&&$fPendukung['F4']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Balai Pertemuan</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F5" <?php echo (array_key_exists("F5",$fPendukung)&&$fPendukung['F5']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Peta dan Tanda Informasi</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F6" <?php echo (array_key_exists("F6",$fPendukung)&&$fPendukung['F6']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Pusat Informasi Pariwisata</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F7" <?php echo (array_key_exists("F7",$fPendukung)&&$fPendukung['F7']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Toilet Umum</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F8" <?php echo (array_key_exists("F8",$fPendukung)&&$fPendukung['F8']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Area Parkir</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F9" <?php echo (array_key_exists("F9",$fPendukung)&&$fPendukung['F9']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Tempat Sampah</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F10" <?php echo (array_key_exists("F10",$fPendukung)&&$fPendukung['F10']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Jaringan Telekomunikasi</b></span>
                              </label>
                              </div>
                              <div class="input-field col s12">
                              <label>
                                  <input type="checkbox" class="filled-in" name="F11" <?php echo (array_key_exists("F11",$fPendukung)&&$fPendukung['F11']!="") ? "checked='checked'" : "" ?> disabled/>
                                  <span><b>Jaringan Listrik</b></span>
                              </label>
                              </div>
                              
                            </div>
                          </div>

                        </div>
                        
                        
                      <!-- </div> -->
                      
                    </div>
                  <?php
                }
                else{
                  ?> 
                    <div class="sub1 center" >
                        <img src="<?php echo $data[0]['foto']; ?>" id="artikelFoto">
                    </div>
                    
                    <div class="sub2 " style="padding: 60px 30px 90px 30px !important;">
                        <h4 style="border-bottom: solid 2px silver; font-family: 'Amaranth', sans-serif;"><?php echo $data[0]['judul']; ?></h4>
                        
                        <pre class="col s12">
                          <?php echo $data[0]['isi']; ?>
                        </pre>
                        <p>Tanggal terbit : <?php echo $data[0]['tanggal']; ?> </p>
                    </div>
                  <?php
                }
              ?>
              

              <!-- Rating -->
                <div class="row" id="ratingContent"></div>
              <!-- Tutup Rating -->

              <!-- Comment -->
              <a href="#comment" class="col s12 red btn modal-trigger"> Komentar </a>
              <!-- Tutup Comment -->


             
              
            </div>
        </div>
    
      

      <!-- ================================ Footer ================================== -->

     

      <!-- ========================================================================== -->
      <?php
        include 'footer.php';
      ?>
     <?php
     include 'navtop.php';
     ?>
      <!-- Compiled and minified JavaScript -->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
      <script type="text/javascript">
        // google.charts.load('current', {'packages':['bar']});
        // google.charts.setOnLoadCallback(drawChart);

        $( ".modal-trigger" ).click(function() {
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);
            google.charts.setOnLoadCallback(drawChart2);
        });
        
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Tahun', 'Nusantara'],
            <?php
              for($a=0;$a<sizeof($dPengunjung);$a++){
                if(preg_match("/:/",$dPengunjung[$a])){
                  $dPertahun=explode(":",$dPengunjung[$a]);
                  $dWisatawan=explode(",",$dPertahun[1]);
                  echo "['".$dPertahun[0]."',".$dWisatawan[0]."],";
                }
              }
            ?>
          ]);

          
          var options = {
            width: $(window).width,
            height: 400,
            chart: {
              title: 'Statistika Pengunjung',
              subtitle: 'Domestik'
            },
            bars: 'vertical', // Required for Material Bar Charts.
            series: {
              0: { axis: 'Domenstik' }, // Bind series 0 to an axis named 'distance'.
            },
            axes: {
              x: {
                domestic: {label: 'parsecs'}, // Bottom x-axis.
                mancanegara: {side: 'top', label: 'apparent magnitude'} // Top x-axis.
              }
            }
          };
          
         
          var chart = new google.charts.Bar(document.getElementById('curve_chart'));

          chart.draw(data, options);

        }

        function drawChart2() {
          var data = google.visualization.arrayToDataTable([
            ['Tahun', 'Mancanegara'],
            <?php
              for($a=0;$a<sizeof($dPengunjung);$a++){
                if(preg_match("/:/",$dPengunjung[$a])){
                  $dPertahun=explode(":",$dPengunjung[$a]);
                  $dWisatawan=explode(",",$dPertahun[1]);
                  echo "['".$dPertahun[0]."',".$dWisatawan[1]."],";
                }
              }
            ?>
          ]);

          
          var options = {
            width: $(window).width,
            height: 400,
            chart: {
              title: 'Statistika Pengunjung',
              subtitle: 'Mancanegara'
            },
            bars: 'vertical', // Required for Material Bar Charts.
            series: {
              0: { axis: 'Mancanegara' }, // Bind series 0 to an axis named 'distance'.
            },
            axes: {
              x: {
                domestic: {label: 'parsecs'}, // Bottom x-axis.
                mancanegara: {side: 'top', label: 'apparent magnitude'} // Top x-axis.
              }
            }
          };
          
         
          var chart = new google.charts.Bar(document.getElementById('curve_chart_2'));

          chart.draw(data, options);

        }
      </script>

      <script type="text/javascript">
        $(document).ready(function(){
            $('.tooltipped').tooltip();
            $(".sidenav").sidenav();
            $(".tooltipped").tooltip();
            $(".collapsible").collapsible();
            $(".modal").modal();
            // $('#showGrafik').modal('open');
            // $('#showGrafik').modal('close');
            $('.dropdown-trigger').dropdown();
            $('.tabs').tabs();
            $("nav").css("background" , "#5e1609");  
            checkRating();

            
            
        });

        
        function callNumber(x){
          window.open('tel:'+x);
        }

        function setMyValue(x){
          $(".idComment").val(x);
        }


        function giveRating(x){
          if (typeof(Storage) !== "undefined") {
            // Store
            // localStorage.setItem("lastname", "Smith");
            // Retrieve
            // console.log(localStorage.getItem("lastname"));
            // localStorage.clear();
            var k = "<?php echo $_GET['k']; ?>";
            var i = "<?php echo $_GET['i']; ?>";
            var myRank =JSON.parse(localStorage.getItem("myRank"));
            $("#ratingContent").load("superadmin/modContent.php?insertRating="+x+"&k="+k+"&i="+i);
            if(myRank===null){
              myRank= [
                {
                  "k":k,
                  "i":i
                },
              ];
            }
            else{
              var iFoundIt=0;
              for(var a=0; a<myRank.length; a++){
                if(myRank[a]['k']==k&&myRank[a]['i']==i)
                  iFoundIt=1;
                // console.log(myRank[a]['k']+" "+myRank[a]['i']);
              }
              if(iFoundIt==0){
                myRank.push({
                    "k":k,
                    "i":i
                });
              }
              else{
                alert("You have give this site rank");
              }
            }
            localStorage.setItem("myRank", JSON.stringify(myRank));
            console.log(localStorage.getItem("myRank"));
            checkRating();
            // localStorage.clear();
          } else {
            console.log("Sorry, your browser does not support Web Storage...");
          }
        }

        function checkRating(){
          if (typeof(Storage) !== "undefined") {
           
            // localStorage.clear();
            var k = "<?php echo $_GET['k']; ?>";
            var i = "<?php echo $_GET['i']; ?>";
            var myRank =JSON.parse(localStorage.getItem("myRank"));
            
            if(myRank!==null){
              var iFoundIt=0;
              for(var a=0; a<myRank.length; a++){
                if(myRank[a]['k']==k&&myRank[a]['i']==i)
                  iFoundIt=1;
                // console.log(myRank[a]['k']+" "+myRank[a]['i']);
              }
              if(iFoundIt==0){
                $("#ratingContent").load("superadmin/modContent.php?ratingForm=1&k="+k);
              }
              else{
                $("#ratingContent").load("superadmin/modContent.php?ratingResult=1&k="+k+"&i="+i);
              }
            }
            else{
              $("#ratingContent").load("superadmin/modContent.php?ratingForm=1&k="+k);
            }
            
            
            // localStorage.clear();
          } else {
            console.log("Sorry, your browser does not support Web Storage...");
          }
        }
      </script>
      
      <!-- font-size: 72px;
  background:  -webkit-linear-gradient(left, yellow 90%, silver 1%, silver 10% );
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  padding:0px;
  margin:0px; -->
      
    </body>
  </html>