<?php
/**
 * Display <head> section, include all dependencies
 *
 * @param $title show page title
 * @return <head> html codes
 */
function head($title){
?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title;?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">

    <!-- Own style & js -->
    <link href="css/style.css" rel="stylesheet">
    <script src="js/frontend.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <!-- wow.js for css animations & initialization -->
    <script src="js/wow.js"></script>
    <script>new WOW().init();</script>
  </head>
<?php
}

/**
 * Display top navbar for all pages
 *
 * @param nil
 * @return top navbar html codes
 */
function navbar() {
?>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid page-container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index"><strong>LOGO</strong></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav hide-mobile">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Topics <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="topic">All topics</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-form navbar-left hide-mobile" action="search">
            <input type="text" class="nav-search" placeholder="Search anything . . .">
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="addPost" class="light-text">Share Something</a></li>
          <li><a href="#" class="light-text" data-toggle="modal" data-target="#loginModal">Login</a></li>
          <li><a href="#" class="primary-color" data-toggle="modal" data-target="#registerModal">Register</a></li>
          <li class="show-mobile"><a href="profile" class="light-text">Profile</a></li>
          <li class="show-mobile"><a href="editProfile" class="light-text">Edit Profile</a></li>
          <li class="show-mobile"><a href="index" class="light-text">Logout</a></li>

          <li class="dropdown hide-mobile">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="profile">Profile</a></li>
              <li><a href="addPost">Add Post</a></li>
              <li><a href="editProfile">Edit Profile</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="index">Logout</a></li>
            </ul>
          </li>
        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
<?php
  loginModal();
  registerModal();
}

function card() {
?>
  <div class="card">
    <div class="header">
      <div class="image">
        <a href="#"><img src="images/avatar.png"></a>
      </div>
      <div class="author-details">
        <div><a href="profile">Jess Tan</a> in <a href="topicDetails">Bipolar</a></div>
        <div class="date">12 Aug 16</div>
        <div class="views">1.2k</div>
      </div>
    </div>

    <div class="content short">
      <a href="post">
        <h4>Ryan Lochte Is the Ugly American</h4>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
      </a>
      <a href="#" class="read-more">Read more &#8594;</a>
    </div>

    <div class="footer">
      <div class="float-left">
        <a href="#" class="star-icon"></a>
        200
      </div>
      <div class="float-right">
        <a href="#">400 comments</a>
        <a href="#" class="dots-icon" data-placement="bottom" tabindex="0" role="button" data-toggle="popover" data-trigger="focus"
        data-content="
          <a href='#' title='test add link'>Report</a>
          <a href='#' title='test add link'>Share</a>
          "
        ><img src="images/dots.svg"></a>
        <script>
          $("[data-toggle=popover]").popover({html:true})
        </script>
      </div>
    </div>
  </div>
<?php
}

function suggestedCard() {
?>
  <div class="card">
    <div class="header">
      <div class="image">
        <a href="#"><img src="images/avatar.png"></a>
      </div>
      <div class="author-details">
        <div><a href="profile">Jess Tan</a> in <a href="topicDetails">Bipolar</a></div>
        <div class="date">12 Aug 16</div>
        <div class="views">1.2k</div>
      </div>
    </div>

    <div class="content short">
      <a href="post">
        <h4>Ryan Lochte Is the Ugly American</h4>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
      </a>
    </div>

    <div class="footer">
      <div class="float-left">
        <a href="#" class="star-icon"></a>
        200
      </div>
      <div class="float-right">
        <a href="#">400 comments</a>
      </div>
    </div>
    <a href="post" class="read-more-footer">Read more</a>
  </div>
<?php
}


function topicCard() {
?>
  <div class="card topic-card">
    <div class="image">
      <a href="topicDetails"><img src="images/topic-img.png" class="img-responsive"></a>
    </div>

    <div class="content short">
      <a href="topicDetails">
        <h4>Personal Growth</h4>
        <p>Keep Learning. Keep Growing.</p>
        <div class="followers">5090 Followers</div>
        <div class="posts">1.2k Posts</div>
      </a>
    </div>

    <div class="action">
      <a class="primary-line-btn">Follow Topic</a>
    </div>
  </div>
<?php
}

function cardExpand() {
?>
  <div class="card mBottom-40">
    <div class="header">
      <div class="image">
        <a href="#"><img src="images/avatar.png"></a>
      </div>
      <div class="author-details">
        <div><a href="profile">Jess Tan</a> in <a href="topicDetails">Bipolar</a></div>
        <div class="date">12 Aug 16</div>
        <div class="views">1.2k</div>
      </div>
    </div>

    <div class="content">
      <h4>Ryan Lochte Is the Ugly American</h4>
      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
      <p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>
      <p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>
    </div>

    <div class="footer">
      <div class="float-left">
        <a href="#" class="star-icon"></a>
        200
      </div>
      <div class="float-right">
        <a href="#">400 comments</a>
        <a href="#" class="dots-icon" data-placement="bottom" tabindex="0" role="button" data-toggle="popover" data-trigger="focus"
        data-content="
          <a href='#' title='test add link'>Report</a>
          <a href='#' title='test add link'>Share</a>
          "
        ><img src="images/dots.svg"></a>
        <script>
          $("[data-toggle=popover]").popover({html:true})
        </script>
      </div>
    </div>
  </div>
<?php
}

function commentCard() {
?>
  <div class="card comment-card">
    <div class="header">
      <div class="image">
        <a href="#"><img src="images/avatar.png"></a>
      </div>
      <div class="author-details">
        <div><a href="profile">Jess Tan</a></div>
        <div class="date no-after">12 Aug 16</div>
      </div>
    </div>

    <div class="content">
      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
    </div>

    <div class="footer">
      <div class="float-left">
        <a href="#" class="star-icon"></a>
        200
      </div>
      <div class="float-right">
        <a href="#" class="dots-icon" data-placement="bottom" tabindex="0" role="button" data-toggle="popover" data-trigger="focus"
        data-content="
          <a href='#' title='test add link'>Report</a>
          <a href='#' title='test add link'>Share</a>
          "
        ><img src="images/dots.svg"></a>
        <script>
          $("[data-toggle=popover]").popover({html:true})
        </script>
      </div>
    </div>
  </div>
<?php
}

function mainSideContent() {
?>
  <div class="side-content">
    <div class="content-title">
      <h4>Editor's Picks</h4>
      <a href="post">Read all &#8594;</a>
    </div>
    <a href="post" class="mini-card">
      <p>26 Things That Won’t Cure My Depression</p>
    </a>
    <a href="post" class="mini-card">
      <p>Doctors put me on 40 different meds for bipolar and depression. It almost killed me.</p>
    </a>
    <a href="post" class="mini-card">
      <p>Desperately Seeking Einstein’s Assistant</p>
    </a>
    <a href="post" class="mini-card">
      <p>How I’m Handling My Depression (Using an App)</p>
    </a>
  </div>

  <div class="side-content">
    <div class="content-title">
      <h4>Topics</h4>
      <a href="topic">See all &#8594;</a>
    </div>
    <ul>
      <li><a href="topicDetails">Bipolar</a></li>
      <li><a href="topicDetails">Relationship</a></li>
      <li><a href="topicDetails">Financial</a></li>
      <li><a href="topicDetails">Suicide</a></li>
    </ul>
  </div>
  <script>$('.mains-sidebar').affix({offset: {top: 10}});</script>
<?php
}


function topicSideContent() {
?>
  <div class="side-content">
    <div class="content-title">
      <h4>About</h4>
      <a href="#" class="follow-btn">Follow Topic</a>
    </div>
    <div class="mBottom-20">
      <p>Computer Science is the scientific approach to computation.</p>
      <p>Questions about programming should be added to Computer Programming. Questions about education or learning about computer science should be placed in Computer Science Education or Learning About Computer Science . Questions about jobs or careers in computer science should be placed in Careers in Computer Science .</p>
    </div>
    <div class="mBottom-40">
      <p>Tel: 9555 3233</p>
      <a href="#">www.askforhelp.com</a>
    </div>
    <div class="dual-hero">
      <div>
        <p class="topic-detail-title">Followers</p>
        <p class="lead">18.8k</p>
      </div>
      <div>
        <p class="topic-detail-title">Posts</p>
        <p class="lead">4300</p>
      </div>
    </div>
  </div>
  <script>$('.mains-sidebar').affix({offset: {top: 10}});</script>
<?php
}

function sideFilter() {
?>
  <div class="content-title">
    <h4>Filter</h4>
  </div>
  <a href="#" class="active">Posts<span class="badge">1.2k</span></a>
  <a href="#">Topics<span class="badge">6</span></a>
  <script>staticBar('.filter-sidebar','10');</script>
<?php
}

function loginModal() {
?>
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Welcome back</h4>
        </div>
        <div class="modal-body">
          <form action="profile">
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control">
              </div>
              <button type="submit" class="primary-line-btn">Login</button>
          </form>
        </div>
        <div class="modal-footer">
          <a href="#" class="primary-color small" data-toggle="modal" data-target="#registerModal" data-dismiss="modal">No account yet? Register here.</a>
        </div>
      </div>
    </div>
  </div>
<?php
}

function registerModal() {
?>
  <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Register</h4>
        </div>
        <div class="modal-body">
          <form action="profile">
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control">
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control">
              </div>
              <button type="submit" class="primary-line-btn">Sign up</button>
          </form>
        </div>
        <div class="modal-footer">
          <a href="#" class="primary-color small" data-toggle="modal" data-target="#loginModal" data-dismiss="modal">Already have an account? Login here.</a>
        </div>
      </div>
    </div>
  </div>
<?php
}

function scrollTopBtn() {
?>
  <a class="top-btn" onclick="scrollToTop();" href="javascript:;"></a>
<?php
}

function suggestedReading() {
?>
  <div class="suggested-container">
    <div class="page-container">
      <h4 class="hero-center">Suggested For You</h4>
      <div class="row">
        <div class="col-sm-4">
          <?php suggestedCard(); ?>
        </div>
        <div class="col-sm-4">
          <?php suggestedCard(); ?>
        </div>
        <div class="col-sm-4">
          <?php suggestedCard(); ?>
        </div>
      </div>
    </div>
  </div>
<?php
}

function footer() {
?>
  <footer class="footer">
    <div class="page-container">
      <p class="text-muted">This is the footer</p>
    </div>
  </footer>
<?php
}
?>
