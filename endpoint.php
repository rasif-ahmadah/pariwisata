<?php
    include 'connect.php';

    function encript ($text){

        return base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode(base64_encode($text))))))));
    
    }
    
    function decript($text){
    
        return base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(base64_decode($text))))))));
        
    }

    if(isset($_GET['getToken'])&&isset($_POST['email'])&&isset($_POST['password'])){
        $email = htmlentities(strip_tags(trim($_POST['email'])));
        $password = htmlentities(strip_tags(trim($_POST['password'])));
      
        $message="Akun Tidak ditemukan";
        if(isEmailAvaiable($connect,$email)){
          $where = array (
            "email" => $email
          );
          $data=showAdmin($connect,$where);

          if(password_verify($password, $data[0]['password'])){
            $message=encript($email);
          }
          else 
           $message="Password salah";
        }

        $data = array ("token" => $message);
        echo json_encode($data);
    }



    else if(isset($_GET['artikel'])){

        $idAartikel="all";

        $kategori=$_GET['artikel'];

        if($kategori == "wisata"){
            if(isset($_GET['artikel_id'])){
                $idAartikel= array (
                    "id" => $_GET['artikel_id']
                );
                $data=showWisata($connect,$idAartikel);
            }
            else 
                {
                    $data=showWisata($connect,"all");
                }
        }
        else {
            if(isset($_GET['artikel_id'])){
                
                $where=array(
                    "kategori"=>$kategori,
                    "id" => $_GET['artikel_id']
                );
                $data=showArtikel($connect,$where);;
            }
            else 
                {
                    $where=array("kategori" => $_GET['artikel']);
                    $data=showArtikel($connect,$where);
                }
            
        }
        echo json_encode($data);
    }

    else if(
        isset($_GET['updateWisata'])&&isset($_POST['pengunjung'])&&
        isset($_POST['koordinat'])&&isset($_POST['judul'])&&
        isset($_POST['isi'])&&isset($_POST['token'])
        ){

        $idWisata = htmlentities(strip_tags(trim($_GET['updateWisata'])));
        $koordinat = htmlentities(strip_tags(trim($_POST['koordinat'])));
        $judul = htmlentities(strip_tags(trim($_POST['judul'])));
        $pengunjung = htmlentities(strip_tags(trim($_POST['pengunjung'])));
        $isi = htmlentities(strip_tags(trim($_POST['isi'])));
        $email = decript(htmlentities(strip_tags(trim($_POST['token']))));

        $message="Invalid Token";
        if(isEmailAvaiable($connect,$email)){
            $myvalue= array(
                "koordinat" => $koordinat,
                "judul" => $judul,
                "pengunjung" => $pengunjung,
                "isi" => $isi
            );
            $where= array(
                "id" => $idWisata
            );
            // echo "masuk";
            if(updateWisata($connect,$where,$myvalue)){
                $message="Data has been updated";
            }
        }
        
        $data = array ("pesan" => $message);
        echo json_encode($data);
    }

    else if(
        isset($_GET['deleteWisata'])&&isset($_POST['token'])
        ){

        $idWisata = htmlentities(strip_tags(trim($_GET['deleteWisata'])));
        $email = decript(htmlentities(strip_tags(trim($_POST['token']))));

        $message="Invalid Token";
        if(isEmailAvaiable($connect,$email)){
            // echo "masuk";
            if(deleteWisata($connect,"id",$idWisata)){
                $message="Data has been deleted";
            }
        }
        
        $data = array ("pesan" => $message);
        echo json_encode($data);
    }


    else if(isset($_GET['tok'])){

        echo decript($_GET['tok']);
    }


    else if(
        isset($_GET['updateArtikel'])&&isset($_POST['judul'])&&
        isset($_POST['isi'])&&isset($_POST['token'])
        ){

        $idArtikel = htmlentities(strip_tags(trim($_GET['updateArtikel'])));
        $judul = htmlentities(strip_tags(trim($_POST['judul'])));
        $isi = htmlentities(strip_tags(trim($_POST['isi'])));
        $email = decript(htmlentities(strip_tags(trim($_POST['token']))));

        $message="Invalid Token";
        if(isEmailAvaiable($connect,$email)){
            $myvalue= array(
                "judul" => $judul,
                "isi" => $isi
            );
            $where= array(
                "id" => $idArtikel
            );
            // echo "masuk";
            if(updateArtikel($connect,$where,$myvalue)){
                $message="Data has been updated";
            }
        }
        
        $data = array ("pesan" => $message);
        echo json_encode($data);
    }

    else if(
        isset($_GET['deleteArtikel'])&&isset($_POST['token'])
        ){

        $idArtikel = htmlentities(strip_tags(trim($_GET['deleteArtikel'])));
        $email = decript(htmlentities(strip_tags(trim($_POST['token']))));

        $message="Invalid Token";
        if(isEmailAvaiable($connect,$email)){
            // echo "masuk";
            if(deleteArtikel($connect,"id",$idWisata)){
                $message="Data has been deleted";
            }
        }
        
        $data = array ("pesan" => $message);
        echo json_encode($data);
    }

?>