<?php

namespace App\Entity;

use App\Repository\BookPriceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BookPriceRepository::class)]
class BookPrice {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?int $priceInclusiveEbook = null;

    #[ORM\Column(nullable: true)]
    private ?int $priceEbook = null;

    #[ORM\Column(nullable: true)]
    private ?int $priceEbookPlus = null;

    #[ORM\ManyToOne(inversedBy: 'bookPrices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Book $bookId = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function getYear(): ?int {
        return $this->year;
    }

    public function setYear(int $year): self {
        $this->year = $year;

        return $this;
    }

    public function getPriceInclusiveEbook(): ?int {
        return $this->priceInclusiveEbook;
    }

    public function setPriceInclusiveEbook(int $priceInclusiveEbook): self {
        $this->priceInclusiveEbook = $priceInclusiveEbook;

        return $this;
    }

    public function getPriceEbook(): ?int {
        return $this->priceEbook;
    }

    public function setPriceEbook(?int $priceEbook): self {
        $this->priceEbook = $priceEbook;

        return $this;
    }

    public function getPriceEbookPlus(): ?int {
        return $this->priceEbookPlus;
    }

    public function setPriceEbookPlus(?int $priceEbookPlus): self {
        $this->priceEbookPlus = $priceEbookPlus;

        return $this;
    }

    public function getBookId(): ?Book
    {
        return $this->bookId;
    }

    public function setBookId(?Book $bookId): self
    {
        $this->bookId = $bookId;

        return $this;
    }
}
