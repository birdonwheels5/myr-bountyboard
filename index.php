<!DOCTYPE html>
<html>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Portal Home</title>
		<link rel="stylesheet" type="text/css" href="styles.css" title="Default Styles" media="screen"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" title="Font Styles"/>
		<?php include "bountyHandler.php";?>
	</head>
	
	<body>
		<center><div class="container">
	
		
			<header style="color:white;">
		
				<h1>Myriadcoin Community Bounty Board</h1>
				
			</header>
			
			<article>
			
					<p> </p>
				
				<div class="divider">
					<div class="box">
						<p>Title</p>
					</div>
					
					<div class="descBox">
						<p>Description</p>
					</div>
					
					<div class="box">
						<center><p>Total MYR Raised</p></center>
					</div>
					
					<div class="addressBox" style="font-size:initial;">
						<p>MYR Address for Donations<p>
					</div>
					
					<div class="numberBox">
						<center><p># of Donations<p></center>
					</div>
					
					<div class="box">
						<p>Curator</p>
					</div>
				</div>

	<?php
	
	$fileName = "bounties.dat";
	
	// With this, you can pull any aspect of a bounty's data and display it.
	$bounties = array();
	$bounties = readBounties($fileName);
	
	displayBounties($fileName);
	?>
	
	
	</body>

</html>
