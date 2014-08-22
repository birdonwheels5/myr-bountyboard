<?php

function readBounties($fileName)
{
	$separator = "&-$";
	print $separator;
	
	$title = "";
	$description = "";
	$myrAddress = "";
	$userName = "";
	$active = "";
	
	$index = 0;
	
  $handle = fopen($fileName, "r") or print ("Error loading bounties!");
    	while (($line = fgets($handle)) !== false) 
    	{
		
		// Fetch bounty information line-by-line, construct the bounty, then add 1 to bounty count
		
		
		// Check for Enter keystrokes and concatenate new lines to the Description.
		if ((strcmp(stristr($line,"title: "), $line) != 0) or (strcmp(stristr($line,"desc: "), $line) != 0) or 
		    (strcmp(stristr($line,"addr: "), $line) != 0) or (strcmp(stristr($line,"user: "), $line) != 0) or 
		    (strcmp(stristr($line,"active: "), $line) != 0) or
		    (strcmp(stristr($line,"-"), $line) != 0))
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
			//$array[index] = new bounty($title, $description, $myrAddress, $userName, $active);
		}
	}
	fclose($file);
	//return $bounties;
	return;
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
?>

// ---------------------------
<?php

class Bounty
{
  private $title = "";
  private $description = "";
  private $myrAddress = "";
  private $userName = "";
  private $active = "";
  
  
  
  function __construct($par1Title, $par1Description, $par1MyrAddress, $par1UserName, $par1Active)
  {
    $this->title = $par1Title;
    $this->description = $par1Description;
    $this->myrAddress = $par1MyrAddress;
    $this->userName = $par1UserName;
    $this->active = $par1Active;
    

    /*setTitle($par1Title);
    setDescription($par1Description);
    setMyrAddress($par1MyrAddress);
    setUserName($par1UserName);
    setActive($par1Active);*/
  }
  
  
  
  /*function setTitle($newTitle)
  {
    $this->$title = $newTitle;
  }
  
  function setDescription($newDescription)
  {
    $this->$description = $newDescription;
  }
  
  function setMyrAddress($newMyrAddress)
  {
    $this->$myrAddress = $newMyrAddress;
  }
  
  function setUserName($newUserName)
  {
    $this->$userName = $newUserName;
  }
  
  function setActive($newActive)
  {
    $this->$active = $newActive;
  }*/
  
  
  
  function getTitle()
  {
    return $this->title;
  }
  
  function getDescription()
  {
    return $this->description;
  }
  
  function getMyrAddress()
  {
    return $this->myrAddress;
  }
  
  function getUserName()
  {
    return $this->userName;
  }
  
  function getActive()
  {
    return $this->active;
  }
  
  
}


?>
