<?php
  include 'connect.php';
    if(isset($_GET['search'])&&isset($_GET['kategori'])){
        
        $search=$_GET['search'];

        $kategori=$_GET['kategori'];

        if($kategori == "wisata")
            $data=showWisata($connect,"all");
        else if($kategori == "akomodasi")
            $data=showAkomodasi($connect,"all");
        else if($kategori == "kuliner")
            $data=showKuliner($connect,"all");
        else if($kategori == "event")
            $data=showEvent($connect,"all");
        else {
            $where=array("kategori"=>$kategori);
            $data=showArtikel($connect,$where);
        }
        $searchData=array();

        $b=0;
        for($a=0;$a<sizeof($data);$a++){
            if($search!="all"){
                // echo $search;
                if(
                    preg_match("/".strtolower($search)."/",strtolower(strtolower($data[$a]['judul'])))
                ){
                    $searchData[$b]=$data[$a];
                    $b++;
                }
            }
            else{
                $searchData[$b]=$data[$a];
                $b++;
            }
        }

       

        $fixData=sortByRate($searchData);
        $nArtikel=sizeof($fixData);

?>
        <div class="col m12 s12 listLowongan">
            <p><b>Ditemukan <?php echo $nArtikel." ".$kategori; ?></b></p>

            <ul class="collection"  style="border:none;">
                <?php
                    for($a=0;$a<$nArtikel;$a++){


                ?>
                    <div class="col s12 m3">
                        <div class="card">
                        <?php
                            if($fixData[$a]['foto']!=""){
                        ?>
                            <div class="card-image">
                            <img src="<?php echo $fixData[$a]['foto']; ?>">
                            
                            </div>
                        <?php
                            }
                        ?>
                            <div class="card-content">
                            <p><?php echo substr($fixData[$a]['judul'],0,50); ?></p>
                            </div>
                            <div class="card-action">
                            <a href="./detail_artikel?<?php echo "k=$kategori&i=".$fixData[$a]['id']; ?>">Read more</a>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
                
            </ul>
        </div>
<?php
    }

    else if (isset($_GET['kategori'])&&isset($_GET['modal'])){
        $idWisata=$_GET['modal'];
        $kategori=$_GET['kategori'];
        $kategori = (   $kategori=="Sejarah"||
                        $kategori=="Pantai"||
                        $kategori=="Taman"||
                        $kategori=="Gunung"||
                        $kategori=="Alam"||
                        $kategori=="Pertanian"||
                        $kategori=="Buatan"||    
                        $kategori=="Cagar"   
                    ) ? "wisata" : strtolower($kategori);
        // echo $kategori." ".$idWisata;
        if($kategori=="wisata")
            $data=showWisata($connect,array("id"=>$idWisata));
        else if($kategori=="kuliner")
            $data=showKuliner($connect,array("id"=>$idWisata));
        else if($kategori=="akomodasi")
            $data=showAkomodasi($connect,array("id"=>$idWisata));
        ?>
        <div class="row">
            <div class="col s12">
                <img src="<?php echo $data[0]['foto']; ?>" style="width: 100%;">
            </div>
            <div class="col s12">
                <h4><?php echo $data[0]['judul']; ?></h4>
                <div class="col s12">
                    <p><b>Jumlah Kunjungan (Orang)</b></p>
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
                <p><?php echo substr($data[0]['isi'],0,100)." "; ?><a href="./detail_artikel?k=<?php echo $kategori; ?>&i=<?php echo $data[0]['id']; ?>"><b>Lanjutkan Membaca</b></a></p>
                <a class="btn blue col s12" href=" https://www.google.com/maps/search/?api=1&query=<?php echo $data[0]['koordinat']; ?>" target="_blank">Buka di GMap</a>
                
            </div>
        </div>
        
        <?php
    }
?>
