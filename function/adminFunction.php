<?php

function addToAdmin($connect,$myvalue){
  $queri= "INSERT INTO a_admin (";


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

function showAdmin($connect,$where){
    $queri= "SELECT * FROM a_admin ";
    if($where!="all"){
        $queri .= " Where ";
        $par=array_keys($where);
        for($a=0; $a<(sizeof($where)-1);$a++){
            $queri = $queri." `".$par[$a]."`='".$where[$par[$a]]."' and";
        }
        $queri = $queri." `".$par[$a]."`='".$where[$par[$a]]."'";
    }
    $queri .= " ORDER BY id DESC";
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


function showUniqAdmin($connect,$where,$myvalue,$param){
    $where= strtolower($where);
    if($where =="all")
        $queri= "SELECT DISTINCT $param FROM a_admin";
    else 
        $queri= "SELECT DISTINCT $param FROM a_admin where $where = '$myvalue'";

    $info = array();
    $a=0;
    $process=mysqli_query ($connect,$queri);
    while($data=mysqli_fetch_array($process)){
        $info [$a]= $data["$param"];
        $a++;
    }
    
  
    return $info;
}

function deleteAdmin($connect,$where,$myvalue){
    $where= strtolower($where);
    if($where =="all")
        $queri= "DELETE FROM a_admin WHERE 1";
    else 
        $queri= "DELETE FROM a_admin where $where = '$myvalue'";

    $process=mysqli_query ($connect,$queri);
    if($process)
     return true;

    return false;
}


function updateAdmin($connect,$where,$myvalue){
    $queri =" UPDATE a_admin SET";

    $par=array_keys($myvalue);

    
    for($a=0; $a<(sizeof($myvalue)-1);$a++){
        $queri = $queri." ".$par[$a]."= '".$myvalue[$par[$a]]."',";
    }

    $queri = $queri." ".$par[$a]."= '".$myvalue[$par[$a]]."' WHERE ";

    $par=array_keys($where);

    
    for($a=0; $a<(sizeof($where)-1);$a++){
        $queri = $queri." ".$par[$a]."= '".$where[$par[$a]]."' and ";
    }

    $queri = $queri." ".$par[$a]."= '".$where[$par[$a]]."' ";
    
    // echo $queri;
    $process=mysqli_query ($connect,$queri);
    if($process)
     return true;

    return false;
}

function isEmailAvaiable($connect,$email){
    $queri= "SELECT * FROM a_admin where email='$email'";
    $process=mysqli_query ($connect,$queri);
    // echo $queri;
    $row = mysqli_num_rows($process);
    if($row==0)
        return false;
    else
        return true;
}

function filterData($data,$column,$myvalue){
    $b=0;
    $info = array();
    for($a=0;$a<sizeof($data);$a++){
        $found=0;
        for($aa=0; $aa<sizeof($myvalue);$aa++){
            for($bb=0; $bb<sizeof($column);$bb++){
                if(preg_match('/'.strtolower($myvalue[$aa]).'/',strtolower($data[$a][$column[$bb]]))){       
                    $found++;
                }
            }
        }
        if($found>0){
            $info [$b]=$data[$a];
            $b++;
        }
    }
    return $info;
}

function sortByRate($data){
    for($a=0;$a<sizeof($data);$a++){
        
        if($data[$a]['rating']!=""){

            for($b=0; $b<sizeof($data);$b++){

                if($data[$b]['rating']!=""){
                    $ratAValue=explode(";",$data[$a]['rating']);
                    $ratA=$ratAValue[0]/$ratAValue[1];
                    // echo $ratA."</br>";

                    $ratBValue=explode(";",$data[$b]['rating']);
                    $ratB=$ratBValue[0]/$ratBValue[1];

                    // echo $ratA."</br>";

                    if($ratA>$ratB){
                        $temp=$data[$b];
                        $data[$b]=$data[$a];
                        $data[$a]=$temp;
                    }
                }

            }

        }
    }
    return $data;
}
?>