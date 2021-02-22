<?php
    // include 'connect.php';
?>
<style>
nav{
    /* background : #0096fa; */
    background : #f75454;
    padding-top: 20px !important;
    padding-left: 10px !important;
    padding-right: 10px !important;
    position: fixed;
    width: 100%;
    z-index: 1;
    top:0;
}

nav a #logo{
    width:75px;
}
nav a #icon1{
    width:40px;
}
nav a #icon2{
    width:70px;
}

.dropdown-content{
    top:-70px;
}

#titNav{
    color:white;
    font-family: 'Baloo Bhai', cursive;
    font-size: large;
}
</style>
<!--====================================SIDENAV============================================-->
<ul id="slide-out" class="sidenav">
        
    <li><a href="<?php echo $URL;?>/">Beranda</a></li>
    <li><a href="<?php echo $URL;?>/destinasi">Wisata</a></li>
    <li><a href="<?php echo $URL;?>/akomodasi">Akomodasi</a></li>
    <li><a href="<?php echo $URL;?>/kuliner">Kuliner</a></li>
    <li><a href="<?php echo $URL;?>/event">Event</a></li>
    <li><a href="<?php echo $URL;?>/news">News</a></li>
    
    <?php
        if(isset($_SESSION['nama'])&&isset($_SESSION['email'])&&isset($_SESSION['idUser'])){
            echo "<li><a href='$URL/keluar'>Keluar</a></li>";
        }
        else{
            echo "<li><a href='$URL/masuk'>Masuk</a></li>";
        }
    ?>
</ul>
<!--======================================================================================-->

<!--===================================Navbar=============================================-->
<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
    <li><a href="<?php echo $URL;?>/destinasi">Wisata</a></li>
    <li><a href="<?php echo $URL;?>/akomodasi">Akomodasi</a></li>
    <li><a href="<?php echo $URL;?>/kuliner">Kuliner</a></li>
    <li><a href="<?php echo $URL;?>/event">Event</a></li>
    <li><a href="<?php echo $URL;?>/news">News</a></li>
    <?php
        if(isset($_SESSION['nama'])&&isset($_SESSION['email'])&&isset($_SESSION['idUser'])){
            echo "<li><a href='$URL/keluar'>Keluar</a></li>";
        }
        else{
            echo "<li><a href='$URL/masuk'>Masuk</a></li>";
        }
    ?>
</ul>
<nav class="row">
    <div class="nav-wrapper col s12 m10 push-m1">
    
        <a href="#" data-target="slide-out" class="sidenav-trigger hide-on-large-only">
          <i class="material-icons">menu</i>
        </a>
      
        <a href="#" class="brand-logo">
            <img id="icon1" src="<?php echo $URL;?>/images/logo.png">
            <img id="icon2" src="<?php echo $URL;?>/images/amazingblitarWhite.png">
            
        </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="<?php echo $URL;?>/">Beranda</a></li>
            <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Discover<i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
    </div>
</nav>
<!--======================================================================================-->