<?php

namespace App\Entity;

use App\Repository\BookPriceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BookPriceRepository::class)]
class BookPrice {
    #[Groups(['subject', 'bookPrice', "orderlist"])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['subject', 'bookPrice', "orderlist"])]
    #[ORM\Column]
    private ?int $year = null;

    #[Groups(['subject', 'bookPrice', "orderlist"])]
    #[ORM\Column]
    private ?int $priceInclusiveEbook = null;

    #[Groups(['subject', 'bookPrice', "orderlist"])]
    #[ORM\Column(nullable: true)]
    private ?int $priceEbook = null;

    #[Groups(['subject', 'bookPrice', "orderlist"])]
    #[ORM\Column(nullable: true)]
    private ?int $priceBaseBook = null;

    #[Groups(["bookPrice"])]
    #[ORM\ManyToOne(inversedBy: 'bookPrices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Book $book = null;

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

    public function getPriceBaseBook(): ?int {
        return $this->priceBaseBook;
    }

    public function setPriceBaseBook(?int $priceBaseBook): self {
        $this->priceBaseBook = $priceBaseBook;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }
}
