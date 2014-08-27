<?php
// Create the index.php file that will be served to your visitors.

	include "bountyHandler.php";
	
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
				<h1>Myriadcoin Community Bounty Board<br/></h1>
			</header>
			
			<article>
			<p> </p>
				
				<hr/>
			
				
				
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
			$content .= "<div class=\"activeBounty\"><div class=\"box\"><p>" . $bounties[$i]->getTitle() . "</p>";
			$content .= "</div><div class=\"descBox\"><p>" . $bounties[$i]->getDescription() . "</p>";
				$addressTotal = getAddressTotal($bounties[$i]->getMyrAddress());
			$content .= "</div><div class=\"box\"><center><p>" . $addressTotal . "</p></center>";
			$content .= "</div><div class=\"addressBox\"><p><a href=\"http://birdonwheels5.no-ip.org:3000/address/" . $bounties[$i]->getMyrAddress() . "\">" . $bounties[$i]->getMyrAddress() . "</a></p>";
				$donationCount = getDonationCount($bounties[$i]->getMyrAddress());
			$content .= "</div><div class=\"numberBox\"><center><p>" . $donationCount . "</p></center>";
			$content .= "</div><div class=\"box\"><p>" . $bounties[$i]->getUserName() . "</p>";
			$content .= "</div></div>";
		}
		else
		{
			$content .= "<div class=\"inActiveBounty\"><div class=\"box\"><p>" . $bounties[$i]->getTitle() . "</p>";
			$content .= "</div><div class=\"descBox\"><p>" . $bounties[$i]->getDescription() . "</p>";
				$addressTotal = getAddressTotal($bounties[$i]->getMyrAddress());
			$content .= "</div><div class=\"box\"><center><p>" . $addressTotal . "</p></center>";
			$content .= "</div><div class=\"addressBox\"><p><a href=\"http://birdonwheels5.no-ip.org:3000/address/" . $bounties[$i]->getMyrAddress() . "\">" . $bounties[$i]->getMyrAddress() . "</a></p>";
				$donationCount = getDonationCount($bounties[$i]->getMyrAddress());
			$content .= "</div><div class=\"numberBox\"><center><p>" . $donationCount . "</p></center>";
			$content .= "</div><div class=\"box\"><p>" . $bounties[$i]->getUserName() . "</p>";
			$content .= "</div></div>";
		}
	}
	
	$content .= "</article><div class=\"paddingBottom\"></div>
		     <footer>Want to show some love? Donate some MYR: MNYERWCHqrH1EkGNpF4T8o8dGB391A5jmm</footer></div>";

	$content .= "</body></html>";

	$fi = fopen("index.php", "w");
 	fwrite($fi, $content);
 	fclose($fi);

?>
