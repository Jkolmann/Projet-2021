<?php 
include('connexion.php');

//Affichage des activités
$sql1 = 'SELECT * FROM activites';
$resultat=$connexion->query($sql1);
$res1=$resultat->fetchAll(PDO::FETCH_OBJ);

//Inscription
if(isset($_POST["send"]))
{
    
    if (!empty($_POST["activite"]) && 
    !empty($_POST["nombre"]) && 
    !empty($_POST["pseudo"]) && 
    !empty($_POST["email"]) && 
    !empty($_POST["password"])&&
    !empty($_POST["password_retype"]))
      
    {
        //print_r($_POST);
        $activite=htmlspecialchars($_POST["activite"]);
        $nombre=htmlspecialchars($_POST["nombre"]);
        $pseudo=htmlspecialchars($_POST["pseudo"]);
        $email=htmlspecialchars($_POST["email"]);
        $password=htmlspecialchars($_POST["password"]);
        $password_retype = htmlspecialchars($_POST["password_retype"]);
        
        $check = $connexion->prepare('SELECT pseudo, email, password FROM utilisateurs WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row == 0){
            if($password == $password_retype){
                $password = hash('sha256', $password);
                $insert = $connexion->prepare('INSERT INTO utilisateurs(activite, nombre, pseudo, email, password) VALUES(:activite, :nombre, :pseudo, :email, :password)');
                            $insert->execute(array(
                                'activite' => $activite,
                                'nombre' => $nombre,
                                'pseudo' => $pseudo,
                                'email' => $email,
                                'password' => $password
                            ));
                header('Location:index.php?reg_err=success');
            

            }else{
                echo "<script type=\"text/javascript\">";
                echo "alert('Les mots de passes ne correspondent pas');";
                echo "window.history.back();";
                echo "</script>";
            }
        }else{
            echo "<script type=\"text/javascript\">";
            echo "alert('Adresse déjà utilisé');";
            echo "window.history.back();";
            echo "</script>";
        }

        

    }else{
        echo "<script type=\"text/javascript\">";
        echo "alert('Complétez tous les champs');";
        echo "window.history.back();";
        echo "</script>";   
    }
}
else{

}








?>




<!DOCTYPE HTML>
<!--
	Traveler by freehtml5.co
	Twitter: http://twitter.com/fh5co
	URL: http://freehtml5.co
-->
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Boat & co.</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

	
	<!-- <div class="page-inner"> -->
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="index.php">Boat & <em>co.</em></a></div>
				</div>
			</div>
			
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_2.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					

					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<h1>Bienvenue chez nous!</h1>	
						</div>
						<div class="col-md-4 col-md-push-1 animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3>Inscription</h3>
											<form action="inscription.php" method="post">
												<div class="row form-group">
													<div class="col-md-12">
													
														<select name="activite" id="activities" class="form-control">
															<option value="Aquabike">Aquabike</option>
															<option value="Aquarunning">Aquarunning</option>
															<option value="Aquabody">Aquabody</option>
															<option value="Aquapunching">Aquapunching</option>
															<option value="Aquacardioscult">Aquacardioscult</option>
															<option value="Yoga en piscine">Yoga en piscine</option>

														</select>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<input type="number" name="nombre" id="fullname" class="form-control" placeholder="Nombre de personne" require="required" autocomplete="off">
													</div>
												</div>
						
												<div class="row form-group">
													<div class="col-md-12">
														<input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Identifiant" require="required" autocomplete="off">
													</div>
												</div>
                                                <div class="row form-group">
													<div class="col-md-12">
														<input type="email" name="email" id="email" class="form-control" placeholder="Votre Email" require="required" autocomplete="off">
													</div>
												</div>
                                                <div class="row form-group">
													<div class="col-md-12">
														<input type="password" name="password" id="mdp" class="form-control" placeholder="Votre mot de passe" require="required" autocomplete="off">
													</div>
												</div>
                                                <div class="row form-group">
													<div class="col-md-12">
														<input type="password" name="password_retype" id="mdp" class="form-control" placeholder="Saisissez à nouveau votre mot de passe" require="required" autocomplete="off">
													</div>
												</div>
                                                

												<div class="row form-group">
													<div class="col-md-12">
														<input type="submit" class="btn btn-primary btn-block" value="S'inscrire" name="send">
													</div>
												</div>
											</form>	
										</div>

										
									</div>
								</div>
							</div>
						</div>
					</div>
							
					
				</div>
			</div>
		</div>
	</header>
	
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>Nos activités</h2>
					<p>Alors vous avez fait votre choix?</p>
				</div>
			</div>
			<div class="row">
			
				<div class="col-lg-4 col-md-4 col-sm-6">
				<?php foreach($res1 as $UnCour) : ?>
					<a href="images/<?=$UnCour->images ?>.jpg" class="fh5co-card-item image-popup">
						<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="images/<?=$UnCour->images ?>.jpg" alt="Image" class="img-responsive">
						</figure>
						<div class="fh5co-text">
							<h2><?=$UnCour->nom ?></h2>
							<p><?=$UnCour->description ?></p>
							<p><span class="btn btn-primary">Schedule a Trip</span></p>
						</div>
					</a>
					<?php endforeach ;?>
				</div>
					
			</div>
		</div>
	</div>
	
	


	<div class="gtco-cover gtco-cover-sm" style="background-image: url(images/img_bg_1.jpg)"  data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="gtco-container text-center">
			<div class="display-t">
				<div class="display-tc">
					<h1>Nous avons des services de haute qualité que vous aimerez sûrement!</h1>
				</div>	
			</div>
		</div>
	</div>

	
	<footer id="gtco-footer" role="contentinfo">
		<div class="gtco-container">
			<div class="row row-p	b-md">

				<div class="col-md-4">
					<div class="gtco-widget">
						<h3>A propos de nous</h3>
						<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore eos molestias quod sint ipsum possimus temporibus officia iste perspiciatis consectetur in fugiat repudiandae cum. Totam cupiditate nostrum ut neque ab?</p>
					</div>
				</div>

				<div class="col-md-3 col-md-push-1">
					<div class="gtco-widget">
						<h3>Nous contactez</h3>
						<ul class="gtco-quick-contact">
							<li><a href="#"><i class="icon-phone"></i> +1 234 567 890</a></li>
							<li><a href="#"><i class="icon-mail2"></i> info@freehtml5.co</a></li>
							<li><a href="#"><i class="icon-chat"></i> Live Chat</a></li>
						</ul>
					</div>
				</div>

			</div>

			<div class="row copyright">
				<div class="col-md-12">
					<p class="pull-left">
						<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small> 
						<small class="block">Designed by <a href="https://freehtml5.co/" target="_blank">FreeHTML5.co</a> Demo Images: <a href="http://unsplash.com/" target="_blank">Unsplash</a></small>
					</p>
					<p class="pull-right">
						<ul class="gtco-social-icons pull-right">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>

		</div>
	</footer>
	<!-- </div> -->

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>

	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>

	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	
	<!-- Datepicker -->
	<script src="js/bootstrap-datepicker.min.js"></script>
	

	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

