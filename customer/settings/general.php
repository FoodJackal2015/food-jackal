  
    
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
                    <a href="settings.php?setting=Advanced" class="list-group-item">Advanced</a>
                </div>
            </div>

            <div class="col-md-9">

             <br>
            <br>
            <div class="thumbnail">
            <form action="update.php"  method="post" role="form" >
    <div class="form-group">
      <label>First name:</label>
      <input type="text" class="form-control" id="fname"  name="fname" placeholder="First name:">
    </div>
     <div class="form-group">
      <label>Last Name:</label>
      <input type="text" class="form-control" id="lname"  name="lname" placeholder="Last Name:">
    </div>
    <div class="form-group">
      <label>Email:</label>
      <input type="text" class="form-control" name="email" id="email" placeholder ="Email:">
    </div>
    <div class="form-group">
      <label>Password:</label>
      <input type="password" class="form-control" name="pass" id="pass" placeholder ="Password:">
    </div>
    </div>
     <div class="text-right">
    <input type="submit" name="submit" value="Update" class="btn btn-info"></input>
     </div>
    </form>
           

            </div>
           

            </div>

        </div>

    </div>
    <!-- /.container -->
