<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Model\TimeStampInterface;
use App\Repository\HobbiesRepository;

#[ORM\Entity(repositoryClass: HobbiesRepository::class)]
class Hobbies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

}
