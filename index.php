<!DOCTYPE html>
<html>

	<head>
		<meta charset="ISO-8859-1">
		<title>MYR Bounty Board</title>
		<link rel="stylesheet" type="text/css" href="styles.css" title="Default Styles" media="screen"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" title="Font Styles"/>
		<?php include "bountyHandler.php";?>
	</head>
	
	<body>
		<center><div class="container">
	
		
			<header style="background-color:transparent;">
		
				<h1>Myriadcoin Community Bounty Board</h1>

			</header>
			
			<article>
				
				<hr/>
			
				<div class="welcome">
					<center><p>Welcome to the <b>Myriadcoin Community Bounty Board</b>!</center><br/>
					A few things you should know before you get started...<br/>
					<ul>
						<li>The green bounties indicate that no one is currently working on them, while gray means that someone is working on it.
						<li>Please contact a moderator on our <a href="www.reddit.com/r/myriadcoin">subreddit</a> if you are interested in taking up a bounty, and then again once you have completed it. You may wish to keep them in the loop with your progress.
						<li>Because of long loading times when there are numerous bounties, the list is compiled hourly. So any new (or edited) bounties will appear then.
						<li>Whenever a new bounty is added or updated, it will drop to the bottom of the page.
						<li>The block explorer may report a different amount than the amount raised for the bounty, but be assured that the amount displayed on this page will be paid out upon completion of the bounty.
					</ul>
					<center>Good luck, Bounty Hunters!</center></p>
				</div>
				
				<center><div class="divider">
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
	
	displayBounties($fileName);
	?>
	
	
	</body>

</html>
