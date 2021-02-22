<?php
include 'connect.php';
function detect_delimiter($csv_string)
{

    // List of delimiters that we will check for
    $delimiters = array(';' => 0,',' => 0,"\t" => 0,"|" => 0);

    // For every delimiter, we count the number of time it can be found within the csv string
    foreach ($delimiters as $delimiter => &$count) {
        $count = substr_count($csv_string,$delimiter);
    }

    // The delimiter used is probably the one that has the more occurrence in the file
    return array_search(max($delimiters), $delimiters);

}

			
				//echo"masuk";
        $kategori=$_POST['kategori'];
				$foto=explode('.',$_FILES["inData"]["name"]);
				$ext= count($foto)-1;
				$extFile=strtolower($foto[$ext]);
				 
				$file = $_FILES["inData"]["tmp_name"];
				$file_open = fopen($file,"r");
				 
				$a=0;
				$uploadOk=1;
				 
				if($extFile != "csv" ) {
					echo "Sorry, only CSV files are allowed.";
					$uploadOk = 0;
				}
				
				if($uploadOk==1){
					$enclosure = '"';
					// Let's get the content of the file and store it in the string
					$csv_string = file_get_contents($file);

					// Let's detect what is the delimiter of the CSV file
					$delimiter = detect_delimiter($csv_string);

					// Get all the lines of the CSV string
					$lines = explode("\n", $csv_string);

					// The first line of the CSV file is the headers that we will use as the keys
					$head = str_getcsv(array_shift($lines),$delimiter,$enclosure);

					$array = array();
          $data = array(); $a=0;
					// For all the lines within the CSV
					

						// Sometimes CSV files have an empty line at the end, we try not to add it in the array
						

            if($kategori=="wisata"){

              foreach ($lines as $line) {

                if(empty($line)) {
                  continue;
                }

                // Get the CSV data of the line
                $csv = str_getcsv($line,$delimiter,$enclosure);
                $judul = $csv[0];

                $koordinat = $csv[1].",".$csv[2];
                $artikel = $csv[3];
                $kategori =  ltrim($csv[4], "Wisata ");
                $HTNWeekday = $csv[5];
                $HTNWeekend = $csv[6];
                $HTMWeekday = $csv[7];
                $HTMWeekend = $csv[8];
                $JSenin = $csv[9];
                $JSelasa = $csv[10];
                $JRabu = $csv[11];
                $JKamis = $csv[12];
                $JJumat = $csv[13];
                $JSabtu = $csv[14];
                $JMinggu = $csv[15];
                $pengunjung = $csv[16];

                $RKNWeekday = $csv[17];
                $RKNWeekend = $csv[18];
                $RKMWeekday = $csv[19];
                $RKMWeekend = $csv[20];
                $JrProv = $csv[21];
                $JrKab = $csv[22];
                $JrKec = $csv[23];
                $fasilitas=array();
                if ($csv[24]=="v") $fasilitas['F1']="On";
                if ($csv[25]=="v") $fasilitas['F2']= "On" ;
                if ($csv[26]=="v") $fasilitas['F3']= "On" ;
                if ($csv[27]=="v") $fasilitas['F4']= "On" ;
                if ($csv[28]=="v") $fasilitas['F5']= "On" ;
                if ($csv[29]=="v") $fasilitas['F6']= "On" ;
                if ($csv[30]=="v") $fasilitas['F7']= "On" ;
                if ($csv[31]=="v") $fasilitas['F8']= "On" ;
                if ($csv[32]=="v") $fasilitas['F9']= "On" ;
                if ($csv[33]=="v") $fasilitas['F10']= "On" ;
                if ($csv[34]=="v") $fasilitas['F11']= "On" ;
                $sosmed = $csv[35];
                

                $tiket= array(
                  "Nusantara Weekend" =>$HTNWeekend,
                  "Nusantara Weekday" =>$HTNWeekday,
                  "Mancanegara Weekend" =>$HTMWeekend,
                  "Mancanegara Weekday" =>$HTMWeekday
                );
                $jamOperasional= array(
                  "Senin" => $JSenin,
                  "Selasa" => $JSelasa,
                  "Rabu" => $JRabu,
                  "Kamis" => $JKamis,
                  "Jumat" => $JJumat,
                  "Sabtu" => $JSabtu,
                  "Minggu" => $JMinggu
                );
                $rataPengunjung=array(
                  "Nusantara Weekend" =>$RKNWeekend,
                  "Nusantara Weekday" =>$RKNWeekday,
                  "Mancanegara Weekend" =>$RKMWeekend,
                  "Mancanegara Weekday" =>$RKMWeekday
                );
        
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
                  "kategori" => $kategori,
                  "tiket" => json_encode($tiket),
                  "jam operasional" => json_encode($jamOperasional),
                  "rata rata kunjungan" => json_encode($rataPengunjung),
                  "jarak destinasi" => json_encode($JarakDestinasi),
                  "fasilitas pendukung"=> json_encode($fasilitas),
                  "sosial media"=>$sosmed
                  
                );
                
                //   if(addToWisata($connect,$myvalue)){
                if(addToWisata($connect,$myvalue)){
                  echo "Berhasil menambahkan $judul 
                  ";
                }
              }
            }
            else if($kategori=="kuliner"){

              foreach ($lines as $line) {

                if(empty($line)) {
                  continue;
                }
						  // Get the CSV data of the line
                $csv = str_getcsv($line,$delimiter,$enclosure);
                $judul = $csv[0];

                $koordinat = $csv[1].",".$csv[2];
                $artikel = $csv[3];
                // $kategori =  ltrim($csv[4], "Wisata ");
                $harga = $csv[5];
                $JSenin = $csv[6];
                $JSelasa = $csv[7];
                $JRabu = $csv[8];
                $JKamis = $csv[9];
                $JJumat = $csv[10];
                $JSabtu = $csv[11];
                $JMinggu = $csv[12];
                $pengunjung = $csv[13];

                $RKNWeekday = $csv[14];
                $RKNWeekend = $csv[15];
                $RKMWeekday = $csv[16];
                $RKMWeekend = $csv[17];
                $JrProv = $csv[18];
                $JrKab = $csv[19];
                $JrKec = $csv[20];
                $fasilitas=array();
                if ($csv[21]=="v") $fasilitas['F1']="On";
                if ($csv[22]=="v") $fasilitas['F2']= "On" ;
                if ($csv[23]=="v") $fasilitas['F3']= "On" ;
                if ($csv[24]=="v") $fasilitas['F4']= "On" ;
                if ($csv[25]=="v") $fasilitas['F5']= "On" ;
                if ($csv[26]=="v") $fasilitas['F6']= "On" ;
                if ($csv[27]=="v") $fasilitas['F7']= "On" ;
                if ($csv[27]=="v") $fasilitas['F8']= "On" ;
                if ($csv[27]=="v") $fasilitas['F9']= "On" ;
                if ($csv[27]=="v") $fasilitas['F10']= "On" ;
                if ($csv[27]=="v") $fasilitas['F11']= "On" ;
                
                $sosmed = $csv[28];
                
                $jamOperasional= array(
                  "Senin" => $JSenin,
                  "Selasa" => $JSelasa,
                  "Rabu" => $JRabu,
                  "Kamis" => $JKamis,
                  "Jumat" => $JJumat,
                  "Sabtu" => $JSabtu,
                  "Minggu" => $JMinggu
                );
                $rataPengunjung=array(
                  "Nusantara Weekend" =>$RKNWeekend,
                  "Nusantara Weekday" =>$RKNWeekday,
                  "Mancanegara Weekend" =>$RKMWeekend,
                  "Mancanegara Weekday" =>$RKMWeekday
                );
        
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
                  // "kategori" => $kategori,
                  "harga" => $harga,
                  "jam operasional" => json_encode($jamOperasional),
                  "rata rata kunjungan" => json_encode($rataPengunjung),
                  "jarak destinasi" => json_encode($JarakDestinasi),
                  "fasilitas pendukung"=> json_encode($fasilitas),
                  "sosial media"=>$sosmed
                  
                );
                
                //   if(addToWisata($connect,$myvalue)){
                if(addToKuliner($connect,$myvalue)){
                  echo "Berhasil menambahkan $judul 
                  ";
                }
              }
            }
            else if($kategori=="akomodasi"){
              foreach ($lines as $line) {

                if(empty($line)) {
                  continue;
                }
                // Get the CSV data of the line
                $csv = str_getcsv($line,$delimiter,$enclosure);
                $judul = $csv[0];

                $koordinat = $csv[1].",".$csv[2];
                $artikel = $csv[3];
                // $kategori =  ltrim($csv[4], "Wisata ");
                $harga = $csv[4];
                $bintang = $csv[5];
                $pengunjung = $csv[6];
                $JrProv = $csv[7];
                $JrKab = $csv[8];
                $JrKec = $csv[9];
                $fasilitas=array();
                if ($csv[10]=="v") $fasilitas['F1']="On";
                if ($csv[11]=="v") $fasilitas['F2']= "On" ;
                if ($csv[12]=="v") $fasilitas['F3']= "On" ;
                if ($csv[13]=="v") $fasilitas['F4']= "On" ;
                if ($csv[14]=="v") $fasilitas['F5']= "On" ;
                if ($csv[15]=="v") $fasilitas['F6']= "On" ;
                if ($csv[16]=="v") $fasilitas['F7']= "On" ;
                if ($csv[17]=="v") $fasilitas['F8']= "On" ;
                if ($csv[18]=="v") $fasilitas['F9']= "On" ;
                if ($csv[19]=="v") $fasilitas['F10']= "On" ;
                if ($csv[19]=="v") $fasilitas['F11']= "On" ;
                
                $sosmed = $csv[20];

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
                  "harga" => $target,
                  "jarak destinasi" => json_encode($JarakDestinasi),
                  "fasilitas pendukung"=> json_encode($fasilitas),
                  "sosial media"=>$sosmed
                  
                );
                
                //   if(addToWisata($connect,$myvalue)){
                if(addToAkomodasi($connect,$myvalue)){
                  echo "Berhasil menambahkan $judul 
                  ";
                }
              }
            }
            else if($kategori=="event"){
              foreach ($lines as $line) {

                if(empty($line)) {
                  continue;
                }
                // Get the CSV data of the line
                $csv = str_getcsv($line,$delimiter,$enclosure);
                $judul = $csv[0];
                
                $artikel = $csv[1];
                // $kategori =  ltrim($csv[4], "Wisata ");
                $RKNWeekday = $csv[2];
                $RKNWeekend = $csv[3];
                $RKMWeekday = $csv[4];
                $RKMWeekend = $csv[5];

                $fasilitas=array();
                if ($csv[6]=="v") $fasilitas['F1']="On";
                if ($csv[7]=="v") $fasilitas['F2']= "On" ;
                if ($csv[8]=="v") $fasilitas['F3']= "On" ;
                if ($csv[9]=="v") $fasilitas['F4']= "On" ;
                if ($csv[10]=="v") $fasilitas['F5']= "On" ;
                if ($csv[11]=="v") $fasilitas['F6']= "On" ;
                if ($csv[12]=="v") $fasilitas['F7']= "On" ;
                if ($csv[13]=="v") $fasilitas['F8']= "On" ;
                if ($csv[14]=="v") $fasilitas['F9']= "On" ;
                if ($csv[15]=="v") $fasilitas['F10']= "On" ;
                if ($csv[16]=="v") $fasilitas['F11']= "On" ;
                
                $sosmed = $csv[20];

                $rataPengunjung=array(
                  "Nusantara Weekend" =>$RKNWeekend,
                  "Nusantara Weekday" =>$RKNWeekday,
                  "Mancanegara Weekend" =>$RKMWeekend,
                  "Mancanegara Weekday" =>$RKMWeekday
                );
        
        
                $message="Data gagal ditambahkan";
                // $file_dir=explode("../",$target_file);
                $myvalue = array(
                  "judul"=>$judul,                
                  "isi" => $artikel,                
                  "rata rata kunjungan" => json_encode($rataPengunjung),
                  "fasilitas pendukung"=> json_encode($fasilitas),
  
                );
                
                //   if(addToWisata($connect,$myvalue)){
                if(addToEvent($connect,$myvalue)){
                  echo "Berhasil menambahkan $judul 
                  ";
                }
              }
                        
            }

          }
                    
			
