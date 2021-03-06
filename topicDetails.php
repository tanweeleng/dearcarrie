<!DOCTYPE html>
<?php
  include('controllers/templates.php');
  $topicID = $_GET["topicID"];
  $topic = getTopicByID($topicID);
  $posts = getPostsByTopicID($topicID);
  $postCount = countPostByTopicID($topicID);
  $followerCount = countFollowersByTopicID($topicID);
  $followingTopic = isFollowingTopic($_SESSION["userid"],$topicID);
?>

<html lang="en">
  <?php head($topic["title"]); ?>

  <body>
    <?= scrollTopBtn(); ?>
    <?= navbar(); ?>

    <div class="page-container">
      <div class="topic-header">
        <div>
          <img src="<?=$topic["background"];?>" class="img-responsive">
          <div class="text">
              <h1><?=$topic["title"];?></h1>
              <p class="lead"><?=$topic["short_desc"];?></p>
              <?php
                if (!checkLogin()) {
                  if ($followingTopic) { //user following topic
              ?>
                    <form>
                      <input onclick="unfollowTopic(<?=$_SESSION['userid'];?>,<?=$topic['id']?>);" id="unfollowBtn1" type="button" class="white-line-btn" value="Following" onmouseover="unfollowMouseOver();" onmouseout="unfollowMouseOut()">
                    </form>
              <?php
                } else { //user not following topic
              ?>
                  <form>
                    <input onclick="followTopic(<?=$_SESSION['userid'];?>,<?=$topic['id']?>);" id="followBtn1" type="button" class="white-line-btn" value="Follow Topic">
                  </form>
              <?php
                  }
                }
              ?>
          </div>
        </div>
      </div>

      <div class="row">
          <div class="col-sm-9">
            <div class="content-title">
              <h4>Top Stories For You</h4>
            </div>
            <?php foreach ($posts as $post) {
              card($post["id"]);
            }
            ?>
          </div><!-- END left column col-sm-8 -->
          <div class="col-sm-3">
              <div class="main-sidebar">
                  <div class="side-content">
                      <div class="content-title">
                          <h4>About</h4>
                          <?php
                            if (!checkLogin()) {
                              if ($followingTopic) { //user following topic
                          ?>
                                <form>
                                  <input type="hidden" name="userid" value='<?=$_SESSION["userid"];?>'>
                                  <input type="hidden" name="topic" value='<?=$topic["id"]?>'>
                                  <input onclick="unfollowTopic(<?=$_SESSION['userid'];?>,<?=$topic['id']?>);" id="unfollowBtn2" type="button" class="follow-btn" value="Following" onmouseover="unfollowMouseOver();" onmouseout="unfollowMouseOut()">
                                </form>
                          <?php
                            } else { //user not following topic
                          ?>
                              <form>
                                <input type="hidden" name="userid" value='<?=$_SESSION["userid"];?>'>
                                <input type="hidden" name="topic" value='<?=$topic["id"]?>'>
                                <input onclick="followTopic(<?=$_SESSION['userid'];?>,<?=$topic['id']?>);" id="followBtn2" type="button" class="follow-btn" value="Follow Topic">
                              </form>
                          <?php
                              }
                            }
                          ?>
                      </div>
                      <div class="mBottom-20">
                          <p><?=$topic["title"];?></p>
                          <p><?=$topic["description"];?></p>
                      </div>
                      <?php if ($topic["tel"] != null) { ?>
                      <div class="mBottom-40">
                          <p>Tel: <?=$topic["tel"];?></p>
                          <a href="<?=$topic['url'];?>"><?=$topic["url"];?></a>
                      </div>
                      <?php } ?>
                      <div class="dual-hero">
                          <div>
                            <p class="topic-detail-title">Followers</p>
                            <p class="lead"><?=$followerCount;?></p>
                          </div>
                          <div>
                            <p class="topic-detail-title">Posts</p>
                            <p class="lead"><?=$postCount;?></p>
                          </div>
                      </div>
                  </div>
                  
              </div>
          </div><!-- END right column col-sm-4 -->

      </div>
    </div><!-- END page-container -->
    <?= footer(); ?>
  </body>
  <script src="js/followTopic.js"></script>


</html>
