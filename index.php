<?php
    session_start();
    $curr_user = $_SESSION['curr_user'];
?>

<!DOCTYPE HTML>

<html lang="en-US">

<head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-173456413-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-173456413-1');
    </script>


	<meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Beacon - Main</title>

	<!-- Latest compiled and minified CSS -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<!-- Google Font -->

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Raleway:400,300,500,700,600' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" type="text/css">

    <!-- Theme Stylesheet -->

    <link rel="stylesheet" href="css/style-main.css">

    <link rel="stylesheet" href="css/responsive.css">

    <script src="search.js"></script>

</head>

<body onload="load_related('', 'Sales', '','','')">

    <div class="top-bar">

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <a class="brand" href="index.php"><span class="webname" href="index.php">BEACON</span></a>

                </div>

                <div class="col-md-6">

                    <div class="action pull-right">

                        <ul>

                        <?php
                            if ($curr_user) {
                                echo '<li><a href="myprofile.php"><i class="fa fa-user"></i> '.$curr_user.'</a></li>';
                            }else{
                                echo '<li><a href="login.php"><i class="fa fa-user"></i> Login</a></li>';
                            }
                        ?>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="header">

        <div class="container">

            <div class="row">

                <span class="logo">B E A C O N</span>
            
            </div>

            <div class="row">

                <div class="col-md-3 col-sm-4">

                </div>

                <div class="col-md-7 col-sm-5">

                    <div class="search-form-main">

                        <form class="navbar-form" role="search">

                            <select id="choosedb" class="form-control">

                                <option selected="selected" value="Sales">Product</option>

                                <option value="Requests">Request</option>

                            </select>

                            <div class="form-group">

                                <input id="hiddenText" type="text" style="display:none" />

                                <input type="text"  onkeydown="entersearch()" id="search_box" class="form-control" placeholder="What do you need..."/>

                            </div>

                            <button type="button" class="btn" onclick="jump_to_search()"><i class="fa fa-search"></i></button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        <img src="images/background.png" height="400px">

    </div>

    <div class="navigation">

        <nav class="navbar navbar-theme">

          <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header">

              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">

                <span class="sr-only">Menu</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

              </button>

            </div>

            <div class="shop-category nav navbar-nav navbar-left">

                <!-- Single button -->

                <div class="btn-group">

                  <button type="button" class="btn btn-shop-category dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    Shop By Category <span class="caret"></span>

                  </button>

                  <ul class="dropdown-menu">

                    <li><a href="search.php?choosedb=Sales&tag=textbook">textbook</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=test prep">test prep</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=otherbooks">otherbooks</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=toys/games">toys/games</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=electronics">electronics</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=accessories">accessories</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=daily necessity">daily necessity</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=sports">sports</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=stationery">stationery</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=furniture">furniture</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=tools">tools</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=food">food</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=makeup/personal care">makeup/personal care</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=clothing">clothing</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=jewelry">jewelry</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=sublease">sublease</a></li>
                    <li><a href="search.php?choosedb=Sales&tag=other">other</a></li>

                    <li role="separator" class="divider"></li>

                    <li><a href="">Brand New</a></li>

                    <li><a href="">Used</a></li>

                  </ul>

                </div>

            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="navbar">

              <ul class="nav navbar-nav navbar-right">

                <li><a href="index.php">Home</a></li>

                <li><a href="#">Popular</a></li>

                <li><a href="#">Recent</a></li>

                <li><a href="#">Features</a></li>

                <li><a href="#bottom_info">About Us</a></li>

                <li><a href="#">Contact Us</a></li>

              </ul>

            </div><!-- /.navbar-collapse -->

          </div><!-- /.container-fluid -->

        </nav>

    </div>

    <div class="slider">

        <div class="container">

            <div class="row">

                <div class="col-md-8 col-sm-8">

                    <div class="slider big-slider">

                        <div id="featured" class="carousel slide" data-ride="carousel">

                          <!-- Indicators -->

                          <ol class="carousel-indicators">

                            <li data-target="#featured" data-slide-to="0" class="active"></li>

                          </ol>



                          <!-- Wrapper for slides -->

                          <div class="carousel-inner" role="listbox">

                            <div class="item active" style="background-image:url('images/slider-1.jpg')">

                               <div class="carousel-caption">

                                    <h4>Save up to 50%</h4>

                                    <h2 class="raleway">New semester <span>2020 Fall</span></h2>

                                    <a onclick="jump_to_search()" class="btn btn-theme">Shop Now</a>

                                </div>

                            </div>

                          </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 col-sm-4">

                    <a href="<?php echo $curr_user?'post_product.php':'login.php';?>" class="btn btn-post1">Post Your Product</a>

                    <a href="<?php echo $curr_user?'post_request.php':'login.php';?>" class="btn btn-post2">Post Your Request</a>

                </div>

            </div>

        </div>

    </div>

    

    <div class="shopping-process text-center">

        <div class="container">

            <div class="row">

                <div class="col-md-3 col-sm-3">

                   <div class="single-process">

                        <i class="fa fa-check"></i>

                        <h3>Choose a Product</h3>

                        <p> </p>

                    </div>

                </div>

                <div class="col-md-3 col-sm-3">

                   <div class="single-process">

                        <i class="fa fa-comment"></i>

                        <h3>Chat With Seller</h3>

                        <p> </p>

                    </div>

                </div>

                <div class="col-md-3 col-sm-3">

                   <div class="single-process">

                        <i class="fa fa-money"></i>

                        <h3>Make a Deal</h3>

                        <p> </p>

                    </div>

                </div>

                <div class="col-md-3 col-sm-3">

                   <div class="single-process">

                        <i class="fa fa-dashcube"></i>

                        <h3>Enjoy your Purchase</h3>

                        <p> </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="blog">

        <div class="container">

            <div class="row">

                <div class="blog-title">

                    <h2 class="pull-left text-left">Most Recent Post</h2>

                    <a onclick="jump_to_search()" class="pull-right text-right">More Post <i class="fa fa-long-arrow-right"></i></a>

                </div>

                <div class="clearfix" id="related"></div>

                <!-- <div class="col-md-4 col-sm-4">

                    <div class="single-post">

                        <div class="post-inner">

                            <div class="post-thumbnail">

                                <img src="images/post-1.jpg" alt="">

                                <div class="date">10<br> July</div>

                                <a href="single-product.php?SaleId=" class="read-more raleway">Read More <i class="fa fa-long-arrow-right"></i>

                                </a>

                            </div>

                            <h4 class="post-title">iPad Pro with Keyboard</h4>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 col-sm-4">

                   <div class="single-post">

                        <div class="post-inner">

                            <div class="post-thumbnail">

                                <img src="images/post-2.jpg" alt="">

                                <div class="date">10<br> July</div>

                                <a href="" class="read-more raleway">Read More <i class="fa fa-long-arrow-right"></i>

                                </a>

                            </div>

                            <h4 class="post-title">Decorative flower</h4>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 col-sm-4">

                    <div class="single-post">

                        <div class="post-inner">

                            <div class="post-thumbnail">

                                <img src="images/post-3.jpg" alt="">

                                <div class="date">10<br> July</div>

                                <a href="" class="read-more raleway">Read More <i class="fa fa-long-arrow-right"></i>

                                </a>

                            </div>

                            <h4 class="post-title">Kim Jones’ Dior Homme B23 High-Top</h4>

                        </div>

                    </div>

                </div> -->

            </div>

        </div>

    </div>

    <div class="footer">

        <div class="container" id="bottom_info">

            <a href="#"></a>

            <div class="row">

                <div class="col-md-3 col-sm-3">

                    <div class="single-widget">

                        <h2 class="widget-title">About Us</h2>

                        <div class="widget-inner">

                            <p>CS411 2020 Summer Course Project </p>

                            <p>Team Geniuses</p>

                            <p>Xinyi Lai: xlai7@illinois.edu </p>

                            <p>Jiaqi Lou: jiaqil6@illinois.edu </p>

                            <p>Hanyin Shao: hanyins2@illinois.edu </p>

                            <p>Kerui Zhu: keruiz2@illinois.edu </p>

                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-3">

                    <div class="single-widget">

                        <h2 class="widget-title">Information</h2>

                        <div class="widget-inner">

                            <ul>

                                <li><a href="">Frequently Asked Question</a></li>

                                <li><a href="">Terms and Condition</a></li>

                                <li><a href="">Privacy Policy</a></li>

                                <li><a href="">Customer Service</a></li>

                                <li><a href="">Delivery Information</a></li>

                                <li><a href="">Manufacturers</a></li>

                            </ul>

                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-3">

                    <div class="single-widget">

                        <h2 class="widget-title">Customer Care</h2>

                        <div class="widget-inner">

                            <ul>

                                <li><a href="">Contact Us</a></li>

                                <li><a href="">Sitemap</a></li>

                                <li><a href="">Live Chat 24x7</a></li>

                            </ul>

                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-3">

                    <div class="single-widget">

                        <h2 class="widget-title">Our Services</h2>

                        <div class="widget-inner">

                            <ul>

                                <li><a href="">Secure Shopping</a></li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>
            
        </div>

    </div>


	<!-- jQuery Library -->

	<script src="js/jquery.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<!-- Script -->

	<script src="js/script.js"></script>

</body>

</html>