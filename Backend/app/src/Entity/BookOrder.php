<?php

namespace App\Entity;

use App\Repository\BookOrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BookOrderRepository::class)]
class BookOrder {
    #[Groups(['subject'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['subject'])]
    #[ORM\Column]
    private ?int $price = null;

    #[Groups(['subject'])]
    #[ORM\Column]
    private ?int $count = null;

    #[Groups(['subject'])]
    #[ORM\Column]
    private ?bool $ebook = null;

    #[Groups(['subject'])]
    #[ORM\Column]
    private ?bool $ebookPlus = null;

    #[Groups(['subject'])]
    #[ORM\ManyToOne(inversedBy: 'bookOrders')]
    private ?SchoolClass $schoolClassId = null;

    #[ORM\ManyToOne(inversedBy: 'bookOrders')]
    private ?Book $bookId = null;

    #[Groups(['subject'])]
    #[ORM\Column]
    private ?bool $teacherCopy = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function getPrice(): ?int {
        return $this->price;
    }

    public function setPrice(int $price): self {
        $this->price = $price;

        return $this;
    }

    public function getCount(): ?int {
        return $this->count;
    }

    public function setCount(int $count): self {
        $this->count = $count;

        return $this;
    }

    public function isEbook(): ?bool {
        return $this->ebook;
    }

    public function setEbook(bool $ebook): self {
        $this->ebook = $ebook;

        return $this;
    }

    public function isEbookPlus(): ?bool {
        return $this->ebookPlus;
    }

    public function setEbookPlus(bool $ebookPlus): self {
        $this->ebookPlus = $ebookPlus;

        return $this;
    }

    public function getSchoolClassId(): ?SchoolClass
    {
        return $this->schoolClassId;
    }

    public function setSchoolClassId(?SchoolClass $schoolClassId): self
    {
        $this->schoolClassId = $schoolClassId;

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

    public function isTeacherCopy(): ?bool {
        return $this->teacherCopy;
    }

    public function setTeacherCopy(bool $teacherCopy): self {
        $this->teacherCopy = $teacherCopy;

        return $this;
    }
}
