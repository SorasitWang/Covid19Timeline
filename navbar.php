
<nav class="navbar navbar-inverse" >
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">Xmas</a>
    </div>
    <div class = "collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.html">Home</a></li>
          <li><a href="#">Page 1</a></li>
          <li><a href="2.php">Page 2</a></li>
          <li><a href="search.php">Page 3</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php 
                if (isset($_SESSION['id'])) { ?>
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> 
                    <?php echo $_SESSION['id'] ?></a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> logout</a></li>
            <?php } else { ?>
                <?php echo 'not set' ?>
                <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li data-toggle='modal' data-target='#login'><a href='#'><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <?php } ?>
            <div id="login" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title text-center">Log In</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method='post' >
                            <div class='form-group' style='display:block'>
                                <label class='control-label col-sm-3'>Name :</label>
                                <div class='col-sm-9'>
                                    <input class='form-control col-sm-9' type='text' name='name' placeholder="Enter user's name" >
                                </div>
                            </div>
                            <div class='form-group' style='display:block'>
                                <label class='control-label col-sm-3'>Password :</label>
                                 <div class='col-sm-9'>
                                <input class='form-control' type='password' name='pwd' placeholder='Enter password'>
                                </div>
                            </div>
                            <div class='container-fluid'>
                                 <div class='col-sm-6' style='display:flex ; justify-content:flex-start'>
                                    <h5>dosen't have account? <a href='2.php'>SIGN UP</a> </h5>
                                </div>
                                <div class='col-sm-6' style='display:flex ; justify-content:flex-end'>
                                    <input type='submit' class='btn btn-default'>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </ul>
    </div>
  </div>
</nav>