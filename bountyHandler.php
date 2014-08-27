<?php

include "Bounty.php";

function readBounties($fileName)
{
	$debugMode = false;
	$separator = "qpwoeiruty";

	$title = "";
	$description = "";
	$myrAddress = "";
	$userName = "";
	$active = "";
	
	$index = 0;
	
	$bounties = array();
	
  $handle = fopen($fileName, "r") or print ("Error loading bounties!");
    	while (($line = fgets($handle)) !== false) 
    	{
		
		// Fetch bounty information line-by-line, construct the bounty, then add 1 to bounty count
		
		
		// Check for Enter keystrokes and concatenate new lines to the Description.
		if ((strcmp(stristr($line,"title: "), $line) != 0) or (strcmp(stristr($line,"desc: "), $line) != 0) or 
		    (strcmp(stristr($line,"addr: "), $line) != 0) or (strcmp(stristr($line,"user: "), $line) != 0) or 
		    (strcmp(stristr($line,"active: "), $line) != 0) or
		    (strcmp(stristr($line, $separator), $line) != 0))
		{
			if (strcmp(stristr($line,$description), $line) != 0 and 
			   (strcmp(stristr($line,"addr: "), $line) != 0) and 
			   (strcmp(stristr($line,"user: "), $line) != 0) and 
			   (strcmp(stristr($line,"active: "), $line) != 0) and 
			   (strcmp(stristr($line, $separator), $line) != 0))
			{
				$description = $description . "\n" . "<br>" . "\n" . $line;
			}
		}
		
		if (strcmp(stristr($line,"title: "), $line) == 0)
		{
			$title = trim(str_ireplace("title: ", "", $line));
		}
		
		if (strcmp(stristr($line,"desc: "), $line) == 0)
		{
			$description = trim(str_ireplace("desc: ", "", $line));
		}
	
		if (strcmp(stristr($line,"addr: "), $line) == 0)
		{
			$myrAddress = trim(str_ireplace("addr: ", "", $line));
		}
	
		if (strcmp(stristr($line,"user: "), $line) == 0)
		{
			$userName = trim(str_ireplace("user: ", "", $line));
		}
		
		if (strcmp(stristr($line,"active: "), $line) == 0)
		{
			$active = trim(str_ireplace("active: ", "", $line));
		}

		// Check the current line for "-" which separates bounties, and create bounties
		if (strcmp(stristr($line, $separator), $line) == 0)
		{
			// Debug info
			if ($debugMode == true)
			{
				echo $title;
    				echo "<br>";
				echo $description;
				echo "<br>";
				echo $myrAddress;
				echo "<br>";
				echo $userName;
				echo "<br>";
				echo $active;
				echo "<br>";
				echo "---------";
				echo "<br>";	
			}
			
			$index++;
			$bounty = new Bounty($title, $description, $myrAddress, $userName, $active);
			$bounties[$index] = $bounty;
		}
	}
	fclose($handle);
	return $bounties;
}

// -----------------------------------------------------------------------------------------

function countBounties($fileName)
{
  $separator = "qpwoeiruty";
  $index = 0;
	
  $handle = fopen($fileName, "r") or print ("Error loading bounties!");
    	while (($line = fgets($handle)) !== false) 
    	{
		// Count the number of $separator's in the bounties file, as that determines where the bounty ends
		if (strcmp(stristr($line, $separator), $line) == 0)
		{
			$index++;
		}
	}
	fclose($handle);
	return $index;
}

// -----------------------------------------------------------------------------------------

// Returns -1 if the title supplied cannot be found in the bounty array.
// If successful, the number of the bounty is returned (will always be > 0).
function searchBounty($fileName, $title)
{
	$separator = "qpwoeiruty";
	
	$FAILURE = -1;
	
	$bounties = array();
	$bounties = readBounties($fileName);
	
	$bountyCount = countBounties($fileName);
	
	$searchResult = $FAILURE;
	
	// Loop through the bounty array, and look for a match with $titleResult. Returns the number of the bounty in
	// the array.
	for($i = 1; $i <= $bountyCount; $i++)
	{
		if ($debugMode == true)
		{
			print "Bounty: " . $bounties[$i]->getTitle() . "<br>";
		}
		
		if ((strcmp(stristr($bounties[$i]->getTitle(), $title), $bounties[$i]->getTitle()) == 0))
		{
			if ($debugMode == true)
			{
				print "<br>Title match!<br>" . $bounties[$i]->getTitle();
			}
			
			$searchResult = $i;
		}
	}
	
	return $searchResult;
}

// -----------------------------------------------------------------------------------------

// Display a list of the titles of all the bounties, formatted in HTML.
function displayTitles($fileName)
{
	$bounties = array();
	$bounties = readBounties($fileName);
	
	$bountyCount = countBounties($fileName);
	
	for($i = 1; $i <= $bountyCount; $i++)
	{
		print $i . ") " . $bounties[$i]->getTitle() . "<br>";
	}
}

// -----------------------------------------------------------------------------------------

// A plain text version of the above function, for use in the update bounties page.
function displayBountyInfo($fileName)
{
	$bounties = array();
	$bounties = readBounties($fileName);
	
	$bountyCount = countBounties($fileName);
	
	for($i = 1; $i <= $bountyCount; $i++)
	{
		print "<b>" . $bounties[$i]->getTitle() . "</b>" . "<br>";
		print $bounties[$i]->getDescription() . "<br>";
		print $bounties[$i]->getMyrAddress() . "<br>";
		print $bounties[$i]->getUserName() . "<br>";
		print $bounties[$i]->getActive() . "<br>";
		print "<hr/>";
	}
}

// -----------------------------------------------------------------------------------------

// Create the index.php file that will be served to your visitors.
function displayBounties()
{
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
	
	<body link=\"#E2E2E2\" vlink=\"#000000\">
		<center><div class=\"container\">
	
		
			<header style=\"background-color:transparent;\">
				<table>
					<tr>
						<td><img src=\"http://i.imgur.com/7JOcOBP.png\" style=\"width:120%;\"></img></td>
						<td><h1>&nbsp;	&nbsp;	Community Bounty Board</h1></td>
					</tr>
				</table>
			</header>
			
			<article>

				<hr/>
			
				<div class=\"welcome\">
					<center><p>Welcome to the <b>Myriadcoin Community Bounty Board</b>!</center><br/>
					<center><b>Total Bounties</b>: " . $bountyCount . "</center><br/>
					A few things to note before getting started...<br/>
					<ul>
						<li>The green bounties indicate bounties that are up for grabs, while the gray bounties are already claimed.<br/>
						<li>Please contact a moderator on our <a href=\"http://www.reddit.com/r/myriadcoin\">subreddit</a> if you are interested in taking up a bounty, and then again once you have completed it to claim your reward. They can also be found on <a href=\"http://webchat.freenode.net/?nick=myriad%7C...&channels=%23%23myriadcoin&uio=OT10cnVlJjExPTEyMyYxMj10cnVl38\"> our IRC channel</a>. You may wish to keep them in the loop with your progress.<br/>
						<li>Because of long loading times when there are numerous bounties, the list is compiled hourly. So any new (or edited) bounties will appear then.<br/>
						<li>Whenever a new bounty is added or an old one is updated, that bounty will drop to the bottom of the page. Be sure to check the bottom!<br/>
						<li>The block explorer may report a different amount than the amount raised for the bounty, but be assured that the amount displayed on this page will be paid out upon the bounty's completion.<br/>
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
			$content .= "<div class=\"activeBounty\"><div class=\"box\" style=\"text-align:left;padding-left:10px;\"><p>" . $bounties[$i]->getTitle() . "</p>";
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
			$content .= "<div class=\"inActiveBounty\"><div class=\"box\" style=\"text-align:left;padding-left:10px;\"><p>" . $bounties[$i]->getTitle() . "</p>";
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
		     <footer>Bounty page by birdonwheels5. Want to show some love? Donate some MYR: MNYERWCHqrH1EkGNpF4T8o8dGB391A5jmm</footer></div>";

	$content .= "</body></html>";

	$fi = fopen("index.php", "w");
 	fwrite($fi, $content);
 	fclose($fi);
}

// -----------------------------------------------------------------------------------------

// Returns a string with the total amount of MYR every received by the supplied address.
// Not safe to cast to an int because of the "MYR" at the end of the string.
function getAddressTotal($myrAddress)
{
	// Get stream from block explorer
	$url = fopen("http://cryptap.us/myr/explorer/address/" . $myrAddress, "r");  

	// Create the array for storing the sata
	$explodedString = array();
	
	// Get the data from stream
	$fullString = stream_get_contents($url);
	
	$addressTotal = "";
	
	// Break the data up into an array
	$explodedString = explode(">", $fullString);
	
	// Clean it up (it wil always be the 21st position in the array)
	$addressTotal = str_ireplace("Received: ", "", $explodedString[21]);
	$addressTotal = str_ireplace("<br /", "", $addressTotal);
	$addressTotal = str_ireplace("MYR", "", $addressTotal);
	
	$addressTotal = (double)$addressTotal;
	$addressTotal = number_format($addressTotal, 2, '.', ',') . " MYR";
	
	return $addressTotal;
}

// -----------------------------------------------------------------------------------------

// Returns an int with the number of donations. 
function getDonationCount($myrAddress)
{
	// Get stream from block explorer
	$url = fopen("http://cryptap.us/myr/explorer/address/" . $myrAddress, "r");  

	// Create the array for storing the sata
	$explodedString = array();
	
	// Get the data from stream
	$fullString = stream_get_contents($url);
	
	$donationCount;
	
	// Break the data up into an array
	$explodedString = explode(">", $fullString);
	
	// Clean it up (it wil always be the 20th position in the array)
	$donationCount = str_ireplace("<br /", "", $explodedString[20]);
	$donationCount = str_ireplace("Transactions in: ", "", $donationCount);
	
	return $donationCount;
}

// -----------------------------------------------------------------------------------------

function removeBounty($fileName, $par1BountyNumber)
{
	$bountyNumber = (int)$par1BountyNumber;
	$debugMode = false;
	$separator = "qpwoeiruty";
	
	$bounties = array();
	$bounties = readBounties($fileName);
	
	$lineNumber = 0;
	
	$SUCCESS = 0;
	$FAILURE = 1;
	
	if ($debugMode == true)
	{
		print "<br> Getting bounty title...";
		print $bountyNumber;
	}
	
	// Get the title of the bounty we're working with
	$title = $bounties[$bountyNumber]->getTitle();
	
	if ($debugMode == true)
	{
		print "<br> Bounty title is: " . $title;
	}
	
	if ($debugMode == true)
	{
		print "<br> Opening file...";
	}
	
	// Search for the line number where the bounty's title resides
	$file = file($fileName);
	
	if ($debugMode == true)
	{
		print "<br> File Opened!";
	}
	
	// Special case for when the first bounty needs to be deleted
	if ($bountyNumber == 1)
	{
		$lineNumber = 0; // This will always be true since the bounty is at the start of the file
	}
	else
	{
	for ($i = 0; $i < count($file); $i++)
	{
		if ($debugMode == true)
		{
			print "<br> Looking for line number... Current line:  <br>" . $file[$i];
		}
		
		if ((strcmp(stristr($file[$i], $separator), $file[$i]) == 0))
		{
			if ($debugMode == true)
			{
				print "<br> Separator found";
			}
			
			if ($debugMode == true)
			{
				print "<br> " . $lineNumber;
			}
			
			$lineNumber++; // Keeping track of the separators
			
			if ($lineNumber == ($bountyNumber - 1)) // We want the separator count to equal the bounty #
			{
				$lineNumber = $i + 1; // Replacing the separator count with the line count of the title
				if ($debugMode == true)
				{
					print "<br> " . $lineNumber;
				}
				
				break;
			}
		}
		
		
	}
	}
	fclose($file);
	
	
	$lines = file($fileName);

 		$content;
		
		// If the starting line number is not 0, then read the lines up until the line
		// number into the temp file ($content)
 		if ($lineNumber != 0)
 		{
 			for ($i = 0; $i < $lineNumber; $i++)
 			{
 				$content .= $lines[$i];
 			}
 		}
 		
 		$lastLine;
 		
 		// Special case for when we remove the first bounty entry from our bounties.dat file
 		if ($lineNumber == 0)
 		{
 			for($i = 0; $i < count($lines); $i++) 
 		
 			{ 
 			
 				$content .= str_ireplace($lines[$i], "", $lines[$i]);
 				
 				if ((strcmp(stristr($lines[$i], $separator), $lines[$i]) == 0))
 				{
 					$content .= str_ireplace($lines[$i], "", $lines[$i]);
 					$lastLine = $i;
 					break;
 				}
 			}
 			
 			// Pick up reading into temp file after we've stopped changing the file's contents
 			for($i = ($lastLine + 1); $i < count($lines); $i++)
 			{
 				$content .= $lines[$i];
 			}
 		}
 		else // Same thing, just with changed separator rules for bounties that are not at line 0
 		{
 			for($i = ($lineNumber); $i < count($lines); $i++) 
 		
 			{ 
 				if ((strcmp(stristr($lines[$i], $separator), $lines[$i]) == 0))
 				{
 					$content .= str_ireplace($lines[$i], "", $lines[$i]);
 					$lastLine = $i;
 					break;
 				}
 				
 				$content .= str_ireplace($lines[$i], "", $lines[$i]);
 			}
 			
 			for($i = ($lastLine + 1); $i < count($lines); $i++)
 			{
 				$content .= $lines[$i];
 			}
 		}

 		fclose($lines);
 		
 		// Overwrite main file with temp file
 		$fi = fopen($fileName, "w");
 		fwrite($fi, $content);
 		fclose($fi);
	
	return;
}

// -----------------------------------------------------------------------------------------

?>
