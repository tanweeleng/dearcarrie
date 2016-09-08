<!DOCTYPE html>
<?php include('controllers/templates.php'); ?>

<html lang="en">
  <?php head("Topic Details"); ?>

  <body>
    <?= scrollTopBtn(); ?>
    <?= navbar(); ?>

    <div class="page-container wow fadeInUp">
      <div class="topic-header">
        <div>
          <img src="images/topic-img.png">
          <h1>Personal Growth</h1>
          <p class="lead medium-text">Keep Learning. Keep Growing.</p>
        </div>
      </div>

      <div class="row">
          <div class="col-sm-9">
            <div class="content-title">
              <h4>Top Stories For You</h4>
            </div>
            <?php for ($i=1; $i<=10; $i++) {
              card();
            }
            ?>
          </div><!-- END left column col-sm-8 -->
          <div class="col-sm-3">
            <div class="main-sidebar">
              <?= topicSideContent(); ?>
            </div>
            <script>staticBar('.main-sidebar','454')</script>
          </div><!-- END right column col-sm-4 -->

      </div>
    </div><!-- END page-container -->

    <footer class="footer">
      <div class="page-container">
        <p class="text-muted">This is the footer</p>
      </div>
    </footer>
  </body>
</html>
