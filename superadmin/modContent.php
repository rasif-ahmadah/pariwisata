<?php
include '../connect.php';
if(isset($_GET['del'])){
    ?>

        <h5><b>Apakah anda yakin ingin menghapus artikel ini ?</b></h5>
        <form action="" method="POST">
            <input type="hidden" value="<?php echo $_GET['del']; ?>" name="deleteWisata">
            <input type="submit" class="btn red" value="Hapus">
            <div class="btn blue modal-close">Batalkan</div>
        </form>

    <?php
}
else if(isset($_GET['delWisata'])){
    ?>

        <h5><b>Apakah anda yakin ingin menghapus artikel ini ?</b></h5>
        <form action="" method="POST">
            <input type="hidden" value="<?php echo $_GET['delWisata']; ?>" name="deleteWisata">
            <input type="submit" class="btn red" value="Hapus">
            <div class="btn blue modal-close">Batalkan</div>
        </form>

    <?php
}
else if(isset($_GET['delAdmin'])){
    ?>

        <h5><b>Apakah anda yakin ingin menghapus akun ini ?</b></h5>
        <form action="" method="POST">
            <input type="hidden" value="<?php echo $_GET['delAdmin']; ?>" name="deleteAdmin">
            <input type="submit" class="btn red" value="hapus">
            <div class="btn blue modal-close">Batalkan</div>
        </form>

    <?php
}
else if(isset($_GET['edit'])&&isset($_GET['editKategori'])){
    $idArtikel=$_GET['edit'];    
    $kategori=$_GET['editKategori'];
    $where= array(
        "id" => $idArtikel
    );
    $data=showArtikel($connect,$where);

    // print_r($data);
    ?>
        <h5><b>Edit Artikel</b></h5>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="Judul" id="judul" value="<?php echo $data[0]['judul']; ?>" name="judul" type="text" class="validate">
                    <label class="active" for="judul">Judul</label>
                </div>
                <input value="<?php echo $data[0]['id']; ?>" name="id_artikel" type="hidden">
                <input value="<?php echo $kategori; ?>" name="kategori" type="hidden">
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
                    <textarea id="artikel" class="materialize-textarea" name="artikel"><?php echo $data[0]['isi']; ?></textarea>
                    <label class="active" for="artikel">Tulis Artikel</label>
                </div>
                
            </div>
            <input type="submit" class="btn" value="simpan">
        </form>
    <?php
}
else if(isset($_GET['editWisata'])){
    $idWisata=$_GET['editWisata'];
    $where= array(
        "id" => $idWisata
    );
    $dataWisata=showWisata($connect,$where);
    
    ?>
        <h5><b>Edit Wisata</b></h5>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col m6 s12">
                    <p>Judul</p>
                    <input placeholder="Judul" id="judul" value="<?php echo $dataWisata[0]['judul']; ?>" name="judul" type="text" class="validate">
                   
                </div>
                <div class="input-field col m6 s12">
                    <p>Koordinat</p>
                    <input placeholder="Koordinat" id="koordinat" value="<?php echo $dataWisata[0]['koordinat']; ?>" name="koordinat" type="text" class="validate">
                    
                </div>
                <div class="input-field col s12">
                    <p>Jumlah Pengunjung</p>
                    <p><b>Tahun : Jumlah_Nusantara, Jumlah_Mancanegara; Tahun2 : Jumlah_Nusantara2, Jumlah_Mancanegara2 </b></p>
                    <input placeholder="Jumlah Pengunjung" id="pengunjung" value="<?php echo $dataWisata[0]['pengunjung']; ?>" name="pengunjung" type="text" class="validate">
                    
                </div>
                <!-- <div class="input-field col s12">
                    <b>Alamat</b>
                    <input placeholder="Alamat Lengkap" id="alamat" name="alamat" type="text" value="<?php echo $dataWisata[0]['alamat']; ?>" class="validate">
                    
                </div> -->
                <div class="input-field col s12 m6">
                    <p>Kategori Wisata</p>
                    <select  class="browser-default" name="kategori">
                        <option value="" selected disabled>Pilih Kategori</option>
                        <option value="Pertanian" <?php if ($dataWisata[0]['kategori']=="Pertanian") echo "selected"; ?> >Pertanian</option>
                        <option value="Cagar Alam" <?php if ($dataWisata[0]['kategori']=="Cagar Alam") echo "selected"; ?> >Cagar Alam </option>
                        <option value="Buatan" <?php if ($dataWisata[0]['kategori']=="Buatan") echo "selected"; ?> >Buatan</option>
                        <option value="Alam" <?php if ($dataWisata[0]['kategori']=="Alam") echo "selected"; ?> >Alam</option>
                        <option value="Sejarah" <?php if ($dataWisata[0]['kategori']=="Sejarah") echo "selected"; ?> >Sejarah</option>
                    </select>
                </div>
                <input value="<?php echo $dataWisata[0]['id']; ?>" name="id_wisata" type="hidden">
                <div class="col s12 m6">
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
                    <textarea id="artikel" class="materialize-textarea" name="artikel"><?php echo $dataWisata[0]['isi']; ?></textarea>
                    <label class="active" for="artikel">Tulis Artikel</label>
                </div>
                <div class="row">
                    <?php 
                        $dataTiket = json_decode($dataWisata[0]['tiket'],true); 
                       
                    ?>
                    <div class="col s12 m6">
                        <div class="col s12"><b>Harga Tiket Wisatawan Nusantara</b></div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekend" name="HTNWeekend" value="<?php echo $dataTiket['Nusantara Weekend']; ?>" type="text" class="validate">
                        </div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekday" name="HTNWeekday" value="<?php echo $dataTiket['Nusantara Weekday']; ?>" type="text" class="validate">
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="col s12"><b>Harga Tiket Wisatawan Mancanegara</b></div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekend" name="HTMWeekend" value="<?php echo $dataTiket['Mancanegara Weekend']; ?>" type="text" class="validate">
                        </div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekday" name="HTMWeekday" value="<?php echo $dataTiket['Mancanegara Weekday']; ?>" type="text" class="validate">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row"><b>Rata-Rata Jumlah Kunjungan /  hari </b></div>
                    <?php 
                        $rPengunjung = json_decode($dataWisata[0]['rata rata kunjungan'],true); 
                    ?>
                    <div class="col s12 m6">
                        <div class="col s12"><b>Wisatawan Nusantara</b></div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekend" name="RKNWeekend" value="<?php echo $rPengunjung['Nusantara Weekend']; ?>" type="text" class="validate">
                        </div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekday" name="RKNWeekday" value="<?php echo $rPengunjung['Nusantara Weekday']; ?>" type="text" class="validate">
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="col s12"><b>Wisatawan Mancanegara</b></div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekend" name="RKMWeekend" value="<?php echo $rPengunjung['Mancanegara Weekend']; ?>" type="text" class="validate">
                        </div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekday" name="RKMWeekday" value="<?php echo $rPengunjung['Mancanegara Weekday']; ?>" type="text" class="validate">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php 
                        $jOperasional = json_decode($dataWisata[0]['jam operasional'],true); 
                    ?>
                    <div class="col s12"><b>Jam Operasional</b></div>
                    <div class="input-field col m6 s12">
                        <b>Senin</b>
                        <input placeholder="08:00 s/d 17:00" name="JSenin" value="<?php echo $jOperasional['Senin']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Selasa</b>
                        <input placeholder="08:00 s/d 17:00" name="JSelasa" value="<?php echo $jOperasional['Selasa']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Rabu</b>
                        <input placeholder="08:00 s/d 17:00" name="JRabu" value="<?php echo $jOperasional['Rabu']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Kamis</b>
                        <input placeholder="08:00 s/d 17:00" name="JKamis" value="<?php echo $jOperasional['Kamis']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Jum'at</b>
                        <input placeholder="08:00 s/d 17:00" name="JJumat" value="<?php echo $jOperasional['Jumat']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Sabtu</b>
                        <input placeholder="08:00 s/d 17:00" name="JSabtu" value="<?php echo $jOperasional['Sabtu']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Minggu</b>
                        <input placeholder="08:00 s/d 17:00" name="JMinggu" value="<?php echo $jOperasional['Minggu']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Sosial Media</b>
                        <textarea class="materialize-textarea" name="sosmed"><?php echo $dataWisata[0]['sosial media']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <?php 
                        $jDestinasi = json_decode($dataWisata[0]['jarak destinasi'],true); 
                    ?>
                    <div class="col s12"><b>Jarak Destinasi Wisata</b></div>
                    <div class="input-field col m6 s12">
                        <b>Dari Ibu Kota Provinsi (Surabaya)</b>
                        <input placeholder="………….km/sekitar…………jam……….menit" name="JrProv" value="<?php echo $jDestinasi['Jarak Provinsi']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Dari Ibu Kota Kabupaten (Kanigoro)</b>
                        <input placeholder="………….km/sekitar…………jam……….menit" name="JrKab" value="<?php echo $jDestinasi['Jarak Kabupaten']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Dari Kecamatan</b>
                        <input placeholder="………….km/sekitar…………jam……….menit" name="JrKec" value="<?php echo $jDestinasi['Jarak Kecamatan']; ?>" type="text" class="validate">
                    </div>
                </div>
                <div class="row">
                    <?php 
                        $fPendukung = json_decode($dataWisata[0]['fasilitas pendukung'],true); 
                    ?>
                    <div class="col s12"><b>Fasilitas Pendukung</b></div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F1" <?php echo array_key_exists("F1",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Penginapan/Homestay</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F2" <?php echo array_key_exists("F2",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Warung makan/restoran</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F3" <?php echo array_key_exists("F3",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Toko Cenderamata</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F4" <?php echo array_key_exists("F4",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Balai Pertemuan</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F5" <?php echo array_key_exists("F5",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Peta dan Tanda Informasi</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F6" <?php echo array_key_exists("F6",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Pusat Informasi Pariwisata</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F7" <?php echo array_key_exists("F7",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Toilet Umum</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F8" <?php echo array_key_exists("F8",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Area Parkir</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F9" <?php echo array_key_exists("F9",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Tempat Sampah</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F10" <?php echo array_key_exists("F10",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Jaringan Telekomunikasi</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F11" <?php echo array_key_exists("F11",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Jaringan Listrik</b></span>
                    </label>
                    </div>
                    
                </div>
            </div>
            <input type="submit" class="btn" value="simpan">
        </form>
    <?php
}
else if(isset($_GET['editKuliner'])){
    $idKuliner=$_GET['editKuliner'];
    $where= array(
        "id" => $idKuliner
    );
    $dataKuliner=showKuliner($connect,$where);
    
    ?>
        <h5><b>Edit Kuliner</b></h5>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col m6 s12">
                    <p>Judul</p>
                    <input placeholder="Judul" id="judul" value="<?php echo $dataKuliner[0]['judul']; ?>" name="judul" type="text" class="validate">
                   
                </div>
                <div class="input-field col m6 s12">
                    <p>Koordinat</p>
                    <input placeholder="Koordinat" id="koordinat" value="<?php echo $dataKuliner[0]['koordinat']; ?>" name="koordinat" type="text" class="validate">
                    
                </div>
                <div class="input-field col s12">
                    <p>Jumlah Pengunjung</p>
                    <p><b>Tahun : Jumlah_Nusantara, Jumlah_Mancanegara; Tahun2 : Jumlah_Nusantara2, Jumlah_Mancanegara2 </b></p>
                    <input placeholder="Jumlah Pengunjung" id="pengunjung" value="<?php echo $dataKuliner[0]['pengunjung']; ?>" name="pengunjung" type="text" class="validate">
                    
                </div>
                <!-- <div class="input-field col s12">
                    <b>Alamat</b>
                    <input placeholder="Alamat Lengkap" id="alamat" name="alamat" type="text" value="<?php echo $dataKuliner[0]['alamat']; ?>" class="validate">
                    
                </div> -->
                <div class="input-field col s12">
                    <b>Harga Mulai </b>
                    <input placeholder="Rp." id="harga" name="harga" type="text" value="<?php echo $dataKuliner[0]['harga']; ?>" class="validate">
                    
                </div>
                <input value="<?php echo $dataKuliner[0]['id']; ?>" name="id_wisata" type="hidden">
                <div class="col s12 m6">
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
                    <textarea id="artikel" class="materialize-textarea" name="artikel"><?php echo $dataKuliner[0]['isi']; ?></textarea>
                    <label class="active" for="artikel">Tulis Artikel</label>
                </div>
                
                <div class="row">
                    <div class="row"><b>Rata-Rata Jumlah Kunjungan /  hari </b></div>
                    <?php 
                        $rPengunjung = json_decode($dataKuliner[0]['rata rata kunjungan'],true); 
                    ?>
                    <div class="col s12 m6">
                        <div class="col s12"><b>Kulinerwan Nusantara</b></div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekend" name="RKNWeekend" value="<?php echo $rPengunjung['Nusantara Weekend']; ?>" type="text" class="validate">
                        </div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekday" name="RKNWeekday" value="<?php echo $rPengunjung['Nusantara Weekday']; ?>" type="text" class="validate">
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="col s12"><b>Kulinerwan Mancanegara</b></div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekend" name="RKMWeekend" value="<?php echo $rPengunjung['Mancanegara Weekend']; ?>" type="text" class="validate">
                        </div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekday" name="RKMWeekday" value="<?php echo $rPengunjung['Mancanegara Weekday']; ?>" type="text" class="validate">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php 
                        $jOperasional = json_decode($dataKuliner[0]['jam operasional'],true); 
                    ?>
                    <div class="col s12"><b>Jam Operasional</b></div>
                    <div class="input-field col m6 s12">
                        <b>Senin</b>
                        <input placeholder="08:00 s/d 17:00" name="JSenin" value="<?php echo $jOperasional['Senin']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Selasa</b>
                        <input placeholder="08:00 s/d 17:00" name="JSelasa" value="<?php echo $jOperasional['Selasa']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Rabu</b>
                        <input placeholder="08:00 s/d 17:00" name="JRabu" value="<?php echo $jOperasional['Rabu']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Kamis</b>
                        <input placeholder="08:00 s/d 17:00" name="JKamis" value="<?php echo $jOperasional['Kamis']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Jum'at</b>
                        <input placeholder="08:00 s/d 17:00" name="JJumat" value="<?php echo $jOperasional['Jumat']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Sabtu</b>
                        <input placeholder="08:00 s/d 17:00" name="JSabtu" value="<?php echo $jOperasional['Sabtu']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Minggu</b>
                        <input placeholder="08:00 s/d 17:00" name="JMinggu" value="<?php echo $jOperasional['Minggu']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Sosial Media</b>
                        <textarea class="materialize-textarea" name="sosmed"><?php echo $dataKuliner[0]['sosial media']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <?php 
                        $jDestinasi = json_decode($dataKuliner[0]['jarak destinasi'],true); 
                    ?>
                    <div class="col s12"><b>Jarak Destinasi Kuliner</b></div>
                    <div class="input-field col m6 s12">
                        <b>Dari Ibu Kota Provinsi (Surabaya)</b>
                        <input placeholder="………….km/sekitar…………jam……….menit" name="JrProv" value="<?php echo $jDestinasi['Jarak Provinsi']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Dari Ibu Kota Kabupaten (Kanigoro)</b>
                        <input placeholder="………….km/sekitar…………jam……….menit" name="JrKab" value="<?php echo $jDestinasi['Jarak Kabupaten']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Dari Kecamatan</b>
                        <input placeholder="………….km/sekitar…………jam……….menit" name="JrKec" value="<?php echo $jDestinasi['Jarak Kecamatan']; ?>" type="text" class="validate">
                    </div>
                </div>
                <div class="row">
                    <?php 
                        $fPendukung = json_decode($dataKuliner[0]['fasilitas pendukung'],true); 
                    ?>
                    <div class="col s12"><b>Fasilitas Pendukung</b></div>
                    
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F1" <?php echo array_key_exists("F1",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Toko Oleh-Oleh</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F2" <?php echo array_key_exists("F2",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Balai Pertemuan</b></span>
                    </label>
                    </div>
                    
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F3" <?php echo array_key_exists("F3",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Toilet Umum</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F4" <?php echo array_key_exists("F4",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Area Parkir</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F5" <?php echo array_key_exists("F5",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Tempat Sampah</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F6" <?php echo array_key_exists("F6",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Jaringan Telekomunikasi</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F7" <?php echo array_key_exists("F7",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Jaringan Listrik</b></span>
                    </label>
                    </div>
                    
                </div>
            </div>
            <input type="submit" class="btn" value="simpan">
        </form>
    <?php
}
else if(isset($_GET['editAkomodasi'])){
    $idAkomodasi=$_GET['editAkomodasi'];
    $where= array(
        "id" => $idAkomodasi
    );
    $dataAkomodasi=showAkomodasi($connect,$where);
    
    ?>
        <h5><b>Edit Akomodasi</b></h5>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col m6 s12">
                    <p>Judul</p>
                    <input placeholder="Judul" id="judul" value="<?php echo $dataAkomodasi[0]['judul']; ?>" name="judul" type="text" class="validate">
                   
                </div>
                <div class="input-field col m6 s12">
                    <p>Koordinat</p>
                    <input placeholder="Koordinat" id="koordinat" value="<?php echo $dataAkomodasi[0]['koordinat']; ?>" name="koordinat" type="text" class="validate">
                    
                </div>
                <div class="input-field col s12">
                    <p>Jumlah Pengunjung</p>
                    <p><b>Tahun : Jumlah_Nusantara, Jumlah_Mancanegara; Tahun2 : Jumlah_Nusantara2, Jumlah_Mancanegara2 </b></p>
                    <input placeholder="Jumlah Pengunjung" id="pengunjung" value="<?php echo $dataAkomodasi[0]['pengunjung']; ?>" name="pengunjung" type="text" class="validate">
                    
                </div>
                <!-- <div class="input-field col s12">
                    <b>Alamat</b>
                    <input placeholder="Alamat Lengkap" id="alamat" name="alamat" type="text" value="<?php echo $dataAkomodasi[0]['alamat']; ?>" class="validate">
                    
                </div> -->
                <div class="input-field col s12 m6">
                    <b>Harga Mulai </b>
                    <input placeholder="Rp." name="harga" type="text" value="<?php echo $dataAkomodasi[0]['harga']; ?>" class="validate">
                    
                </div>
                <div class="input-field col s12 m6">
                    <b>Bintang </b>
                    <input placeholder="Number" name="bintang" type="number" value="<?php echo $dataAkomodasi[0]['bintang']; ?>" class="validate">
                    
                </div>
                <input value="<?php echo $dataAkomodasi[0]['id']; ?>" name="id_wisata" type="hidden">
                
                <div class="input-field col s12 ">
                    <textarea id="artikel" class="materialize-textarea" name="artikel"><?php echo $dataAkomodasi[0]['isi']; ?></textarea>
                    <label class="active" for="artikel">Tulis Artikel</label>
                </div>
                
                <div class="row">
                    <?php 
                        $jDestinasi = json_decode($dataAkomodasi[0]['jarak destinasi'],true); 
                    ?>
                    <div class="col s12"><b>Jarak Destinasi Akomodasi</b></div>
                    <div class="input-field col m6 s12">
                        <b>Dari Ibu Kota Provinsi (Surabaya)</b>
                        <input placeholder="………….km/sekitar…………jam……….menit" name="JrProv" value="<?php echo $jDestinasi['Jarak Provinsi']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Dari Ibu Kota Kabupaten (Kanigoro)</b>
                        <input placeholder="………….km/sekitar…………jam……….menit" name="JrKab" value="<?php echo $jDestinasi['Jarak Kabupaten']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Dari Kecamatan</b>
                        <input placeholder="………….km/sekitar…………jam……….menit" name="JrKec" value="<?php echo $jDestinasi['Jarak Kecamatan']; ?>" type="text" class="validate">
                    </div>
                    <div class="input-field col m6 s12">
                        <b>Sosial Media</b>
                        <textarea class="materialize-textarea" name="sosmed"><?php echo $dataAkomodasi[0]['sosial media']; ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <?php 
                        $fPendukung = json_decode($dataAkomodasi[0]['fasilitas pendukung'],true); 
                    ?>
                    <div class="col s12"><b>Fasilitas Pendukung</b></div>
                    
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F1" <?php echo array_key_exists("F1",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Warung makan/restoran</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F2" <?php echo array_key_exists("F2",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Toko Cenderamata</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F3" <?php echo array_key_exists("F3",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Balai Pertemuan</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F4" <?php echo array_key_exists("F4",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Peta dan Tanda Informasi</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F5" <?php echo array_key_exists("F5",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Pusat Informasi Pariwisata</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F6" <?php echo array_key_exists("F6",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Toilet Umum</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F7" <?php echo array_key_exists("F7",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Area Parkir</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F8" <?php echo array_key_exists("F8",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Tempat Sampah</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F9" <?php echo array_key_exists("F9",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Jaringan Telekomunikasi</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F10" <?php echo array_key_exists("F10",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Jaringan Listrik</b></span>
                    </label>
                    </div>
                    
                </div>
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
            </div>
            <input type="submit" class="btn" value="simpan">
        </form>
    <?php
}
else if(isset($_GET['editEvent'])){
    $idEvent=$_GET['editEvent'];
    $where= array(
        "id" => $idEvent
    );
    $dataEvent=showEvent($connect,$where);
    
    ?>
        <h5><b>Edit Event</b></h5>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col m6 s12">
                    <p>Judul</p>
                    <input placeholder="Judul" id="judul" value="<?php echo $dataEvent[0]['judul']; ?>" name="judul" type="text" class="validate">
                   
                </div>
                <input value="<?php echo $dataEvent[0]['id']; ?>" name="id_wisata" type="hidden">
                <div class="col s12 m6">
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
                    <textarea id="artikel" class="materialize-textarea" name="artikel"><?php echo $dataEvent[0]['isi']; ?></textarea>
                    <label class="active" for="artikel">Tulis Artikel</label>
                </div>
                <div class="row">
                    <div class="row"><b>Rata-Rata Jumlah Kunjungan /  hari </b></div>
                    <?php 
                        $rPengunjung = json_decode($dataEvent[0]['rata rata kunjungan'],true); 
                    ?>
                    <div class="col s12 m6">
                        <div class="col s12"><b>Kulinerwan Nusantara</b></div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekend" name="RKNWeekend" value="<?php echo $rPengunjung['Nusantara Weekend']; ?>" type="text" class="validate">
                        </div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekday" name="RKNWeekday" value="<?php echo $rPengunjung['Nusantara Weekday']; ?>" type="text" class="validate">
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="col s12"><b>Kulinerwan Mancanegara</b></div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekend" name="RKMWeekend" value="<?php echo $rPengunjung['Mancanegara Weekend']; ?>" type="text" class="validate">
                        </div>
                        <div class="input-field col m6 s12">
                            <input placeholder="Weekday" name="RKMWeekday" value="<?php echo $rPengunjung['Mancanegara Weekday']; ?>" type="text" class="validate">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php 
                        $fPendukung = json_decode($dataEvent[0]['fasilitas pendukung'],true); 
                    ?>
                    <div class="col s12"><b>Fasilitas Pendukung</b></div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F1" <?php echo array_key_exists("F1",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Penginapan/Homestay</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F2" <?php echo array_key_exists("F2",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Warung makan/restoran</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F3" <?php echo array_key_exists("F3",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Toko Cenderamata</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F4" <?php echo array_key_exists("F4",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Balai Pertemuan</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F5" <?php echo array_key_exists("F5",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Peta dan Tanda Informasi</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F6" <?php echo array_key_exists("F6",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Pusat Informasi Pariwisata</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F7" <?php echo array_key_exists("F7",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Toilet Umum</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F8" <?php echo array_key_exists("F8",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Area Parkir</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F9" <?php echo array_key_exists("F9",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Tempat Sampah</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F10" <?php echo array_key_exists("F10",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Jaringan Telekomunikasi</b></span>
                    </label>
                    </div>
                    <div class="input-field col m6 s12">
                    <label>
                        <input type="checkbox" class="filled-in" name="F11" <?php echo array_key_exists("F11",$fPendukung) ? "checked='checked'" : "" ?>/>
                        <span><b>Jaringan Listrik</b></span>
                    </label>
                    </div>
                    
                </div>
            </div>
            <input type="submit" class="btn" value="simpan">
        </form>
    <?php
}
else if(isset($_GET['ratingForm'])&&isset($_GET['k'])){
    ?>
    <div class="row" style="text-align: center;">
        <h5>Beri rating untuk <?php echo $_GET['k']; ?> ini</h5>
        <div class="col s12">
            <a href="#ratingContent" onclick="giveRating(1)"><i class="material-icons">star</i></a>
            <a href="#ratingContent" onclick="giveRating(2)"><i class="material-icons">star</i></a>
            <a href="#ratingContent" onclick="giveRating(3)"><i class="material-icons">star</i></a>
            <a href="#ratingContent" onclick="giveRating(4)"><i class="material-icons">star</i></a>
            <a href="#ratingContent" onclick="giveRating(5)"><i class="material-icons">star</i></a>
        </div>
    </div>
    <?php
}
else if(isset($_GET['ratingResult'])&&isset($_GET['k'])&&isset($_GET['i'])){
   
        $k=$_GET['k'];
        $i=$_GET['i'];
        $star=array(0,0,0,0,0,0);
        $rating=0;
        $where=array(
            "id"=>$i
        );
        if($k=="wisata")
            $ratingValue=showWisata($connect,$where);
        else if($k=="kuliner")
            $ratingValue=showKuliner($connect,$where);
        else if($k=="akomodasi")
            $ratingValue=showAkomodasi($connect,$where);
        else if($k=="event")
            $ratingValue=showEvent($connect,$where);
        else if($k=="news")
            $ratingValue=showArtikel($connect,$where);
        
        if($ratingValue[0]['rating']!=""){
            $nilai=explode(';',$ratingValue[0]['rating']);
            $rating=$nilai[0]/$nilai[1];

            for($a=0;$a<=($rating%6);$a++)
                $star[$a]=100;
            
            $star[$a]=($rating-($rating%6))*85;
        }
    ?>
    <div class="col s12 m4 push-m4 ">
        <h5 class="center">Rating untuk <?php echo $k;?> ini</h5>
        <div class="col s5">
            <span class="red-text" style="font-size:90px;" ><b><?php echo number_format($rating,1); ?></b></span>
        </div>
        <div class="col s7" style="padding-top:40px;">
            <div class="col s12" >

                <a style="background: -webkit-linear-gradient(left, yellow <?php echo $star[1]."%"; ?>, silver 1%, silver 10% );  -webkit-background-clip: text;  -webkit-text-fill-color: transparent; padding-top: 10px;" ><i class="material-icons" style="font-size:25px;">star</i></a>
                <a style="background: -webkit-linear-gradient(left, yellow <?php echo $star[2]."%"; ?>, silver 1%, silver 10% );  -webkit-background-clip: text;  -webkit-text-fill-color: transparent; padding-top: 10px;" ><i class="material-icons" style="font-size:25px;">star</i></a>
                <a style="background: -webkit-linear-gradient(left, yellow <?php echo $star[3]."%"; ?>, silver 1%, silver 10% );  -webkit-background-clip: text;  -webkit-text-fill-color: transparent; padding-top: 10px;" ><i class="material-icons" style="font-size:25px;">star</i></a>
                <a style="background: -webkit-linear-gradient(left, yellow <?php echo $star[4]."%"; ?>, silver 1%, silver 10% );  -webkit-background-clip: text;  -webkit-text-fill-color: transparent; padding-top: 10px;" ><i class="material-icons" style="font-size:25px;">star</i></a>
                <a style="background: -webkit-linear-gradient(left, yellow <?php echo $star[5]."%"; ?>, silver 1%, silver 10% );  -webkit-background-clip: text;  -webkit-text-fill-color: transparent; padding-top: 10px;" ><i class="material-icons" style="font-size:25px;">star</i></a>
                
            </div>
            <div class="col s12" style="font-size:25px;" >
                <span class="grey-text text-darken-2" ><i class="material-icons left" style="font-size:40px;">group</i><?php echo $nilai[1];?></span>
            </div>
        </div>
    </div>
    <?php
}
else if(isset($_GET['insertRating'])&&isset($_GET['k'])&&isset($_GET['i'])){
        $k=$_GET['k'];
        $i=$_GET['i'];
        $myRating=$_GET['insertRating'];
        
        
        $where=array(
            "id"=>$i
        );
        if($k=="wisata")
            $ratingValue=showWisata($connect,$where);
        else if($k=="kuliner")
            $ratingValue=showKuliner($connect,$where);
        else if($k=="akomodasi")
            $ratingValue=showAkomodasi($connect,$where);
        else if($k=="event")
            $ratingValue=showEvent($connect,$where);
        else if($k=="news")
            $ratingValue=showArtikel($connect,$where);
        
        $myVal=$myRating.";1";

        if($ratingValue[0]['rating']!=""){
            $nilai=explode(';',$ratingValue[0]['rating']);
            $myVal=($myRating+$nilai[0]).";".($nilai[1]+1);
        }
        
        $myValue= array(
            "rating"=>$myVal
        );

        if($k=="wisata")
            updateWisata($connect,$where,$myValue);
        else if($k=="kuliner")
            updateKuliner($connect,$where,$myValue);
        else if($k=="akomodasi")
            updateAkomodasi($connect,$where,$myValue);
        else if($k=="event")
            updateEvent($connect,$where,$myValue);
        else if($k=="news")
            updateArtikel($connect,$where,$myValue);
}
?>