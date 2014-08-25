<?php

include "Bounty.php";

function readBounties($fileName)
{
	$debugMode = true;
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
		print "Bounty: " . $bounties[$i]->getTitle() . "<br>";
		
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

function removeBounty($fileName, $par1BountyNumber)
{
	$bountyNumber = (int)$par1BountyNumber;
	$debugMode = true;
	$separator = "qpwoeiruty";
	
	$bounties = array();
	$bounties = readBounties($fileName);
	
	$lineNumber = 1;
	
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
			
			if ($lineNumber == ($bountyNumber--)) // We want the separator count to equal the bounty number
			{
				$lineNumber = $i++; // Replacing the separator count with the line count of the title
				if ($debugMode == true)
				{
					print "<br> " . $lineNumber;
				}
				
				break;
			}
			
			$lineNumber++; // Keeping track of the separators
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

 
?>
