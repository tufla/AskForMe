<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			AskForMe :: <?php echo $title_for_layout?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1"/> 
		<?php
		echo $this->Html->meta('icon');

//		echo $this->Html->css('960');
		echo $this->Html->css('http://code.jquery.com/mobile/latest/jquery.mobile.min.css');

		echo $this->Html->script('http://code.jquery.com/jquery.min.js');
		echo $this->Html->script('scripts');
		echo $this->Html->script('http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js');

		echo $scripts_for_layout;
		?>

		<link href='http://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css'/>
		<link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'/>
		<!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
		<!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
	</head>
<body>

<!-- If you'd like some sort of menu to
show up on all of your views, include it here -->
<div data-role="page">

	<div data-role="header">
		<h1>AskForMe</h1>
		<div id="menu"></div>
	</div><!-- /header -->

	<div data-role="content">	
		<?php echo $content_for_layout ?>		
	</div><!-- /content -->

</div>
<div id="footer"></div>

</body>
</html>