<?php
/*
 * @category  Front End for customers updating their details
 * @package   customer/general
 * @file      general.php
 * @data      08/11/15
 * @author    Conor Thompson
 * @copyright Copyright (c) 2015
 * @description this page is included in settings.php
*/
?>
<!-- Page Content -->
<div class="container">

  <div class="row">
    <br>
    <br/>
    <br>
  </div>
  <div class="row">

    <div class="col-md-3">
      <p class="lead">General</p>
      <div class="list-group">
        <a href="settings.php?setting=My-Settings" class="list-group-item">My Settings</a>
        <a href="settings.php?setting=General" class="list-group-item active">General</a>
      </div>
    </div>

    <div class="col-md-9">

      <br>
      <br>
      <div class="thumbnail">
        <form action="update.php"  method="post" role="form" >
          <div class="form-group">
            <label>First name:</label>
            <input type="text" class="form-control" id="fname"  name="fname" value="<?php echo $_SESSION['customerFname'];?>"/>
          </div>
          <div class="form-group">
            <label>Last Name:</label>
            <input type="text" class="form-control" id="lname"  name="lname" value="<?php echo $_SESSION['customerLname']; ?>"/>
          </div>
          <div class="form-group">
            <label>Email:</label>
            <input type="text" class="form-control" name="email" id="email" value="<?php echo $_SESSION['customerEmail']; ?>"/>
          </div>
          <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" name="pass"  placeholder="" id="pass"/>
          </div>
        </div>
        <div class="text-right">
          <input type="submit" name="submit" value="Update" class="btn btn-info"/>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- /.container -->
