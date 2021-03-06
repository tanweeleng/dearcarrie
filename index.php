<!DOCTYPE html>
<?php
  include('controllers/templates.php');
  $mainTopics = displayMainTopics();
  $topics = displayAllTopicsOrderByTitleAsc();
  $recentPosts = displayRecentPosts();
  updatePostRank();
?>
<html lang="en">
  <?php head("Dear Carrie"); ?>

  <body>
    <?= navbar(); ?>
    <div class="loader"></div>
    <div class="page-container">
      <?php if(checkLogin()) { ?>
          <div class="signup-banner">
              <div class="row">
                <div class="col-sm-3 hide-mobile">
                    <img src="images/chat.svg">
                </div>
                <div class="col-sm-9 col-xs-12">
                    <h3>Share your stories.</h3>
                    <p class="mBottom-20">Dear Carrie is a community of readers and writers offering unique perspectives on ideas large and small.</p>
                    <a href="signup" style="color:white;" class="primary-btn small">Sign up</a>
                    <a href="login" class="primary-line-btn small">Login</a>
                </div>
              </div>
          </div>
      <?php } ?>

      <div class="main-banner-grid row">
          <?php
            foreach ($mainTopics as $topic) {
            if ($topic["order_num"] == 1) {
          ?>
            <div class="col-sm-8 col-xs-12">
                <a href="topicDetails?topicID=<?=$topic["id"];?>"><img src="<?=$topic["main_image"];?>" class="img-responsive"></a>
            </div>
          <?php } else { ?>
            <div class="col-sm-4 col-xs-12">
                <a href="topicDetails?topicID=<?=$topic["id"];?>"><img src="<?=$topic["main_image"];?>" class="img-responsive"></a>
            </div>
          <?php } }?>
      </div>
      <br/><br/>

      <div class="row">
          <div class="col-sm-9">
            <div class="content-title">
              <h4>Top Stories For You</h4>
            </div>

            <?php
              /*$posts = displayAllPost();
              foreach ($posts as $post) {
                card($post["id"]);
              }*/
            ?>

            <?php //for infinite scrolling ?>
            <div id="results"><!-- results appear here --></div>
            <div class="loading-info"><img src="images/ripple.svg" /><!-- loading spinner --></div>
            <script type="text/javascript">
            var track_page = 1; //track user scroll as page number, page number starts from 1
            var loading  = false; //prevents multiple loads

            load_contents(track_page); //initial content load

            $(window).scroll(function() { //detect page scroll
              if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled to bottom of the page
                track_page++; //increases page number
                load_contents(track_page); //loads content
              }
            });
            //Ajax load function
            function load_contents(track_page){
                if(loading == false){
                loading = true;  //set loading flag on
                $('.loading-info').show(); //show loading spinner animation
                $.post( 'displayAllPostIndex.php', {'page': track_page}, function(data){
                  loading = false; //set loading flag off once the content is loaded
                  if(data.trim().length == 0){
                    //notify user if nothing to load
                    //$('.loading-info').html("No more records!");
                    $('.loading-info').html("<img class='wow bounceIn' src='images/sea.svg' style='width:10%;'>");
                    return;
                  }
                  $('.loading-info').hide(); //hide loading spinner animation once data is received
                  $("#results").append(data); //append loaded data into #results element

                }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
                  alert(thrownError); //alert with HTTP error
                })
              }
            }
            </script>
            <?php //end of infinite scrolling ?>

          </div><!-- END left column col-sm-8 -->
          <div class="col-sm-3">
              <div class="main-sidebar">
                  <div class="side-content">
                      <div class="content-title">
                        <h4>Recent Posts</h4>
                        <a href="search">Read all &#8594;</a>
                      </div>
                      <?php foreach($recentPosts as $recentPost) { ?>
                      <a href="post?postID=<?=$recentPost['id'];?>" class="mini-card">
                        <p><?=$recentPost['title'];?></p>
                      </a>
                      <?php } ?>
                  </div>

                  <div class="side-content">
                      <div class="content-title">
                          <h4>Topics</h4>
                          <a href="topic">See all &#8594;</a>
                      </div>
                      <ul>
                          <?php foreach ($topics as $topic) { ?>
                          <li><a href="topicDetails?topicID=<?=$topic["id"];?>"><?=$topic["title"];?></a></li>
                          <?php } ?>
                      </ul>
                  </div>
              </div>
              <script>staticBar('.main-sidebar','640')</script>
          </div><!-- END right column col-sm-4 -->

      </div>
    </div><!-- END page-container -->

    <?= footer(); ?>
  </body>
</html>
