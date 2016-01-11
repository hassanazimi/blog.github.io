<?php // REQUIRING PHPMAILER AND RECAPTCHA
require_once('PHPMailer/class.phpmailer.php');
require_once('PHPMailer/class.smtp.php');
require_once('PHPMailer/phpmailer.lang-en.php');
require_once('Recaptcha/autoload.php'); 
$message = "";
$errors  = "";
// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
if(isset($_POST["submit"])) {
	if(empty('6LeV-wwTAAAAAJnUid-hdufpXhwAz0C6ldkwK7uK') || empty('6LeV-wwTAAAAAMn-IstrMiHckVoFIm6KyfTvx8tp')) {
		$errors = "The reCaptcha API is empty. Please contact the administrators.";
	} elseif(isset($_POST['g-recaptcha-response'])) {
		$recaptcha = new \ReCaptcha\ReCaptcha('6LeV-wwTAAAAAMn-IstrMiHckVoFIm6KyfTvx8tp');
		$resp      = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
		if($resp->isSuccess()) {
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->IsHTML(TRUE);
			$mail->CharSet    = 'UTF-8';
			$mail->Host       = 'n1plcpnl0045.prod.ams1.secureserver.net';
			$mail->SMTPSecure = 'ssl';
			$mail->Port       = 465;
			$mail->SMTPAuth   = TRUE;
			$mail->Username   = 'do-not-reply@parsclick.net';
			$mail->Password   = '1365@1986Ha';
			$mail->FromName   = $_POST['name'];
			$mail->From       = 'do-not-reply@parsclick.net';
			$mail->Subject    = 'Email From: ' . $_POST['name'];
			$mail->AddAddress('hazz.azimi@gmail.com', 'Do not reply');
			$mail->Body = <<<EMAILBODY
<html><body style="font-family:Tahoma;">
<h2>The new message from amir.parsclick.net is received as below:</h2>
<p style="font-size:15px;"><br/>
Name: {$_POST["name"]}<br/>
Email: {$_POST["email"]}<br/></p><br/>
<h3>Message:</h3>
	<p>{$_POST["message"]}</p>
<hr />
</body></html>
EMAILBODY;
			$result     = $mail->Send();
			if($result) {
				$message = "Thank You! Your message has been sent.";
			} else {
				$errors = "Error in sending message!";
			}
		} else {
			foreach($resp->getErrorCodes() as $code) {
				$errors = "Please show you're not a robot! Error code: {$code}";
			}
		}
	}
} else {}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Amir Hassan Aizmi</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Hassan Azimi is based in London, United Kingdom Software Engineer and a Web Developer with the skills such as PHP, Ruby on Rails, Laravel, JavaScript, jQuery, WordPress, Joomla, CSS, HTML, Java, SQL, Node.JS, Git, GitHub, AJAX, Python, Unix, SEO and more"/>
	<meta name="keywords" content="Hassan Azimi, Amir, Software, Engineer, Web, Developer, Programmer, Application, London, UK, Freelancer, Portfolio, Web Designer, Database Administrator, "/>
	<meta name="copyright" content="hassanazimi.com">
	<meta name="language" content="en-UK"/>
	<meta name="geo.region" content="UK"/>
	<meta name="image" content="images/parsclick.svg"/>
	<!--Facebook OG Tags-->
	<meta property="og:url" content="http://www.HassanAzimi.com"/>
	<meta property="og:title" content="Hassan Aizmi -- Software Engineer - Web Developer"/>
	<meta property="og:type" content="article"/>
	<meta property="og:image" content="images/parsclick.svg"/>
	<meta property="og:description" content="Hassan Azimi is based in London, United Kingdom Software Engineer and a Web Developer with the skills such as PHP, Ruby on Rails, Laravel, JavaScript, jQuery, WordPress, Joomla, CSS, HTML, Java, SQL, Node.JS, Git, GitHub, AJAX, Python, Unix, SEO and more."/>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/prefixfree.min.js"></script>
	<link rel="shortcut icon" type="image/png" href="images/favicon.png">
</head>
<body>
<header>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#featured"><h1>Hassan Azimi <span class="subhead">Software Engineer | Web Developer</span></h1></a>
			</div><!-- navbar-header -->
			<div class="collapse navbar-collapse" id="collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="#featured">Home</a></li>
					<li><a href="#bio">Bio</a></li>
					<li><a href="#services">Services</a></li>
					<li><a href="#portfolio">Portfolio</a></li>
					<li><a href="#testimonials">Testimonials</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>        
			</div><!-- collapse navbar-collapse -->
		</div><!-- container -->
	</nav>

	<div class="carousel fade" data-ride="carousel" id="featured">

		<ol class="carousel-indicators"></ol>

		<div class="carousel-inner fullheight">
			<div class="item active"><img src="images/intro1.jpg" alt="Intro"></div>
			<div class="item"><img src="images/intro2.jpg" alt="Intro"></div>
			<div class="item"><img src="images/intro3.jpg" alt="Intro"></div>
			<div class="item"><img src="images/intro4.jpg" alt="Intro"></div>
			<div class="item"><img src="images/intro5.jpg" alt="Intro"></div>
			<div class="carousel-caption">
				<?php 
				// FUNCTION TO OUTPUT THE MESSAGE AFTER EMAIL SUBMIT ---------------------------------
				function output_message ($message="", $errors="") {
					if(!empty($message)) {
						$output = "<div class='alert alert-success alert-dismissible' role='alert'>";
						$output .= "<button type='button' class='close' data-dismiss='alert'>";
						$output .= "<span aria-hidden='true'>&times;</span>";
						$output .= "<span class='sr-only'></span>";
						$output .= "</button>";
						$output .= "<i class='fa fa-check-circle-o fa-fw fa-lg'></i> ";
						$output .= "<strong>" . htmlentities($message) . "</strong>";
						$output .= "</div>";
						return $output;
					} elseif(!empty($errors)) {
						$output = "<div class='alert alert-danger alert-dismissible' role='alert'>";
						$output .= "<button type='button' class='close' data-dismiss='alert'>";
						$output .= "<span aria-hidden='true'>&times;</span>";
						$output .= "<span class='sr-only'></span>";
						$output .= "</button>";
						$output .= "<i class='fa fa-times-circle-o fa-fw fa-lg'></i> ";
						$output .= "<strong>" . htmlentities($errors) . "</strong>";
						$output .= "</div>";
						return $output;
					} else {
						return "";
					}
				}
				// PRINTING OUT THE MESSAGE ----------
				echo output_message($message, $errors);
				?>
				<ul class="list-unstyled">
					<li id="socialmedia">
						<a title="Twitter" data-toggle="tooltip" data-placement="top" href="https://twitter.com/AmirHassanAzimi" class="fa fa-twitter fa-2x" target="_blank">&nbsp;</a>
						<a title="Facebook" data-toggle="tooltip" data-placement="top" href="https://www.facebook.com/amirhazz" class="fa fa-facebook fa-2x" target="_blank">&nbsp;</a>
						<a title="LinkedIn" data-toggle="tooltip" data-placement="top" href="https://uk.linkedin.com/in/hass0azimi" class="fa fa-linkedin fa-2x" target="_blank">&nbsp;</a>
						<a title="GitHub" data-toggle="tooltip" data-placement="top" href="https://github.com/hassanazimi" class="fa fa-github fa-2x" target="_blank">&nbsp;</a>
						<a title="Stack Overflow" data-toggle="tooltip" data-placement="top" href="http://stackoverflow.com/users/2891689/amir-azimi" class="fa fa-stack-overflow fa-2x" target="_blank">&nbsp;</a>
						<a title="YouTube" data-toggle="tooltip" data-placement="top" href="https://www.youtube.com/user/PersianComputers" class="fa fa-youtube fa-2x" target="_blank">&nbsp;</a>
						<a title="Instagram" data-toggle="tooltip" data-placement="top" href="https://instagram.com/amirhazz/" class="fa fa-instagram fa-2x" target="_blank">&nbsp;</a>
					</li>
				</ul>	
			</div><!-- carousel-caption -->
		</div><!-- carousel-inner -->

		<a class="left carousel-control" href="#featured" role="button" data-slide="prev">
	      <span class="glyphicon glyphicon-chevron-left"></span>
	    </a>
	    <a class="right carousel-control" href="#featured" role="button" data-slide="next">
	      <span class="glyphicon glyphicon-chevron-right"></span>
	    </a>
	</div><!-- featured carousel -->
</header>

<div class="main">
	<div class="page" id="bio">
		<div class="content container-fluid">
			<h2>Bio</h2>      
			<div class="row">
				<p class="col-md-5 col-md-offset-1 wow bounceInLeft" data-wow-duration="2s">I studied software engineering and have a first class degree with honours in London. I Started working with computers since the release of Unix and MS-DOS when there was not any graphical user interface operating systems such as Windows or Mac or Linux. Then Started programming since I was 16 with PHP and JavaScript, working with XHTML and early CSS to create static website. While learning, I decided to make online tutorials which led me to be an instructor in Udemy with many satisfied students. </p>
				<p class="col-md-5 wow bounceInRight" data-wow-duration="2s">I'm a software engineer mainly building web applications as a web developer. I built applications with PHP and MySQL, Ruby on Rails, Node, HTML5, CSS3, JavaScript snd AJAX. I have worked with WordPress and Joomla. A part from web I have Java, Git, Unix Bash and Regular Expression experience. I worked also with Ruby, Swift, Cocoa, Laravel. A part from work I'm also working as a freelancer so you're welcome to contact me and hire me. The crazy thing about me is I also do programming in my free time.</p>
			</div><!-- row -->
		</div><!-- content container -->
	</div><!-- mission page -->

	<div class="page" id="services">
		<div class="content container">
			<h2>Services</h2>
			<div class="row">
				<article class="service col-md-4 col-sm-6 col-xs-12 wow bounceInLeft" data-wow-delay="0.25s">
					<img class="icon" src="images/php.png" alt="Icon">
					<h3>PHP</h3>
					<p>I'm comfotrable with working with OOP PHP without using any framework.</p>
				</article>

				<article class="service col-md-4 col-sm-6 col-xs-12 wow bounceInDown">
					<img class="icon" src="images/sql.png" alt="Icon">
					<h3>MySQL</h3>
					<p>MySQL is the preferred DBMS which I've been working with along with PHP and Rails.</p>
				</article>

				<article class="service col-md-4 col-sm-6 col-xs-12 wow bounceInRight" data-wow-delay="0.5s">
					<img class="icon" src="images/ror.png" alt="Icon">
					<h3>Ruby on Rails</h3>
					<p>Started ceating apps with RoR since v4.0 and testing them with RSpec. Ruby on Rails is my favorite web framework for creating awesome apps.</p>
				</article>

				<article class="service col-md-4 col-sm-6 col-xs-12 wow bounceInLeft" data-wow-delay="0.5s">
					<img class="icon" src="images/html5.png" alt="Icon">
					<h3>HTML 5</h3>
					<p>Working with consistency in handling malformed documents, better web app features and improved element semantics of HTML 5.</p>
				</article>

				<article class="service col-md-4 col-sm-6 col-xs-12 wow bounceInUp">
					<img class="icon" src="images/css3.png" alt="Icon">
					<h3>CSS 3</h3>
					<p>Working with CSS3's transition and transform, browser prefexes, anmation, modules, text effects and 2D/3D effects.</p>
				</article>

				<article class="service col-md-4 col-sm-6 col-xs-12 wow bounceInRight" data-wow-delay="0.25s">
					<img class="icon" src="images/javascript.png" alt="Icon">
					<h3>JavaScript</h3>
					<p>I've been working with jQuery, Node.js and Angular.js even though I don't consider myswlf as a perfect front end developer but I consider JS as to be one of the essentials for web apps.</p>
				</article>

				<article class="service col-md-4 col-sm-6 col-xs-12 wow bounceInLeft" data-wow-delay="0.25s">
					<img class="icon" src="images/seo.png" alt="Icon">
					<h3>SEO</h3>
					<p>I know many different ways and I'm aware of Google's algorithms for SEO, what it considers a better website in terms of SEO and how to improve the SEO.</p>
				</article>

				<article class="service col-md-4 col-sm-6 col-xs-12 wow bounceInDown">
					<img class="icon" src="images/wordpress.png" alt="Icon">
					<h3>WordPress</h3>
					<p>WordPress is my top chosen CMS and when it comes to blogging and CMS, I know how to develop a template, make a child theme and how to modify it.</p>
				</article>

				<article class="service col-md-4 col-sm-6 col-xs-12 wow bounceInRight" data-wow-delay="0.5s">
					<img class="icon" src="images/ajax.png" alt="Icon">
					<h3>AJAX</h3>
					<p>Working with XMLHttpRequest with JavaScript ans jQuery and know how to create a web app to send and receive data asynchronously.</p>
				</article>  

			</div><!-- row -->   
		</div><!-- content container -->
	</div><!-- services page -->

	<div class="page" id="portfolio">
		<div class="container-fluid">
			<h2 id="ourportfolio">My portfolio</h2>
			<div class="row">

				<div class="doctor col-lg-4 wow slideInUp">
					<div class="row">
						<div class="photo col-xs-6 col-xs-offset-3 col-sm-3 col-sm-offset-1 col-md-2 col-md-offset-2 col-lg-4 col-lg-offset-0">
							<img class="img-circle" src="images/underground.png" alt="Underground Gym">
						</div><!-- photo -->
						<div class="info col-xs-8 col-xs-offset-2 col-sm-7 col-sm-offset-0 col-md-6 col-lg-8">
							<h3><a href="http://palestraunderground.it/" target="_blank" title="Underground Gym">Underground Gym</a></h3>
							<p>Italian Gym website, built with PHP, MySQL, AJAX, Bootstrap, jQuery and JavaScript.</p>
						</div><!-- info -->
					</div> <!-- inner row -->
				</div> <!-- doctor -->

				<div class="doctor col-lg-4 wow slideInUp" data-wow-delay="0.25s">
					<div class="row">
						<div class="photo col-xs-6 col-xs-offset-3 col-sm-3 col-sm-offset-1 col-md-2 col-md-offset-2 col-lg-4 col-lg-offset-0">
							<img class="img-circle" src="images/picadilly.png"  alt="Picadilly Theatre">
						</div><!-- photo -->
						<div class="info col-xs-8 col-xs-offset-2 col-sm-7 col-sm-offset-0 col-md-6 col-lg-8">
							<h3><a href="http://studentnet.kingston.ac.uk/~k1221692/" target="_blank" title="Picadilly Theatre">Picadilly Theatre</a></h3>
							<p>University e-Commerce project designed with Flat-UI built with PHP, MySQL, jQuery and JavaScript.</p>
						</div><!-- info -->
					</div> <!-- inner row -->
				</div> <!-- doctor -->

				<div class="doctor col-lg-4 wow slideInUp" data-wow-delay="0.5s">
					<div class="row">
						<div class="photo col-xs-6 col-xs-offset-3 col-sm-3 col-sm-offset-1 col-md-2 col-md-offset-2 col-lg-4 col-lg-offset-0">
							<img class="img-circle" src="images/printwork.png" alt="The Printworks Club">
						</div><!-- photo -->
						<div class="info col-xs-8 col-xs-offset-2 col-sm-7 col-sm-offset-0 col-md-6 col-lg-8">
							<h3><a href="http://www.theprintworksclub.com/" target="_blank" title="The Print Works Club">The Printworks Club</a></h3>
							<p>WordPress website built with custom template and membership login system.</p>
						</div><!-- info -->
					</div> <!-- inner row -->
				</div> <!-- doctor -->


			</div><!-- outer row -->
		</div><!-- container -->
	</div><!-- portfolio page -->

	<div class="page" id="testimonials">
		<div class="container-fluid">
			<h2>Testimonials</h2>
			<div class="row">
				<blockquote class="col-md-6 col-lg-3 wow rotateInDownLeft" id="janeh">
					<div class="quote">
						<span class="intro">First met him in the university and we worked on a group project basis</span>
						<span class="more"> and the most important thing I can say about Hassan is he is fanatic about programming especially the web. We worked together with a few projects and I love the fact that how passionate and up to date he is when it comes to web development and software engineering.</span>
						<span class="customer">Francesco B.</span>
					</div>
				</blockquote>

				<blockquote class="col-md-6 col-lg-3 wow rotateInDownLeft" data-wow-delay="0.25s" id="mcphersons">
					<div class="quote">
						<span class="intro">When I was looking for someone to build a great website for my fitness</span>
						<span class="more"> personal training, Hassan built a great one and suddenly I was so excited because now I had website with my contact details, blog, login system, forum, map and more. I still think I owe him because anyone could easily find me and I had many customers through this website.</span>
						<span class="customer">Kambiz S.</span>
					</div>
				</blockquote>

				<blockquote class="col-md-6 col-lg-3 wow rotateInDownRight" data-wow-delay="0.5s" id="johnb">
					<div class="quote">
						<span class="intro">As a professor of computer science, I can say Hassan was one of the</span>
						<span class="more">Top students I have ever had. He has the great problem solving skills and algorithms. He has worked with many methodologies as a programmer such as XP, Agile, Scrum, TDD and DSDM. He is so passionate that in a small group he was the one who would do everything and that became problem for us.</span>
						<span class="customer">Pushpa K.</span>
					</div>
				</blockquote>

				<blockquote class="col-md-6 col-lg-3 wow rotateInDownRight" data-wow-delay="0.75s" id="lorraines">
					<div class="quote">
						<span class="intro">Hassan and I started working with computers since we were 15</span>
						<span class="more">I remember the old MS-DOS, Unix and those old wide floppy disks that he used to call them hand fan. Good old days! He is one of the most enthusiastic persons about computing I've ever seen in my life. I went to be a web designer and he became a good developer. We worked together on some Rails and PHP projects. I can say he is planning and implementation strategies are one of the best ones among othe developers I have ever worked with.</span>
						<span class="customer">Mahdi A</span>
					</div>
				</blockquote>          
			</div>
		</div><!-- container -->
	</div><!-- testimonials page -->

	<div class="page" id="contact">
		<div class="container-fluid center">
			<h2>Contact</h2>
			<form method="POST" action="index.php" class="center">
				<div class="form-group wow zoomIn">
					<!-- <label for="name">Name</label> -->
					<input type="text" class="form-control" id="name" name="name" placeholder="Name" pattern="^[a-zA-Z ]+$" required>
				</div>
				<div class="form-group wow zoomIn">
					<!-- <label for="email">Email</label> -->
					<input type="email" class="form-control" id="email" name="email" placeholder="Email" pettern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
				</div>
				<div class="form-group wow zoomIn">
			  		<!-- <label for="message">Message</label> -->
			  		<textarea class="form-control" id="message" name="message" placeholder="Message" rows="5" required></textarea>
				</div>
				<div class="form-group g-recaptcha wow zoomIn" data-sitekey="6LeV-wwTAAAAAJnUid-hdufpXhwAz0C6ldkwK7uK"></div>
				<script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>
				<button type="submit" name="submit" class="btn btn-default btn-block wow zoomIn" style="float:right;">Submit</button>
			</form>
		</div>
	</div>

</div><!-- main -->

<footer>
	<div class="content container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<p>Copyright &copy; <?php echo date("Y"); ?> <a href="http://hassanazimi.com">Hassan Azimi</a></p>
			</div><!-- col-sm-6 -->
			<div class="col-sm-6">
				<nav class="navbar navbar-default" role="navigation">
					<ul class="nav navbar-nav navbar-right">
						<li id="scrollup" class="fa fa-arrow-circle-up fa-3x"></li>
					</ul>
				</nav>        
			</div><!-- col-sm-6 -->
		</div><!-- row -->
	</div><!-- content container -->
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/myscript.js"></script>
<script>$('div.alert').delay(7000).slideUp(300);</script>
</body>
</html>
