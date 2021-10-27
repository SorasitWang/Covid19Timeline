    
    <?php
        $servername = 'localhost';
        $username = 'id17832799_root';
        $password = 'h[{X_[R^tX]1me]Z';
        $dbname = 'id17832799_coide19timeline';
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
        	die("Connection : failed (เชื่อมต่อฐานข้อมูล ไม่ สำเร็จ)" . mysqli_connect_error());
        } else {
        	//echo "Connection : OK (เชื่อมต่อฐานข้อมูลสำเร็จ)";
        }
        
        ?>