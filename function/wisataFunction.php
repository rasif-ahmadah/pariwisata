<?php

function addToWisata($connect,$myvalue){
  $queri= "INSERT INTO a_wisata (";


  $par=array_keys($myvalue);

    
    for($a=0; $a<(sizeof($myvalue)-1);$a++){
        $queri = $queri." `".$par[$a]."`,";
    }

    $queri = $queri." `".$par[$a]."`) VALUES (";

    for($a=0; $a<(sizeof($myvalue)-1);$a++){
        $queri = $queri." '".$myvalue[$par[$a]]."',";
    }

    $queri = $queri." '".$myvalue[$par[$a]]."')";

  $process=mysqli_query ($connect,$queri);
//   echo $queri;
  if($process)
     return true;

  return false;
}

function showWisata($connect,$where){
    
    
    $queri= "SELECT * FROM a_wisata ";

    if($where!="all"){
        $queri .= " Where ";
        $par=array_keys($where);
        for($a=0; $a<(sizeof($where)-1);$a++){
            $queri = $queri." `".$par[$a]."`='".$where[$par[$a]]."' and ";
        }
        $queri = $queri." `".$par[$a]."`='".$where[$par[$a]]."'";
    }
    $queri .= " ORDER BY judul ASC";
    $info = array();
    $a=0;
    // echo $queri;
    $process=mysqli_query ($connect,$queri);
    while($data=mysqli_fetch_array($process)){
        $info [$a]=$data;
        $a++;
    }
    
  
    return $info;
}


function showUniqWisata($connect,$where,$myvalue,$param){
    $where= strtolower($where);
    if($where =="all")
        $queri= "SELECT DISTINCT $param FROM a_wisata";
    else 
        $queri= "SELECT DISTINCT $param FROM a_wisata where $where = '$myvalue'";

    $info = array();
    $a=0;
    $process=mysqli_query ($connect,$queri);
    while($data=mysqli_fetch_array($process)){
        $info [$a]= $data["$param"];
        $a++;
    }
    
  
    return $info;
}

function countWisata($connect){
   
    $queri= "SELECT * FROM a_wisata";
    $process=mysqli_query ($connect,$queri);
    $row = mysqli_num_rows($process);
    
    return $row;
}

function deleteWisata($connect,$where,$myvalue){
    $where= strtolower($where);
    if($where =="all")
        $queri= "DELETE FROM a_wisata WHERE 1";
    else 
        $queri= "DELETE FROM a_wisata where $where = '$myvalue'";

    $process=mysqli_query ($connect,$queri);
    if($process)
     return true;

    return false;
}


function updateWisata($connect,$where,$myvalue){
    $queri =" UPDATE a_wisata SET";

    $par=array_keys($myvalue);

    
    for($a=0; $a<(sizeof($myvalue)-1);$a++){
        $queri = $queri." `".$par[$a]."`= '".$myvalue[$par[$a]]."',";
    }

    $queri = $queri." `".$par[$a]."`= '".$myvalue[$par[$a]]."' WHERE ";

    $par=array_keys($where);

    
    for($a=0; $a<(sizeof($where)-1);$a++){
        $queri = $queri." `".$par[$a]."`= '".$where[$par[$a]]."' and ";
    }

    $queri = $queri." `".$par[$a]."`= '".$where[$par[$a]]."' ";
    
    // echo $queri;
    $process=mysqli_query ($connect,$queri);
    if($process)
     return true;

    return false;
}
?>