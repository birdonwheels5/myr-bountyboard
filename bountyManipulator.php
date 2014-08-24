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
	fclose($file);
	return $index;
}

function removeBounty($fileName, $title)
{
	$debugMode = true;
	$separator = "qpwoeiruty";
	
	$lineNumber = 0;
	
	$SUCCESS = 0;
	$FAILURE = 1;
	
  $handle = fopen($fileName, "r") or print ("Error loading bounties!");
    	while (($line = fgets($handle)) !== false) 
    	{
    		$lineNumber++;
    		
    		// Look for specified title, and grab the line count
		if (strcmp(stristr($line, $title), $line) == 0)
		{
			if ($debugMode == true)
			{
				print "<br>Title found in line: " . $line . "! Breaking loop.";
			}
			 break;
		}
	}
	fclose($handle);
	
	if ($debugMode == true)
	{
		print "<br>File closed!";
	}
	
	
	$file = new SplFileObject($fileName, 'r');
	
	if ($debugMode == true)
	{
		print "<br>SPLFileObject created!";
	}
	
	$file->seek($lineNumber);
	
	if ($debugMode == true)
	{
		print "<br>File Object skipped to line " . ($lineNumber) . " in the file!";
	}
	
	// Special case for deleting the first entry in the bounty list
	if ($lineNumber == 1)
	{
		while (!feof($fileName))
	{
		if ($debugMode == true)
		{
			print "<br>Going through the loops!";
		}
		
		if ((strcmp(stristr($file->current(), $separator), $file->current()) == 0))
		{
			//replaceLineInTextFile($fileName, $file->current(), "", $lineNumber);
			
			if ($debugMode == true)
			{
				print "<br> " . $separator . " reached!";
			}
			
			break;
		}
		
		replaceLineInTextFile($fileName, $file->current(), "", $lineNumber);
		
		if ($debugMode == true)
		{
			print "<br> Line \"" . $file->current() . "\" deleted!";
		}
		
		$file->next();
	
	}
	
	if ($debugMode == true)
	{
		print "<br>Finished deleting lines!";
	}
	}
	else
	{
	
	while (!feof($fileName))
	{
		if ($debugMode == true)
		{
			print "<br>Going through the loops!";
		}
		
		replaceLineInTextFile($fileName, $file->current(), "", $lineNumber);
		
		if ($debugMode == true)
		{
			print "<br> Line \"" . $file->current() . "\" deleted!";
		}
		
		if ((strcmp(stristr($file->current(), $separator), $file->current()) == 0))
		{
			//replaceLineInTextFile($fileName, $file->current(), "", $lineNumber);
			
			if ($debugMode == true)
			{
				print "<br> " . $separator . " reached!";
			}
			
			break;
		}
		
		$file->next();
	
	}
	
	if ($debugMode == true)
	{
		print "<br>Finished deleting lines!";
	}
	}
	
	return;
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

//Function for replacing line in text file.
 //Credit: Iiro Krankka, with changes made by birdonwheels5
 
 // $lineNumber: Specifiy line number to begin searching at
 function replaceLineInTextFile($file, $pattern, $replacement, $lineNumber) 
 {
 	if(!file_exists($file)) 
 	{ // if file doesn't exist...
 		print "The specified file doesn't seem to exist."; // ...stop executing code.
 	} 
 	else 
 	{ // if file exists...
 		$lines = file($file); // ...make new variable...
 		$f = fopen($file, "r") or print ("Error loading bounties!");
 		
 		$content; // ...and another...
 	
 		// Makes sure that only the first occurance is overwritten	
 		$replaceCount = 0;
 		
 		for($i = 0; $i < ($lineNumber - 1); $i++)
 		{
 			$content .= $lines[$i]; // content.
 		}
 	
 		for($i = $lineNumber; $i < count($lines); $i++) 
 		
 		{ // ...run through the loop...
 		
 			if ((strcmp(stristr($lines[$i], $pattern), $lines[$i]) == 0) and $replaceCount < 1)
 			{ // and
 				$content .= str_ireplace($pattern, $replacement, $lines[$i]); // get
 				$replaceCount++;
 			} 
 			else 
 			{ // the
 				$content .= $lines[$i]; // content.
 			}
 		}

 		fclose($f);
 		
 		print "<br>" . $content;

 		$fi = fopen($file, "w"); // open specified file...
 		fwrite($fi, $content); // and rewrite it's content.
 		fclose($fi); // close file.
 	}
 }
 
?>
