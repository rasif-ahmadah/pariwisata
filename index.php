<?php
  include 'connect.php';
?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Amaranth|Caveat|Jaldi&display=swap" rel="stylesheet">
      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="css/index.css">

      <meta name="description" content="Website Sasmita Blitar" />
      <meta name="keywords" content="Kabupaten Blitar, Sasmita Blitar, Pariwisata, Pantai, Gunung, Dinas Pariwisata, Blitar Indah" />
      <meta name="author" content="Dandi Wibowo" />

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="icon" href="images/logo.png" type="image/x-icon" />
      <title>Sasmita Blitar</title>
    </head>

    <body class="bg_full">
   
      <!-- =============================== home awal ========================= -->

        <div class="row sec1">
            <div class="col s12 center" style="font-family: 'Caveat', cursive;">
                <h1><b>Selamat Datang</b></h1>
                <h2><b>SASMITA</b></h2>
                <h5><b>Sistem Data Aplikasi Promosi Pariwisata</b></h5>

            </div>
        </div>

      <!-- =================================================================== -->

      <!-- ============================== Balok balok ===================================== -->

      <div class="row" style="background:white; margin:0px;">
        <div class="col s10 push-s1" style="text-align:center; padding-top:30px; font-family: 'Amaranth', sans-serif;">
          <h4>Blitar Pariwisata</h4>

          <div class="row" style="margin-top:70px;margin-bottom:0px;">

            <div class="row col xl3 l3 m4 s12" style="padding :20px !important;">
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
            
            <div class="row col xl3 l3 m4 s12" style="padding :20px !important;">
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

            <div class="row col xl3 l3 m4 s12" style="padding :20px !important;">
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

            <div class="row col xl3 l3 m4 s12" style="padding :20px !important;">
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

          </div>
        </div>
      </div>

      <!-- ================================================================================ -->
      <!-- =============================== home carousel dan info ========================= -->

        <div class="row sec2">

          <!-- ==================================== DESTINASI WISATA ================================ -->
          <div class="col s12 m10 push-m1 " style="padding-top: 30px; padding-bottom: 90px; border-top :solid silver 2px;">
                <h4 class="center" style="font-family: 'Amaranth', sans-serif;"><b>Destinasi Wisata</b></h4>
                <div class="row">
                    <?php
                      $dataWisata = sortByRate(showWisata($connect,"all"));

                      for($a=0; $a<4; $a++){
                        if($a<sizeof($dataWisata)){
                    ?>
                    <div class="col s12 m3">
                        <div class="card">
                        
                            <div class="card-image">
                            <img src="<?php echo $dataWisata[$a]['foto']; ?>">
                            <!-- <span class="card-title"></span> -->
                            </div>
                        
                            <div class="card-content">
                              <p style="font-family: 'Amaranth', sans-serif;"><?php echo substr($dataWisata[$a]['judul'],0,50); ?></p>
                            </div>
                            <div class="card-action">
                            <a href="./detail_artikel?<?php echo "k=wisata&i=".$dataWisata[$a]['id']; ?>">READ MORE</a>
                            </div>
                        </div>
                    </div>
                <?php
                        }
                      }
                ?>
                </div>
                <div class="row" style="text-align: center;">
                  <a href="./destinasi" class="btn red">Lihat Wisata Lainnya</a>
                </div>
            </div>
          <!-- =========================================================================================== -->

          <!-- ==================================== Akomodasi ================================ -->
          <div class="col s12 m10 push-m1 " style="padding-top: 30px; padding-bottom: 90px; border-top :solid silver 2px;">
                <h4 class="center" style="font-family: 'Amaranth', sans-serif;"><b>Akomodasi</b></h4>
                <div class="row">
                    <?php
                      
                      $dataArtikel = sortByRate(showAkomodasi($connect,"all"));

                      for($a=0; $a<4; $a++){
                        if($a<sizeof($dataArtikel)){
                    ?>
                    <div class="col s12 m3">
                        <div class="card">
                        
                            <div class="card-image">
                            <img src="<?php echo $dataArtikel[$a]['foto']; ?>">
                            <!-- <span class="card-title"></span> -->
                            </div>
                        
                            <div class="card-content">
                              <p style="font-family: 'Amaranth', sans-serif;"><?php echo substr($dataArtikel[$a]['judul'],0,50); ?></p>
                            </div>
                            <div class="card-action">
                            <a href="./detail_artikel?<?php echo "k=akomodasi&i=".$dataArtikel[$a]['id']; ?>">Read more</a>
                            </div>
                        </div>
                    </div>
                <?php
                        }
                      }
                ?>
                </div>
                <div class="row" style="text-align: center;">
                  <a href="./akomodasi" class="btn red">Lihat Akomodasi Lainnya</a>
                </div>
              </div>
          <!-- =========================================================================================== -->

          <!-- ==================================== Kuliner ================================ -->
          <div class="col s12 m10 push-m1 " style="padding-top: 30px; padding-bottom: 90px; border-top :solid silver 2px;">
                <h4 class="center" style="font-family: 'Amaranth', sans-serif;"><b>Kuliner</b></h4>
                <div class="row">
                    <?php
                      
                      $dataArtikel = sortByRate(showKuliner($connect,"all"));

                      for($a=0; $a<4; $a++){
                        if($a<sizeof($dataArtikel)){
                    ?>
                    <div class="col s12 m3">
                        <div class="card">
                        
                            <div class="card-image">
                            <img src="<?php echo $dataArtikel[$a]['foto']; ?>">
                            <!-- <span class="card-title"></span> -->
                            </div>
                        
                            <div class="card-content">
                              <p style="font-family: 'Amaranth', sans-serif;"><?php echo substr($dataArtikel[$a]['judul'],0,50); ?></p>
                            </div>
                            <div class="card-action">
                            <a href="./detail_artikel?<?php echo "k=kuliner&i=".$dataArtikel[$a]['id']; ?>">Read more</a>
                            </div>
                        </div>
                    </div>
                <?php
                        }
                      }
                ?>
                </div>
                <div class="row" style="text-align: center;">
                  <a href="./kuliner" class="btn red">Lihat Kuliner Lainnya</a>
                </div>
              </div>
          <!-- =========================================================================================== -->

          <!-- ==================================== Event ================================ -->
          <div class="col s12 m10 push-m1 " style="padding-top: 30px; padding-bottom: 90px; border-top :solid silver 2px;">
                <h4 class="center" style="font-family: 'Amaranth', sans-serif;"><b>Event</b></h4>
                <div class="row">
                    <?php
                     
                      $dataArtikel = sortByRate(showEvent($connect,"all"));

                      for($a=0; $a<4; $a++){
                        if($a<sizeof($dataArtikel)){
                    ?>
                    <div class="col s12 m3">
                        <div class="card">
                        
                            <div class="card-image">
                            <img src="<?php echo $dataArtikel[$a]['foto']; ?>">
                            <!-- <span class="card-title"></span> -->
                            </div>
                        
                            <div class="card-content">
                              <p style="font-family: 'Amaranth', sans-serif;"><?php echo substr($dataArtikel[$a]['judul'],0,50); ?></p>
                            </div>
                            <div class="card-action">
                            <a href="./detail_artikel?<?php echo "k=event&i=".$dataArtikel[$a]['id']; ?>">Read more</a>
                            </div>
                        </div>
                    </div>
                <?php
                        }
                      }
                ?>
                </div>
                <div class="row" style="text-align: center;">
                  <a href="./event" class="btn red">Lihat Event Lainnya</a>
                </div>
              </div>
          <!-- =========================================================================================== -->

          <!-- ==================================== News ================================ -->
          <div class="col s12 m10 push-m1 " style="padding-top: 30px; padding-bottom: 90px; border-top :solid silver 2px;">
                <h4 class="center" style="font-family: 'Amaranth', sans-serif;"><b>News</b></h4>
                <div class="row">
                    <?php
                      $where = array ("kategori"=>"news");
                      $dataArtikel = sortByRate(showArtikel($connect,$where));

                      for($a=0; $a<4; $a++){
                        if($a<sizeof($dataArtikel)){
                    ?>
                    <div class="col s12 m3">
                        <div class="card">
                        
                            <div class="card-image">
                            <img src="<?php echo $dataArtikel[$a]['foto']; ?>">
                            <!-- <span class="card-title"></span> -->
                            </div>
                        
                            <div class="card-content">
                              <p style="font-family: 'Amaranth', sans-serif;"><?php echo substr($dataArtikel[$a]['judul'],0,50); ?></p>
                            </div>
                            <div class="card-action">
                            <a href="./detail_artikel?<?php echo "k=news&i=".$dataArtikel[$a]['id']; ?>">Read more</a>
                            </div>
                        </div>
                    </div>
                <?php
                        }
                      }
                ?>
                </div>
                <div class="row" style="text-align: center;">
                  <a href="./news" class="btn red">Lihat News Lainnya</a>
                </div>
              </div>
          <!-- =========================================================================================== -->

        </div>

      <!-- =================================================================== -->
      <?php
        include 'footer.php';
      ?>
      <?php include 'navtop.php'; ?>

      <!-- Compiled and minified JavaScript -->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
      <script>
        $(document).ready(function(){
            $('.tooltipped').tooltip();
            $(".sidenav").sidenav();
            $(".tooltipped").tooltip();
            $(".collapsible").collapsible();
            $(".modal").modal();
            $('.carousel').carousel({
              dist:0,
              shift:0,
              padding:20,
            });
            $('.dropdown-trigger').dropdown();

            $("nav").css("background" , "rgba(1, 20, 24, 0.105)");
            
            
            $(window).scroll(function(){
              var scroll = $(window).scrollTop();
              if (scroll > -10 && scroll < 700) {
                $("nav").css("background" , "rgba(1, 20, 24, 0.105)");
              }
              
              else{
                $("nav").css("background" , "#5e1609");  	
              }
            })
        });


        function callNumber(x){
          window.open('tel:'+x);
        }

        
      </script>
      
    </body>
  </html>