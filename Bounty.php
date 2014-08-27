<?php

// Before you yell at me, I know the fields are not encapsulated. I was having issues getting the object to work, and 
// the only way I got it working was without encapsulation. After all, the validation is done in the forms
// so it shouldn't be too big of a deal.

// This class is used for neatly storing the bounty data in memory so we can manipulate it after reading from file.
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
  }
  
  
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
