<?php

namespace App\Entity;

use App\Repository\ExperienceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExperienceRepository::class)]
class Experience
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $enterpriseName = null;

    #[ORM\Column(length: 255)]
    private ?string $jobName = null;

    #[ORM\Column(length: 255)]
    private ?string $jobTime = null;

    #[ORM\OneToMany(mappedBy: 'experience', targetEntity: ExperienceItem::class)]
    private Collection $experienceItems;

    public function __construct()
    {
        $this->experienceItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnterpriseName(): ?string
    {
        return $this->enterpriseName;
    }

    public function setEnterpriseName(string $enterpriseName): self
    {
        $this->enterpriseName = $enterpriseName;

        return $this;
    }

    public function getJobName(): ?string
    {
        return $this->jobName;
    }

    public function setJobName(string $jobName): self
    {
        $this->jobName = $jobName;

        return $this;
    }

    public function getJobTime(): ?string
    {
        return $this->jobTime;
    }

    public function setJobTime(string $jobTime): self
    {
        $this->jobTime = $jobTime;

        return $this;
    }

    /**
     * @return Collection<int, ExperienceItem>
     */
    public function getExperienceItems(): Collection
    {
        return $this->experienceItems;
    }

    public function addExperienceItem(ExperienceItem $experienceItem): self
    {
        if (!$this->experienceItems->contains($experienceItem)) {
            $this->experienceItems->add($experienceItem);
            $experienceItem->setExperience($this);
        }

        return $this;
    }

    public function removeExperienceItem(ExperienceItem $experienceItem): self
    {
        if ($this->experienceItems->removeElement($experienceItem)) {
            // set the owning side to null (unless already changed)
            if ($experienceItem->getExperience() === $this) {
                $experienceItem->setExperience(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
      return $this->enterpriseName;
    }
}
