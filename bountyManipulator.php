<?php

include "Bounty.php";

function readBounties($fileName)
{
	$debugMode = true;
	$separator = "&-$";

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
  $separator = "&-$";
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
	$separator = "&-$";

	$title = "";
	$description = "";
	$myrAddress = "";
	$userName = "";
	$active = "";
	
	$index = 0;
	
	$SUCCESS = 0;
	$FAILURE = 1;
	
  $handle = fopen($fileName, "w") or print ("Error loading bounties!");
    	while (($line = fgets($handle)) !== false) 
    	{
    		// Look for specified title and delete it, along with all lines up until the next separator sign
		if (strcmp(stristr($line, $title), $line) == 0)
		{
			 if (fwrite($line, "") == false)
			 {
			 	print "Title overwrite failed!";
			 }
			 else
			 {
			 	print "Title overwrite successful";
			 }
		}
		else
		{
			print "Bounty not found!"; // change to error code
			break;
		}
		
		if ((strcmp(stristr($line, $separator), $line) != 0))
		{
			if (fwrite($line, "") == false)
			 {
			 	print "Line overwrite failed!";
			 }
			 else
			 {
			 	print "Line overwrite successful";
			 }
		}
		else if ((strcmp(stristr($line, $separator), $line) == 0))
		{
			break;
		}
	}
	fclose($file);
	return $code;
}

function replaceInFile($what, $with, $fileName){
    $buffer = "";
    $fp = file($fileName);
    foreach($fp as $line){
        $buffer .= preg_replace("|".$what."[A-Za-z_.]*|", $what.$with, $line);
    }
    fclose($fp);
    echo $buffer;
    file_put_contents($fileName, $buffer);
}
?>
