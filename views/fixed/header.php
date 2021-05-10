<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Gadget Shop Advanced</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
	<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
</head>
<body>
	<div id="header">
		<div>
			<div id="logo">
				<a href="index.php"><img src="assets/images/logo.png" alt="Logo"></a>
			</div>
			<ul id ="meni">
				<?php
				include "models/menu/showMenu.php";
				?>
            </ul>
		</div>
		<div>
			<div id="figure">
				<div>
					
						<span id="background">
							<h1>Live Music</h1>
						</span>
					</div>	
				</div>
			</div>
	</div>
	