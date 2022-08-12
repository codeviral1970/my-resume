<?php

namespace App\Model;

use DateTime;
use DateTimeImmutable;

interface TimeStampInterface
{
 
    // public function getCreatedAt(): ?\DateTimeImmutable;
  
    // public function setCreatedAt(\DateTimeImmutable $createdAt);
 
    // public function getUpdatedAt(): ?\DateTimeImmutable;
  
    //public function setUpdatedAt(\DateTimeImmutable $updatedAt);

    public function getCreatedAt(): ?DateTimeImmutable;

    public function setCreatedAt(\DateTimeImmutable $createdAt): self;

    public function getUpdatedAt(): ?\DateTimeImmutable;

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self;

   
}