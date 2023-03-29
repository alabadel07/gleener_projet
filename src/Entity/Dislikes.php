<?php

namespace App\Entity;

use App\Repository\DislikesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DislikesRepository::class)]
class Dislikes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

     #[ORM\ManyToOne(inversedBy: 'dislikes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'dislikes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Comments $comment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getComment(): ?Comments
    {
        return $this->comment;
    }

    public function setComment(?Comments $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

}
