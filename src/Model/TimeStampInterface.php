<?php

namespace App\Model;

use DateTimeInterface;


interface TimeStampInterface
{
    // public function getCreatedAt(): ?\DateTimeInterface;
  
    // public function setCreatedAt(\DateTimeInterface $createdAt);
 
    // public function getUpdatedAt(): ?\DateTimeInterface;
  
    // public function setUpdatedAt(\DateTimeInterface $updatedAt);

     public function getCreatedAt(): ?\DateTimeInterface;

    public function setCreatedAt(\DateTimeInterface $createdAt): self;

    public function getUpdatedAt(): ?\DateTimeInterface;

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self;

   
}