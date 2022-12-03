<?php

namespace App\Entity;

use App\Repository\TodoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TodoRepository::class)]
class Todo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $e_name = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(length: 255)]
    private ?string $e_description = null;

    #[ORM\Column(length: 50)]
    private ?string $priority = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $e_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $e_startdate = null;

    #[ORM\ManyToOne]
    private ?Status $fk_status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->e_name;
    }

    public function setName(string $e_name): self
    {
        $this->e_name = $e_name;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->e_description;
    }

    public function setDescription(string $e_description): self
    {
        $this->e_description = $e_description;

        return $this;
    }

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function setPriority(string $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->e_date;
    }

    public function setDate(\DateTimeInterface $e_date): self
    {
        $this->e_date = $e_date;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->e_startdate;
    }

    public function setStartDate(\DateTimeInterface $e_startdate): self
    {
        $this->e_startdate = $e_startdate;

        return $this;
    }



    public function getFkStatus(): ?Status
    {
        return $this->fk_status;
    }

    public function setFkStatus(?Status $fk_status): self // INSERT INTO users (fk_user)  VALUES  (select * from users where id = 2)
    {
        $this->fk_status = $fk_status;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
