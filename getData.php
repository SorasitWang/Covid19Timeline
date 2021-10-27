<?php 
    //echo "sssss" ;
    require('connect.php') ;
    $date = $_REQUEST['date'];
    $pro = $_REQUEST['province'];
    $arr = array();
    $arr2 = array();
    $arr3 = array();
    if ($pro==""){
            $a = explode("-", $date);
            $date = substr($a[0],2,3).$a[1].$a[2];
            $sql="
            SELECT * FROM news WHERE date = '".$date."' ;" ;
            $result = mysqli_query($conn,$sql);
            while ($obj = mysqli_fetch_array($result)){
                array_push($arr,$obj['district']);
                array_push($arr2,$obj['count']);
                array_push($arr3,$obj['content']);
            }
        }
    else if ($date==""){
            $sql="
            SELECT * FROM news WHERE district = '".$pro."'  ORDER BY date DESC;";
            $result = mysqli_query($conn,$sql);
            while ($obj = mysqli_fetch_array($result)){
                array_push($arr,$obj['date']);
                array_push($arr2,$obj['count']);
                array_push($arr3,$obj['content']);
            }
        }
    else {
            $sql="
            SELECT * FROM news WHERE province = '".$pro."' and date = $date ;";
            $result = mysqli_query($conn,$sql);
            while ($obj = mysqli_fetch_array($result)){
                array_push($arr,$obj['content']);
                array_push($arr2,$obj['count']);
                array_push($arr3,$obj['content']);
            }
        }
   
    echo implode(",",$arr)."/".implode(",",$arr2)."/".implode(",",$arr3);
    
    ?>