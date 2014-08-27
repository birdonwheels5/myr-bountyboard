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
	
	<body link=\"#E2E2E2\" vlink=\"#ADABAB\">
		<center><div class=\"container\">
	
		
			<center><header style=\"background-color:transparent;\">
				<table>
					<tr>
						<td><img src=\"http://i.imgur.com/7JOcOBP.png\" style=\"width:120%;\"></img></td>
						<td><h1>&nbsp;	&nbsp;	Community Bounty Board</h1></td>
					</tr>
				</table>
			</header></center>
			
			<article>

				<hr/>
			
				<div class=\"welcome\">
					<center><p>Welcome to the <b>Myriadcoin Community Bounty Board</b>!</center><br/>
					<center><b>Total Bounties</b>: " . $bountyCount . "</center><br/>
					A few things to note before getting started...<br/>
					<ul>
						<li>The green bounties indicate bounties that are up for grabs, while the gray bounties are already claimed.
						<li>Please contact a moderator on our <a href=\"http://www.reddit.com/r/myriadcoin\">subreddit</a> if you are interested in taking up a bounty, and then again once you have completed it to claim your reward. They can also be found on <a href=\"http://webchat.freenode.net/?nick=myriad%7C...&channels=%23%23myriadcoin&uio=OT10cnVlJjExPTEyMyYxMj10cnVl38\"> our IRC channel</a>. You may wish to keep them in the loop with your progress.
						<li>Because of long loading times when there are numerous bounties, the list is compiled hourly. So any new (or edited) bounties will appear then.
						<li>Whenever a new bounty is added or an old one is updated, that bounty will drop to the bottom of the page. Be sure to check the bottom!
						<li>The block explorer may report a different amount than the amount raised for the bounty, but be assured that the amount displayed on this page will be paid out upon the bounty's completion.
					</ul>
					<center>Good luck, brave Bounty Hunters!</center></p>
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
			$content .= "<div class=\"activeBounty\"><div class=\"box\" style=\"text-align:left;padding-left:16px;\"><p>" . $bounties[$i]->getTitle() . "</p>";
			$content .= "</div><div class=\"descBox\" style=\"text-align:left;\"><p>" . $bounties[$i]->getDescription() . "</p>";
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
			$content .= "<div class=\"inActiveBounty\"><div class=\"box\" style=\"text-align:left;padding-left:16px;\"><p>" . $bounties[$i]->getTitle() . "</p>";
			$content .= "</div><div class=\"descBox\" style=\"text-align:left;\"><p>" . $bounties[$i]->getDescription() . "</p>";
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
