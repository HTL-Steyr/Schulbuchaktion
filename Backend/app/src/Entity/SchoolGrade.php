<?php

namespace App\Entity;

use App\Repository\SchoolGradeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SchoolGradeRepository::class)]
class SchoolGrade {
    #[Groups(['subject'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['subject'])]
    #[ORM\Column]
    private ?int $grade = null;

    #[ORM\ManyToOne(inversedBy: 'schoolGrades')]
    private ?Book $bookId = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function getGrade(): ?int {
        return $this->grade;
    }

    public function setGrade(int $grade): self {
        $this->grade = $grade;

        return $this;
    }

    public function getBookId(): ?Book {
        return $this->bookId;
    }

    public function setBookId(?Book $bookId): self {
        $this->bookId = $bookId;

        return $this;
    }
}
