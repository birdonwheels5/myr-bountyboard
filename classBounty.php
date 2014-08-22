<?php

class bounty
{
  var $title = "";
  var $description = "";
  var $myrAddress = "";
  var $userName = "";
  var $active = "";
  
  
  
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
