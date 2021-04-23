<!DOCTYPE html>
<?php 
    require('connect.php');
    if (count($_POST)>0){
        $dis = $_REQUEST['district'];
        $date = '000000';
        if ($_POST['date']){
            $date = $_REQUEST['date'];
            $a = explode("-", $date);
            $date = substr($a[0],2,3).$a[1].$a[2];
            $sql1="
            SELECT DISTINCT district FROM news WHERE date = $date ;" ;
            $result = mysqli_query($conn,$sql1);
        }
        if ($_POST['district']){

            $sql2="
            SELECT DISTINCT date FROM news WHERE district = '".$dis."'  ORDER BY date DESC;";
            $result = mysqli_query($conn,$sql2);
        }
        if ($_POST['district'] and $_POST['date']){
            unset($sql1); unset($sql2);
            $sql3="
            SELECT * FROM news WHERE district = '".$dis."' and date = $date ;";
            $result = mysqli_query($conn,$sql3);
        }
    }
    $sql4="
    SELECT * FROM province ;";
    $allprovince = mysqli_query($conn,$sql4);
    ?>
<html lang="en">

<head>
  <title>2</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <link rel="stylesheet" type = "text/css" href = "mek.css">
  
</head>
<body>
    <div id="nav-placeholder"></div>
    <script>
      $(function(){
        $("#nav-placeholder").load("navbar.php");
      });
    </script>
    <script  src='getapi.js'></script>
    </script>
    <div style='background-color:rgb(243,240,240) ; min-height:700px ; padding:20px'>
    <div class='container' style='position:relative ; padding:0px 0px 40px 0px ;min-height:600px ; background-color:white'>
        <div>
            <div class='col-lg-6 text-center' style='background-color:rgb(255,170,165);padding:10px'>
                <h2 style='margin-top:0px'>New Confirmed</h2>
                <h5 style='margin-bottom:0px' id='new'></h5>
            </div>
            <div class='col-lg-6 text-center' style='background-color:rgb(168,230,207);padding:10px'>
                <h2  style='margin-top:0px' >Total Confirmed</h2>
                <h5 style='margin-bottom:0px' id='con'></h5>
            </div>
        </div>
        <div id='myform'>
        <form action='' method='post' style='text-align:center'>
            
            <div class='form-group' id='province_label' style='margin-top:10px; width:200px;height: 170px;'>
                <label class='control-label'>Enter Province</label>
                 <select class="form-control" name="district" id="district" onfocus='this.size=7;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                     <option label=" "></option>
                     <?php while($prov = mysqli_fetch_array($allprovince)) { ?>
                        <option><?php echo $prov['district'] ?></option>
                     <?php } ?>
                  </select>
            </div>
           
            <div class='form-group' style='margin-top:10px; width:200px;height: 170px;'>
                <label class='control-label'>Enter Date</label>
                <input type='date' class="form-control" value='00-00-0000' name='date'>
            </div>
            <div class='form-group' style='margin-top:10px; width:200px;height:170px;'>
                <br>
             <button id ="submit" type="submit" class="btn btn-success"><span class='glyphicon glyphicon-search
             '></span> Search</button>
             
             </div>
             <div class='form-group' style='margin-top:10px; width:200px;height:170px;'>
                <br>
                 <button type="button" class="btn btn-warning"><a href='test.html'><span class='glyphicon glyphicon-leaf
                 '></span> Go to map</a></button>
            </div>
            
        </form>
        </div>
        
               <?php if (isset($sql1)){ $i=0 ;while($obj  = mysqli_fetch_array($result)){ 
                    if ($i%3==0) { ?>
                    <div class='row' style='margin-bottom:20px'> <?php } ?>
                    <div class='col-lg-4'>
                       <div class="panel panel-default" id = 'headsearch'>
                            <div data-toggle="collapse" data-target="#<?php echo $obj['district'] ?>" class="panel-heading">
                                <?php echo $obj['district'] ?> 
                            </div>
                            <div class="collapse" id='<?php echo $obj['district'] ?>'>
                                <div class='panel-body'>
                                <?php $sql="
                                SELECT * FROM news WHERE district = '".$obj['district']."' and date = $date ;";
                                $r = mysqli_query($conn,$sql);?>
                                <?php while($t = mysqli_fetch_array($r)) { ?>
                                            <?php $arr = explode(" , ",$t['content']) ;
                                            foreach ($arr as $a){ ?>
                                                <li> <?php echo $a ; ?> </li>
                                            <?php } ?>
                                
                                <?php } ?>
                                </div>
                                </div>
                    </div>
                </div>
                <?php if ($i%3==2) { ?>
                    </div> <?php } $i++;?>
               <?php } ?>
               
               <?php if ($i%3!=3 && $i!=0) { ?>
                   </div> <?php } ?>
                   <?php } ?>
               
               <?php if (isset($sql3)) { ?>
                    <div class='panel panel-default' id='headsearch'>
                       <div  data-toggle="collapse" data-target="#data" class='panel-heading'>
                           <?php $datetime = substr($date, 4, 6)."/".substr($date, 2, 2)."/20".substr($date, 0, 2) ;
                            echo $datetime."  ".$dis ; ?>
                       </div>
                       <div class="collapse" id='data'>
                           <div class='panel-body'>
                            <?php while ($t = mysqli_fetch_array($result)) { ?>
                            
                                        <?php $arr = explode(" , ",$t['content']) ;
                                        foreach ($arr as $a){ ?>
                                            <li> <?php echo $a ; ?> </li>
                                                <?php } ?>
                            
                            <?php } ?>
                            </div>
                            </div>
                        </div>
               <?php } ?> 
               
                <?php if (isset($sql2)) {$i=0 ; while($obj  = mysqli_fetch_array($result)){ 
                    if ($i%3==0) { ?>
                    <div class='row' style='margin-bottom:20px'> <?php } ?>
                    <div class='col-lg-4'>
                       <div class="panel panel-default" id = 'headsearch'>
                            <div data-toggle="collapse" data-target="#<?php echo $obj['date'] ?>" class="panel-heading">
                                <?php $datetime = substr($obj['date'], 4, 6)."/".substr($obj['date'], 2, 2)."/20".substr($obj['date'], 0, 2) ;
                                echo $datetime ; ?> 
                            </div>
                            <div class="collapse" id='<?php echo $obj['date'] ?>'>
                                <?php $sql="
                                SELECT * FROM news WHERE date = '".$obj['date']."' and district = '".$dis."';";
                                $r = mysqli_query($conn,$sql);?>
                                <div class='panel-body'>
                                <?php while($t = mysqli_fetch_array($r)) { ?>
                                    
                                            <?php $arr = explode(" , ",$t['content']) ;
                                            foreach ($arr as $a){ ?>
                                                <li> <?php echo $a ; ?> </li>
                                            <?php } ?>
                                      
                                <?php } ?>
                                </div>
                                </div>
                    </div>
                </div>
                <?php if ($i%3==2) { ?>
                    </div> <?php } $i++;?>
               <?php } ?>
               
               <?php if ($i%3!=3 && $i!=0) { ?>
                   </div> <?php } ?>
                   <?php } ?>
               
       <br>
       <br>
        <div style='position: absolute; bottom: 0 ; min-height:25px; width:100%'>
        <button data-toggle=modal data-target='#addform' style='height:40px ; width:100%' class="btn btn-danger"><span class='glyphicon glyphicon-plus
            '></span> Add Data</button>
    </div>
    
    <script>
    var i = 1 ;
    var now = 1;
    var predetail , preprov;

        function buildnext(){
             var x, y, valid = true;
              x = document.getElementsByClassName("tab"+now);
              
            y = x[0].getElementsByTagName("input");
             for (var j = 0; j < y.length; j++) {
                if (y[j].value == "") {
                  y[j].className += " invalid";
                  valid = false;
                }
              }

              if (valid) {
                if (now==i){
                    predetail = $.trim($("#detail"+ now).val());
                    preprov =  $('#province'+ now).val();
                    now+=1;
                    $('.tab'+ i).after("<div class='tab" + (++i) + "'><div class='form-group'> <input class='form-control' type='date' name='date" + (i) + "'>  </div> <div class='form-group'> <input class='form-control' type='text' name='detail" + (i) + "' id='detail" + (i) + "' value =" + predetail.replace(' ', '') + " placeholder='เพศ อายุ' oninput='clickk()'></div><input id='detailcheck' type='checkbox' checked onclick='rememberdetail()'> <div class='form-group'>  <input class='form-control' type='text' name='amphoe" + (i) + "'placeholder='อำเภอ'>  </div> <div class='form-group'> <input class='form-control'  id='province" + (i) +"' type='text' name='province" + (i) + "' id='province" + (i) + "' value =" + preprov + " placeholder='จังหวัด' oninput='clickk()'>  </div><input id='provcheck' type='checkbox' checked onclick='rememberprov()'> <div class='form-group'>   <input class='form-control' type='text' name='time" + (i) + "' placeholder='ตั้งแต่ - สิ้นสุด : 10.00 - 12.00'> </div> <div class='form-group'> <input class='form-control' type='text' name='place" + (i) + "' placeholder='สถานที่'> </div> </div>" );
                    $('#disabledInput').val(i);
                    $('.tab'+(i-1)).attr('style','display:none');
                    $('#step').text(now+"/"+i);
                    $('#detail'+now).val(predetail);
                }
                else{
                    now+=1;
                    $('.tab'+(now)).attr('style','display:block');
                    $('.tab'+(now-1)).attr('style','display:none');
                    $('#step').text(now+"/"+i);
                    
                }
              }
              else{
                  alert('You must fill every form');
              }
           
             
        }
        
        function del(){
            if (i>1){
                $('.tab'+ i).remove();
                $('#disabledInput').val(i-1);
                if (now==i){
                    $('.tab'+(now-1)).attr('style','display:block');
                    now-=1;
                }
                
                i--;
                $('#step').text(now+"/"+i);
            }
        }
        function prev(){
            if (now>1){
             $('.tab'+(now)).attr('style','display:none');
             $('.tab'+(now-1)).attr('style','display:block');
             now-=1;
             $('#step').text(now+"/"+i);
            }

        }
        function clickk(){
            if ($('#detail'+now).val() == predetail){
                 document.getElementById("detailcheck").checked = true;
            }
            else{
                document.getElementById("detailcheck").checked = false;
            }
            if ($('#province'+now).val() == preprov){
                 document.getElementById("provcheck").checked = true;
            }
            else{
                document.getElementById("provcheck").checked = false;
            }
             
        }
        function validform(){
            var x, y;
              x = document.getElementsByClassName("tab"+now);
              
            y = x[0].getElementsByTagName("input");
             for (var j = 0; j < y.length; j++) {
                if (y[j].value == "") {
                  y[j].className += " invalid";
                  alert('You must fill every form');
                  return false;
                }
              }
            document.getElementById("form").submit();
            return false;
              
        }
        
        
        
        function rememberdetail(){
            if ($('#detail'+now).val() == predetail) {
              $('#detail'+now).val("");
             
           }
           else {
              $('#detail'+now).val(predetail);
           }
        }
        function rememberprov(){
             if ($('#province'+now).val() == preprov) {
              $('#province'+now).val("");
           }
           else {
              $('#province'+now).val(preprov);
           }
            
        }
        
        
    </script>
    <div id="addform" class="modal fade" role="dialog">
            <div class="modal-dialog" >
              <!-- Modal content-->
                <div class="modal-content" style='min-height:500px'>
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title text-center">Add Data</h4>
                      <h6 id="step">1/1</h6>
                    </div>
                    <div class="modal-body" style='height:100%'>
                        <form id='form' method='post'  action='adddata.php'>
                            <div class='tab1'>
                                <div class='form-group'>
                                    <input class='form-control' type='date' id='date1' name='date1'>
                                </div>
                                <div class='form-group'>
                                    <input class='form-control' type='text' id='detail1' name='detail1' placeholder='เพศ อายุ'>
                                </div>
                                <div class='form-group'>
                                    <input class='form-control' type='text' id='amphoe1' name='amphoe1' placeholder='อำเภอ'>
                                </div>
                                <div class='form-group'>
                                    <input class='form-control' type='text' id='province1' name='province1' placeholder='จังหวัด'>
                                </div>
                                <div class='form-group'>
                                    <input class='form-control' type='text' id='time1' name='time1' placeholder='ตั้งแต่ - สิ้นสุด : 10.00 - 12.00'>
                                </div>
                                <div class='form-group'>
                                    <input class='form-control' type='text' id='place1' name='place1' placeholder='สถานที่'>
                                </div>
                            </div>
                            <div class='container-fluid' style='display:inline'>
                                <input class='form-control' name='num' id="disabledInput" type="text" style='width:20%' value='1' > 
                                <button type='button' class='btn btn-default' onclick='prev()'>Prev</button>
                                <button class='btn btn-success' onclick='validform()'type='button'>Submit</button>
                                <button type='button'   class='btn btn-warning' onclick='buildnext()'>Next</button>
                                <button type='button' class='btn btn-danger' onclick='del()'>Delete</button>
                                
                            </div>
                        </form>
                        
                    </div>
    </div>
    
    </div>
</body>
</html>