<style>
	@media screen and (max-width: 2000px) {
		#navbarku{
			display:block;
			width:17%;
		}
		.minmen{
			display:none;
		}
		#backarow{
			display:none;
		}
	}
	@media screen and (max-width: 800px) {
		#navbarku{
			display:none;
			width:250px;
			overflow:scroll;
			overflow-x:hidden;
		}
		.minmen{
			display:block;
		}
		#backarow{
			display:block;
		}
	}
	.men a div{
		padding:10px;
		background:white;
		color:black;
	}
	.men a div:hover{
		background:#f2f2f2;
	}
	.men a div i{
		margin-right:15px;
	}
	nav{
		z-index: 2;
	}
</style>

<!--====================================SIDENAV============================================-->
<ul id="slide-out" class="sidenav">
        
    <li><a href="akun_dashboard"><div><i class="material-icons right">home</i>Home</div></a></li>
    <li><a href="./wisata_dashboard"><div><i class="material-icons right">local_florist</i>Wisata</div></a></li>
    <li><a href="./akomodasi_dashboard"><div><i class="material-icons right">apartment</i>Akomodasi</div></a></li>
    <li><a href="./kuliner_dashboard"><div><i class="material-icons right">store</i>Kuliner</div></a></li>
    <li><a href="./event_dashboard"><div><i class="material-icons right">category</i>Event</div></a></li>
    <li><a href="./news_dashboard"><div><i class="material-icons right">menu_book</i>News</div></a></li>
    <li><a href="./setting_dashboard"><div><i class="material-icons right">settings</i>Setting</div></a></li>
    
    
    <li class="divider"></li>
    <li><a href="../keluar"><div><i class="material-icons right">cancel</i>keluar</div></a></li>
    
</ul>
<!--======================================================================================-->


<div id="navbarku" style="position:fixed; left:0px; top:0px; height:100%; background:white; padding-top:65px;">
	<div class="row" style="background:url('../superadmin/images/back.jpg'); background-size:cover; margin:0px; padding:10px; color:white;">
		<a id="backarow" href="#" onclick="navout()" style="color:white;" class="col xl1 l1 m1 s1 push-xl10 push-l10 push-m10 push-s10 material-icons">arrow_back</a>
		<img src="../superadmin/images/avatar.png" style="width:20%; margin:10px;">
		<p><?php echo $_SESSION['nama']; ?></p>
	</div>
	<div style="background:#f2f2f2;">Main Navigation</div>
	<div class="men" style="font-size:16px;">
		<a href="./akun_dashboard"><div><i class="material-icons">home</i>Home</div></a>
		<a href="./wisata_dashboard"><div><i class="material-icons">local_florist</i>Wisata</div></a>
		<a href="./akomodasi_dashboard"><div><i class="material-icons">apartment</i>Akomodasi</div></a>
		<a href="./kuliner_dashboard"><div><i class="material-icons">store</i>Kuliner</div></a>
		<a href="./event_dashboard"><div><i class="material-icons">category</i>Event</div></a>
		<a href="./news_dashboard"><div><i class="material-icons">menu_book</i>News</div></a>
		<a href="./setting_dashboard"><div><i class="material-icons">settings</i>Setting</div></a>
		<a href="../keluar"><div><i class="material-icons">cancel</i>keluar</div></a>
	</div>
</div>

<nav class="col xl12 l12 m12 s12" style="background:#f44250; color:white; position:fixed; top:0px;  width: 100%;">
	<a href="#" data-target="slide-out" class="sidenav-trigger hide-on-large-only">
		<i class="material-icons">menu</i>
	</a>
	<div class=" col xl12 l12 m11 s9">Dashboard Admin</div>
</nav>

<!-- 
<nav class="row">
    <div class="nav-wrapper col s12 m10 push-m1">
    
        <a href="#" data-target="slide-out" class="sidenav-trigger hide-on-large-only">
          <i class="material-icons">menu</i>
        </a>
      
        <a href="#" class="brand-logo">
            <img id="icon2" src="/images/logo.png">
            <img id="icon1" src="/images/madiun-white.png">
        </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="/">Beranda</a></li>
            <li><a href="/cari_lowongan">Cari Lowongan</a></li>

            
            <li><a href="/masuk" class="modal-trigger">Masuk</a></li>

            
            <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons right">arrow_drop_down</i></a></li>
            
        </ul>
    </div>
</nav> -->
<!--======================================================================================-->