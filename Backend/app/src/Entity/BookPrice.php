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
    private ?int $totalPrice = null;

    #[Groups(['subject', 'bookPrice', "orderlist"])]
    #[ORM\Column]
    private ?int $priceInclusiveEbook = null;

    #[Groups(['subject', 'bookPrice', "orderlist"])]
    #[ORM\Column(nullable: true)]
    private ?int $priceEbook = null;

    #[Groups(['subject', 'bookPrice', "orderlist"])]
    #[ORM\Column(nullable: true)]
    private ?int $priceBase = null;

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

    public function getTotalPrice(): ?int {
        return $this->totalPrice;
    }

    public function setTotalPrice(int $totalPrice): self {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getPriceEbook(): ?int {
        return $this->priceEbook;
    }

    public function setPriceEbook(?int $priceEbook): self {
        $this->priceEbook = $priceEbook;

        return $this;
    }

    public function getPriceBase(): ?int {
        return $this->priceBase;
    }

    public function setPriceBase(?int $priceBase): self {
        $this->priceBase = $priceBase;

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
