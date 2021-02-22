<?php include 'connect.php'; 
  $kategori=$_GET['pg'];
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
    <link rel="stylesheet" href="css/wisata.css">

    <meta name="description" content="Website Sasmita Blitar" />
    <meta name="keywords" content="Kabupaten Blitar, Sasmita Blitar, Pariwisata, Pantai, Gunung, Dinas Pariwisata, Blitar Indah" />
    <meta name="author" content="Dandi Wibowo" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="icon" href="images/logo.png" type="image/x-icon" />
    <title>Sasmita Blitar</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body  class="">

    <!--=========================== Modal edit artikel ==============================-->
        <!-- Modal Structure -->
        <div id="modEWisata" class="modal">
          <div class="modal-content" id="modContent">
            <div class="progress">
                <div class="indeterminate"></div>
            </div>
          </div>
        </div>
    <!-- ========================================================================= -->
    <div id="map"></div>
    <!-- =============================== home carousel dan info ========================= -->
    
    <div class="row" style="margin-top:-40px !important;">
        <div class="col s12 l10 push-l1 center place" >
            <div class="input-field col s12 ">
              <input type="text" placeholder="Masukkan nama destinasi" id="search" oninput="setSearch()">
            </div>
        </div>
    </div>
    <div class="row sec2">

        <div class="col s12 m10 push-m1">
          <h5 style="font-family: 'Amaranth', sans-serif; text-align:center;"><b><?php echo ucwords($_GET['pg']); ?></b></h5>

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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        var search="all";
        var kategori="<?php echo $_GET['pg']; ?>";
        $(document).ready(function(){
            $('.tooltipped').tooltip();
            $(".sidenav").sidenav();
            $(".tooltipped").tooltip();
            $(".collapsible").collapsible();
            $(".modal").modal();
            $('.dropdown-trigger').dropdown();
            showContent();

            // $("nav").css("background" , "rgba(1, 20, 24, 0.505)");
            
            
            // $(window).scroll(function(){
            //   var scroll = $(window).scrollTop();
            //   if (scroll > -10 && scroll < 700) {
            //     $("nav").css("background" , "rgba(1, 20, 24, 0.505)");
            //   }
              
            //   else{
                $("nav").css("background" , "#5e1609");  	
            //   }
            // })
        });
        
        function showContent(){
            $(".listArtikel").load("<?php echo $URL; ?>/contentArtikel.php?kategori="+kategori+"&search="+search);
        }

        function modalContent(kat,x){
            $("#modContent").load("<?php echo $URL; ?>/contentArtikel.php?kategori="+kat+"&modal="+x);
        }

        function setSearch(){
            search=$("#search").val();
            showContent();
        }
    </script>
    <script>
      var map;
      function initMap() {
        <?php
            $dataWisata= array();
            $dataWisata2= array();
            $dc=0;

            // if($_GET['pg']=="wisata")
            //   $dataWisata2=showWisata($connect,"all");
            // else if($_GET['pg']=="kuliner")
            //   $dataWisata2=showKuliner($connect,"all");
            // else if($_GET['pg']=="akomodasi")

            
              $mydata=showWisata($connect,"all");
              for($aa=0;$aa<sizeof($mydata);$aa++,$dc++){
                $dataWisata2[$dc]=array(
                  "koordinat" => $mydata[$aa]['koordinat'],
                  "kategori" => $mydata[$aa]['kategori'],
                  "id" => $mydata[$aa]['id'],
                );
              }
            
              $mydata=showKuliner($connect,"all");
              for($aa=0;$aa<sizeof($mydata);$aa++,$dc++){
                $dataWisata2[$dc]=array(
                  "koordinat" => $mydata[$aa]['koordinat'],
                  "kategori" => "Kuliner",
                  "id" => $mydata[$aa]['id'],
                );
              }
            
              $mydata=showAkomodasi($connect,"all");
              for($aa=0;$aa<sizeof($mydata);$aa++,$dc++){
                $dataWisata2[$dc]=array(
                  "koordinat" => $mydata[$aa]['koordinat'],
                  "kategori" => "Akomodasi",
                  "id" => $mydata[$aa]['id'],
                );
              }

             // https://www.google.com/maps/search/?api=1&query=36.26577,-92.54324           
            $b=0;
            for($a=0;$a<sizeof($dataWisata2);$a++){
              if(trim($dataWisata2[$a]['koordinat'])!=","){
                $dataWisata[$b]=$dataWisata2[$a];
                $b++;
              }
              
            }
        ?>
        map = new google.maps.Map(
            document.getElementById('map'),
            {center: new google.maps.LatLng(<?php echo $dataWisata[0]['koordinat']; ?>), zoom: 16});

        var iconBase =
            '<?php echo $URL; ?>/images/map/';

        var icons = {
          Pantai: {
            icon: iconBase + 'Pantai.png'
          },
          Taman: {
            icon: iconBase + 'Taman.png'
          },
          Gunung: {
            icon: iconBase + 'Gunung.png'
          },
          Goa: {
            icon: iconBase + 'Goa.png'
          },
          Alam: {
            icon: iconBase + 'Alam.png'
          },
          Sejarah: {
            icon: iconBase + 'Sejarah.png'
          },
          Pertanian: {
            icon: iconBase + 'Pertanian.png'
          },
          Buatan: {
            icon: iconBase + 'Buatan.png'
          },
          Kuliner: {
            icon: iconBase + 'Kuliner.png'
          },
          Cagar: {
            icon: iconBase + 'Cagar Alam.png'
          },
          Akomodasi : {
            icon: iconBase + 'Akomodasi.png'
          }
        };

        var features = [
          <?php
           
            for ($a=0;$a<sizeof($dataWisata);$a++){
              echo "
                {
                  position: new google.maps.LatLng(".$dataWisata[$a]['koordinat']."),
                  type: '"; echo ($dataWisata[$a]['kategori']=="Cagar Alam")? "Cagar" : $dataWisata[$a]['kategori']; echo "',
                  id : '".$dataWisata[$a]['id']."'
                },
              ";
            }  
          
          
          ?>
          
        ];


        <?php
           
           for ($a=0;$a<sizeof($dataWisata);$a++){
             $katArtikel = ($dataWisata[$a]['kategori']=="Cagar Alam")? "Cagar" : $dataWisata[$a]['kategori'];
             echo "
             var marker$a = new google.maps.Marker({
                position: features[$a].position,
                icon: icons[features[$a].type].icon,
                map: map,
                id : features[$a].id
              });

              marker$a.addListener('click', function() {
                var idMarker=marker$a.get('id');
                modalContent('$katArtikel',idMarker);
                $('#modEWisata').modal('open'); 
                // alert('this is alert '+idMarker);
              });
             ";
           }  
         ?>
        // // Create markers.
        // for (var i = 0; i < features.length; i++) {
        //   var marker = new google.maps.Marker({
        //     position: features[i].position,
        //     icon: icons[features[i].type].icon,
        //     map: map,
        //     id : features[i].id
        //   });
          
        // };

        // marker.addListener('click', function() {
        //   var idMarker=marker.get("id");
        //   modalContent(idMarker);
        //   $('#modEWisata').modal('open'); 
        //   // alert("this is alert "+idMarker);
        // });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFZb2crzmiZ-M71w77lsAuEt-mwmPO5xQ&callback=initMap">
    </script>
  </body>
</html>