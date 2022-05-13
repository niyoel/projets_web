<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: ProjetRepository::class)]
#[ORM\Table(name:"projects")]
#[ORM\HasLifecycleCallbacks]

class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type:"datetime", options:["default"=> "CURRENT_TIMESTAMP"])]
    private $start_date;

    #[ORM\Column(type:"datetime", options:["default"=> "CURRENT_TIMESTAMP"])]
    private $end_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }
    #[ORM\PrePersist]                
    #[ORM\PreUpdate]    
    public function updateTimestamps()
    {
        if ($this->getEndDate() === null) {
            $this->setStartDate(new \DateTimeImmutable);
        }
        $this->setEndDate(new \DateTimeImmutable);
    }
}
