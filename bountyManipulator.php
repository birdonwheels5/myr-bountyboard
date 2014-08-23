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
			$title = str_ireplace("title: ", "", $line);
		}
		
		if (strcmp(stristr($line,"desc: "), $line) == 0)
		{
			$description = str_ireplace("desc: ", "", $line);
		}
	
		if (strcmp(stristr($line,"addr: "), $line) == 0)
		{
			$myrAddress = str_ireplace("addr: ", "", $line);
		}
	
		if (strcmp(stristr($line,"user: "), $line) == 0)
		{
			$userName = str_ireplace("user: ", "", $line);
		}
		
		if (strcmp(stristr($line,"active: "), $line) == 0)
		{
			$active = str_ireplace("active: ", "", $line);
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
	fclose($file);
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
	return index;
}

function removeBounty($fileName, $title)
{
	$separator = "qpwoeiruty";
	
	$lineNumber = 0;
	
	$SUCCESS = 0;
	$FAILURE = 1;
	
  $handle = fopen($fileName, "r") or print ("Error loading bounties!");
    	while (($line = fgets($handle)) !== false) 
    	{
    		$lineNumber++;
    		
    		// Look for specified title and delete it, along with all lines up until the next separator sign
		if (strcmp(stristr($line, $title), $line) == 0)
		{
			 print $line;
			 break;
		}
	}
	fclose($file);
	
	$file = new SplFileObject($fileName, 'r');
	
	$file->seek($lineNumber - 1);
	
	while (!feof($fileName))
	{
		replaceLineInTextFile($fileName, $file->current(), "");
		print "<br> Line deleted!";
		$file->next();
		
		if ((strcmp(stristr($file->current(), $separator), $file->current()) == 0))
		{
			replaceLineInTextFile($fileName, $separator, "");
			print "<br> " . $separator . " reached and deleted!";
			break;
		}
	}
	
	return $code;
}

function searchBounty($fileName, $title)
{
	$separator = "qpwoeiruty";
	
	$FAILURE = -1;
	
	$titleResult = "";
	
  $handle = fopen($fileName, "r") or print ("Error loading bounties!");
    	while (($line = fgets($handle)) !== false) 
    	{

    		// Look for specified title and store it in memory
		if (strcmp(stristr($line, $title), $line) == 0)
		{
			 $titleResult = str_ireplace("title: ", "", $line);
			 break;
		}
	}
	fclose($file);
	
	$bounties = array();
	$bounties = readBounties($fileName);
	
	$bountyCount = countBounties($fileName);
	
	$searchResult = $FAILURE;
	
	// Loop through the bounty array, and look for a match with $titleResult. Returns the number of the bounty in
	// the array.
	for($i = 1; $i <= $bountyCount; $i++)
	{
		if ((strcmp(stristr($bounties[$i]->getTitle(), $titleResult), $bounties[$i]->getTitle()) == 0))
		{
			$searchResult = $i;
		}
	}
	
	return $bountyCount;
}

//Function for replacing line in text file.
 //Credit: Iiro Krankka
 function replaceLineInTextFile($file, $pattern, $replacement) {
 if(!file_exists($file)) { // if file doesn't exist...
 print "The specified file doesn't seem to exist."; // ...stop executing code.
 } else { // if file exists...
 $f = file($file); // ...make new variable...
 $content; // ...and another...

 for($i = 0; $i < count($f); $i++) { // ...run through the loop...
 if(preg_match("/" . $pattern . "/", $f[$i])) { // and
 $content .= $replacement; // get
 } else { // the
 $content .= $f[$i]; // content.
 }
 }

 $fi = fopen($file, "w"); // open specified file...
 fwrite($fi, $content); // and rewrite it's content.
 fclose($fi); // close file.
 }
 
 }
?>
