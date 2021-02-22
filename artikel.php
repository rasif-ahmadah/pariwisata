<?php include 'connect.php'; ?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Amaranth|Caveat|Jaldi&display=swap" rel="stylesheet">
      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
      <link rel="stylesheet" href="css/artikel.css">

      <meta name="description" content="Website Sasmita Blitar" />
      <meta name="keywords" content="Kabupaten Blitar, Sasmita Blitar, Pariwisata, Pantai, Gunung, Dinas Pariwisata, Blitar Indah" />
      <meta name="author" content="Dandi Wibowo" />

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="icon" href="images/logo.png" type="image/x-icon" />
      <title>Sasmita Blitar</title>
    </head>

    <?php
      if($_GET['k']=="akomodasi"){
        $background = "akomodasi.jpg";
      }
      else if($_GET['k']=="kuliner"){
        $background = "kuliner.jpg";
      }
      else if($_GET['k']=="event"){
        $background = "event.jpg";
      }
      else if($_GET['k']=="news"){
        $background = "news.jpg";
      }
      // echo $_GET['k'];
    ?>
    <body class="bg_full" style="background-image: url('images/<?php echo $background; ?>');">
    
      <!-- =============================== home awal ========================= -->

        <div class="row sec1">
            <div class="col s12 l10 push-l1 center">
                <h5 style="font-family: 'Amaranth', sans-serif;"><b>Kumpulan <?php echo $_GET['k']; ?></b></h5>
                <div class="input-field col s12 ">
                  <input style="color:white;" type="text" placeholder="Masukkan judul artikel" id="search" oninput="setSearch()">
                </div>
                
            </div>
        </div>

      <!-- =================================================================== -->

      <!-- =============================== home carousel dan info ========================= -->

        <div class="row sec2">

            <div class="col s12 m10 push-m1">
                            
                <div class="col s12 listArtikel">
                    
                </div>
            
            </div>

        </div>

      <!-- =================================================================== -->

      <!-- ================================ Footer ================================== -->
      <?php
        include 'footer.php';
      ?>
      <?php
     include 'navtop.php';
     ?>
      <!-- Compiled and minified JavaScript -->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
      <script>
          var search="all";
          var kategori="<?php echo $_GET['k']; ?>";
        $(document).ready(function(){
            $('.tooltipped').tooltip();
            $(".sidenav").sidenav();
            $(".tooltipped").tooltip();
            $(".collapsible").collapsible();
            $(".modal").modal();
            $('.dropdown-trigger').dropdown();
            showContent();

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

        function showContent(){
            $(".listArtikel").load("contentArtikel.php?search="+search+"&kategori="+kategori);
        }

        function setSearch(){
            search=$("#search").val();
            showContent();
        }
       
      </script>
      
    </body>
  </html>