<?php

    session_start();
    include_once "db_functions.php";

    $msg = "";
    $product_name_err = $tag_err = $description_err = $intended_price_err = $original_price_err = $depreciation_err = $image_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        $seller_id = $_SESSION['curr_user'];
        $product_name = ppc($_POST["product_name"]);
        $tag = ppc($_POST["tag"]);
        $description = ppc($_POST["description"]);
        $intended_price = (double)ppc($_POST["intendedPrice"]);
        $original_price = (double)ppc($_POST["originalPrice"]);
        $depreciation = (int)$_POST["depreciation"];

        if (empty($product_name)){
            $product_name_err = "* Product name is required.";
        }
        if (empty($tag)){
            $tag_err = "* Tag is required.";
        }
        if (empty($description)){
            $description_err = "* Description of the product is required.";
        }
        if (empty($intended_price)){
            $intended_price_err = "* Intended price is required.";
        }
        if (empty($original_price)){
            $original_price_err = "* Original price is required.";
        }
        if (empty($depreciation)){
            $depreciation_err = "* Depreciation is required.";
        }
        if (!file_exists($_FILES['image']['tmp_name'])){
            $image_err = "* Product image is required.";
        }

        if ($product_name_err || $tag_err || $description_err || $intended_price_err || $original_price_err || $depreciation_err || $image_err){
            $msg = "* Please check your input again";
        }else {
            $upload_dir="images/".$seller_id."/";
            if(!is_dir($upload_dir)) {
                mkdir($upload_dir);
            }
            /* Get the postfix of the image */
            $postfix = substr($_FILES['image']['name'],strrpos($_FILES['image']['name'],'.'));
            /* Set the file name */
            $filename = $upload_dir.date("YmdHis").$postfix;
            /* Store the image to the server */
            if(move_uploaded_file($_FILES['image']['tmp_name'], $filename)){
                /* Get the database */
                $conn = connectDB();
                /* Set the decode */
                $sql = "INSERT INTO Sales(SellerId, ProductName, Tag, Description, Image, IntendedPrice, OriginalPrice, Depreciation) 
                        VALUES ('$seller_id', '$product_name', '$tag', '$description', '$filename', $intended_price, $original_price, $depreciation)";
                $success = $conn->query($sql);
                if ($success){
                    header("location:myproducts.php");
                    exit;
                }else{
                    echo 'Insert fail'.$conn->error;
                }

                $conn->close();
            }else{
                echo 'Store fail';
            }
        }
    }

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>BEACON - Post_Product</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="assets/css/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-primary clean-navbar" style="height: 60px; padding-top: 30px;">
        <div class="container"><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button><a class="navbar-brand text-white logo" href="index.php"><p style="font-size: larger;">BEACON</p></a>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav ml-auto"></ul>
            </div>
        </div>
    </nav>
    <main class="page post-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Post Your Product</h2>
				</div>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

					<!-- productName input -->
                    <div class="form-group">
						<label for="focusedInput">Product Name</label><span class="warning"> <?php echo $product_name_err;?></span>
						<input class="form-control item" type="text" name="product_name" placeholder="product name"/>
					</div>
					
					<!-- tag input -->
					<div class="form-group">
						<label for="focusedInput">Tag</label><span class="warning"> <?php echo $tag_err;?></span>
						<input class="form-control item" type="text" name="tag" placeholder="tag"/>
					</div>

					<!-- description confirm -->
                    <div class="form-group">
						<label for="focusedInput">Description</label> <span class="warning"><span class="warning"> <?php echo $description_err;?></span>
						<input class="form-control item" type="text" name="description" placeholder="description"/>
					</div>

					<!-- intendedPrice input -->
                    <div class="form-group">
						<label for="focusedInput">Intended Price</label><span class="warning"> <?php echo $intended_price_err;?></span>
						<input class="form-control item" type="text" name="intendedPrice" placeholder="intended price"/>
					</div>

					<!-- originalPrice input -->
                    <div class="form-group">
						<label for="focusedInput">Original Price</label> <span class="warning"> <?php echo $original_price_err;?></span>
						<input class="form-control item" type="text" name="originalPrice" placeholder="original price"/>
					</div>

					<!-- depreciation choose -->
                    <div class="form-group">
						<label for="selectError3">Depreciation</label><span class="warning"> <?php echo $depreciation_err;?></span>
						<select class="form-control" id="selectError3" name="depreciation">
							<optgroup label="Depreciation">
								<option value="9">9</option>
                                <option value="8">8</option>
                                <option value="7">7</option>
                                <option value="6">6</option>
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
							</optgroup>
						</select>
					</div>
					
					<!-- Image upload -->
                    <div class="form-group">
						<label for="focusedInput">Image</label><br/><span class="warning"> <?php echo $image_err;?></span>
						<input type="file" name="image"/><br/>
					</div>
                   

				<div class="form-group">
					<fieldset>
						<legend></legend>
					</fieldset>
				</div>

				<button class="btn btn-primary btn-block" type="submit" name="submit">Post</button>
			</form>
			
            </div>
        </section>
    </main>
	
	<footer class="page-footer dark">
        <div class="container">
            <div class="row">

                <div class="col-sm-3">
                    <div class="single-widget">
                        <h5>ABOUT US</h5>
                        <ul>
                            <span class="white-font">CS411 2020 Summer Course Project</br></span>
                            <span class="white-font">Team Geniuses</br></span>
                            <span class="white-font">Xinyi Lai: xlai7@illinois.edu</br></span>
                            <span class="white-font">Jiaqi Lou: jiaqil6@illinois.edu</br></span>
                            <span class="white-font">Hanyin Shao: hanyins2@illinois.edu</br></span>
                            <span class="white-font"> Kerui Zhu: keruiz2@illinois.edu</span>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="single-widget">
                    	<h5>INFORMATION</h5>
                        <ul>
                            <span class="white-font"><a href="#">Frequently Asked Question</a></br></span>
                            <span class="white-font"><a href="#">Terms and Condition</a></br></span>
                            <span class="white-font"><a href="#">Privacy Policy</a></br></span>
                            <span class="white-font"><a href="#">Customer Service</a></br></span>
                            <span class="white-font"><a href="#">Delivery Information</a></br></span>
                            <span class="white-font"><a href="#">Manufacturers</a></br></span>
                        </ul>
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="single-widget">
                    	<h5>CUSTOMER CARE</h5>
                        <ul>
                            <span class="white-font"><a href="#">Contact Us</a></br></span>
                            <span class="white-font"><a href="#">Sitemap</a></br></span>
                            <span class="white-font"><a href="#">Live Chat 24x7</a></br></span>
                        </ul>
                    </div>
                </div>
                
                <div class="col-sm-3">
                    <div class="single-widget-1">
                    <h5>OUR SERVICES</h5>
                        <ul>
                            <span class="white-font"><a href="#">Secure Shopping</a></br></span>
                        </ul>
                    </div>  
				</div>
				
            </div>
        </div>
	</footer>
	
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
	<script src="assets/js/theme.js"></script>
	
</body>

</html>