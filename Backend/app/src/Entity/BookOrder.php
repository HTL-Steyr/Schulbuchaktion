<?php

namespace App\Entity;

use App\Repository\BookOrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BookOrderRepository::class)]
class BookOrder {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $count = null;

    #[ORM\Column]
    private ?bool $ebook = null;

    #[ORM\Column]
    private ?bool $ebookPlus = null;

    #[ORM\ManyToOne(inversedBy: 'bookOrders')]
    private ?SchoolClass $schoolClass = null;

    #[ORM\ManyToOne(inversedBy: 'bookOrders')]
    private ?Book $book = null;

    #[ORM\Column]
    private ?bool $teacherCopy = null;

    public function getId(): ?int {
        return $this->id;
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

    public function getSchoolClass(): ?SchoolClass
    {
        return $this->schoolClass;
    }

    public function setSchoolClass(?SchoolClass $schoolClass): self
    {
        $this->schoolClass = $schoolClass;

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

    public function isTeacherCopy(): ?bool {
        return $this->teacherCopy;
    }

    public function setTeacherCopy(bool $teacherCopy): self {
        $this->teacherCopy = $teacherCopy;

        return $this;
    }
}
