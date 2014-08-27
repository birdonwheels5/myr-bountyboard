<?php
// Display all bounties formatted for the home page (includes Myriadcoin address from block explorer).
	
	$fileName = "bounties.dat";
	
	$content = "";
	
	$bounties = array();
	$bounties = readBounties($fileName);
	
	$bountyCount = countBounties($fileName);
	
	$content .= "<!DOCTYPE html>
<html>

	<head>
		<meta charset=\"ISO-8859-1\">
		<title>MYR Bounty Board</title>
		<link rel=\"stylesheet\" type=\"text/css\" href=\"styles.css\" title=\"Default Styles\" media=\"screen\"/>
		<link rel=\"stylesheet\" type=\"text/css\" href=\"http://fonts.googleapis.com/css?family=Open+Sans\" title=\"Font Styles\"/>
	</head>
	
	<body>
		<center><div class=\"container\">
	
		
			<header style=\"background-color:transparent;\">
		
				<h1>Myriadcoin Community Bounty Board</h1>

			</header>
			
			<article>
				
				<hr/>
			
				<div class=\"welcome\">
					<center><p>Welcome to the <b>Myriadcoin Community Bounty Board</b>!</center><br/>
					<center><b>Total Bounties: " . $bountyCount . "</b></center><br/>
					A few things you should know before you get started...<br/>
					<ul>
						<li>The green bounties indicate that no one is currently working on them, while gray means that someone is working on it.
						<li>Please contact a moderator on our <a href=\"www.reddit.com/r/myriadcoin\">subreddit</a> if you are interested in taking up a bounty, and then again once you have completed it. You may wish to keep them in the loop with your progress.
						<li>Because of long loading times when there are numerous bounties, the list is compiled hourly. So any new (or edited) bounties will appear then.
						<li>Whenever a new bounty is added or updated, it will drop to the bottom of the page.
						<li>The block explorer may report a different amount than the amount raised for the bounty, but be assured that the amount displayed on this page will be paid out upon completion of the bounty.
					</ul>
					<center>Good luck, Bounty Hunters!</center></p>
				</div>
				
				<center><div class=\"divider\">
					<div class=\"box\">
						<p>Title</p>
					</div>
					
					<div class=\"descBox\">
						<p>Description</p>
					</div>
					
					<div class=\"box\">
						<center><p>Total MYR Raised</p></center>
					</div>
					
					<div class=\"addressBox\" style=\"font-size:initial;\">
						<p>MYR Address for Donations<p>
					</div>
					
					<div class=\"numberBox\">
						<center><p># of Donations<p></center>
					</div>
					
					<div class=\"box\">
						<p>Curator</p>
					</div>
				</div>";
	
	for($i = 1; $i <= $bountyCount; $i++)
	{
		if ((strcmp(stristr($bounties[$i]->getActive(), "true"), $bounties[$i]->getActive()) == 0))
		{
			$content .= "<div class=\"activeBounty\" style=\"color:black;\"><div class=\"box\"><p>" . $bounties[$i]->getTitle() . "</p>";
			$content .= "</div><div class=\"descBox\" style=\"color:black;\"><p>" . $bounties[$i]->getDescription() . "</p>";
				$addressTotal = getAddressTotal($bounties[$i]->getMyrAddress());
			$content .= "</div><div class=\"box\" style=\"color:black;\"><center><p>" . $addressTotal . "</p></center>";
			$content .= "</div><div class=\"addressBox\" style=\"color:black;\"><p><a href=\"http://birdonwheels5.no-ip.org:3000/address/" . $bounties[$i]->getMyrAddress() . "\">" . $bounties[$i]->getMyrAddress() . "</a></p>";
				$donationCount = getDonationCount($bounties[$i]->getMyrAddress());
			$content .= "</div><div class=\"numberBox\" style=\"color:black;\"><center><p>" . $donationCount . "</p></center>";
			$content .= "</div><div class=\"box\" style=\"color:black;\"><p>" . $bounties[$i]->getUserName() . "</p>";
			$content .= "</div></div>";
		}
		else
		{
			$content .= "<div class=\"inActiveBounty\" style=\"color:black;\"><div class=\"box\"><p>" . $bounties[$i]->getTitle() . "</p>";
			$content .= "</div><div class=\"descBox\" style=\"color:black;\"><p>" . $bounties[$i]->getDescription() . "</p>";
				$addressTotal = getAddressTotal($bounties[$i]->getMyrAddress());
			$content .= "</div><div class=\"box\" style=\"color:black;\"><center><p>" . $addressTotal . "</p></center>";
			$content .= "</div><div class=\"addressBox\" style=\"color:black;\"><p><a href=\"http://birdonwheels5.no-ip.org:3000/address/" . $bounties[$i]->getMyrAddress() . "\">" . $bounties[$i]->getMyrAddress() . "</a></p>";
				$donationCount = getDonationCount($bounties[$i]->getMyrAddress());
			$content .= "</div><div class=\"numberBox\" style=\"color:black;\"><center><p>" . $donationCount . "</p></center>";
			$content .= "</div><div class=\"box\" style=\"color:black;\"><p>" . $bounties[$i]->getUserName() . "</p>";
			$content .= "</div></div>";
		}
	}
	
	$content .= "<div class=\"paddingBottom\"></div>
		     <footer>Want to show some love? Donate some MYR: MNYERWCHqrH1EkGNpF4T8o8dGB391A5jmm</footer>";

	$fi = fopen("index.php", "w");
 	fwrite($fi, $content);
 	fclose($fi);

?>
