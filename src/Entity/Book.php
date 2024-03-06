<?php

namespace App\Entity;

use App\ApiResource\Book as ApiResourceBook;
use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Mapper\Attributes\Map;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[Map(to: ApiResourceBook::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }
}
