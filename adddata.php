<?php 
    header("Location:mek.php");
    require('connect.php');
    $num = $_REQUEST['num'];
    for ($i=1;$i<=$num;$i++){
        $date = $_REQUEST['date'.$i];
        $district = $_REQUEST['amphoe'.$i];
        $province = $_REQUEST['province'.$i];
        $date= $_REQUEST['date'.$i];
        $a = explode("-", $date);
        $date = substr($a[0],2,3).$a[1].$a[2];
        $place = $_REQUEST['place'.$i];
        $detail = $_REQUEST['detail'.$i];
        $time = $_REQUEST['time'.$i];
        $content = $detail." ".$place." ".$time ;
        $sql = "
        SELECT * FROM news WHERE date = '".$date."' AND province = '".$province."' AND district = '".$district."' ;";
        $has = mysqli_query($conn,$sql);
        $arr = mysqli_fetch_array($has);
        if(is_array($arr)){
            $newcontent = $arr['content']." , ".$content ;
            $sql = "
            UPDATE news SET content = '$newcontent', count = count+1 WHERE date = '".$date."' AND province = '".$province."' AND district = '".$district."' ;" ;
            mysqli_query($conn,$sql) or die ("Error in query: $sql " . mysqli_error()) ; 
        } else{
            $sql = "
            INSERT INTO news (date,province,district,content,count) VALUES ('$date','$province','$district','$content',1); " ;
            mysqli_query($conn,$sql) or die ("Error in query: $sql " . mysqli_error()) ; 
        }
    }
    
    ?>