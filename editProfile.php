<!DOCTYPE html>
<?php
  include('controllers/templates.php');
  $userID = $_GET["userID"];
  $user = getUserByID($userID);
  redirectNonUsers();
  goBackIfNotEqual($_SESSION["userid"], $userID);
?>

<html lang="en">
  <?php head("Edit Profile"); ?>

  <body>
    <?= navbar(); ?>
    <div class="page-container">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading"><h4>Edit Profile</h4></div>
            <div class="panel-body">
              <form action="editProfileProcess" method="post">
                <div class="form-group">
                  <input name="userid" type="hidden" value="<?=$user["id"];?>">
                  <label for="name">Image</label>
                  <input type="file">
                  <img src="<?=$user["image"];?>" width="80">
                  <input name="image" type="hidden" value="<?=$user["image"];?>">
                </div>
                <div class="form-group">
                  <label for="name">Name</label>
                  <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="name" value="<?=$user["name"];?>">
                </div>
                <div class="form-group">
                  <label for="desc">Description</label>
                  <textarea name="desc" id="desc" class="form-control" rows="5"><?=$user["description"];?></textarea>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="<?=$user["email"];?>">
                </div>
                <button class="primary-line-btn" type="submit">Update</button>
              </form>
            </div>
          </div>

          <div class="panel panel-default">
            <div class="panel-heading"><h4>Password</h4></div>
            <div class="panel-body">
              <form>
                <div class="form-group">
                  <label>Old Password</label>
                  <input type="password" class="form-control">
                </div>
                <div class="form-group">
                  <label>New Password</label>
                  <input type="password" class="form-control">
                </div>
                <div class="form-group">
                  <label>Confirm New Password</label>
                  <input type="password" class="form-control">
                </div>
                <button class="primary-line-btn" type="submit">Change Password</button>
              </form>
            </div>
          </div>
        </div>
      </div><!-- ./row -->

    </div>

    <?= footer(); ?>
  </body>

</html>
