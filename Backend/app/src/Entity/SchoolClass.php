<?php

namespace App\Entity;

use App\Repository\SchoolClassRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SchoolClassRepository::class)]
class SchoolClass {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $grade = null;

    #[ORM\Column]
    private ?int $studentAmount = null;

    #[ORM\Column]
    private ?int $repAmount = null;

    #[ORM\Column]
    private ?int $usedBudget = null;

    #[ORM\Column]
    private ?int $budget = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?int $schoolForm = null;

    #[ORM\ManyToOne(inversedBy: 'schoolClasses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Department $departmentId = null;

    #[ORM\OneToMany(mappedBy: 'schoolClassId', targetEntity: BookOrder::class)]
    private Collection $bookOrders;

    public function __construct() {
        $this->bookOrders = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    public function getGrade(): ?int {
        return $this->grade;
    }

    public function setGrade(int $grade): self {
        $this->grade = $grade;

        return $this;
    }

    public function getStudentAmount(): ?int {
        return $this->studentAmount;
    }

    public function setStudentAmount(int $studentAmount): self {
        $this->studentAmount = $studentAmount;

        return $this;
    }

    public function getRepAmount(): ?int {
        return $this->repAmount;
    }

    public function setRepAmount(int $repAmount): self {
        $this->repAmount = $repAmount;

        return $this;
    }

    public function getUsedBudget(): ?int {
        return $this->usedBudget;
    }

    public function setUsedBudget(int $usedBudget): self {
        $this->usedBudget = $usedBudget;

        return $this;
    }

    public function getBudget(): ?int {
        return $this->budget;
    }

    public function setBudget(int $budget): self {
        $this->budget = $budget;

        return $this;
    }

    public function getYear(): ?int {
        return $this->year;
    }

    public function setYear(int $year): self {
        $this->year = $year;

        return $this;
    }

    public function getSchoolForm(): ?int {
        return $this->schoolForm;
    }

    public function setSchoolForm(int $schoolForm): self {
        $this->schoolForm = $schoolForm;

        return $this;
    }

    public function getDepartmentId(): ?Department {
        return $this->departmentId;
    }

    public function setDepartmentId(?Department $departmentId): self {
        $this->departmentId = $departmentId;

        return $this;
    }

    /**
     * @return Collection<int, BookOrder>
     */
    public function getBookOrders(): Collection {
        return $this->bookOrders;
    }

    public function addBookOrder(BookOrder $bookOrder): self {
        if (!$this->bookOrders->contains($bookOrder)) {
            $this->bookOrders->add($bookOrder);
            $bookOrder->setSchoolClassId($this);
        }

        return $this;
    }

    public function removeBookOrder(BookOrder $bookOrder): self {
        if ($this->bookOrders->removeElement($bookOrder)) {
            // set the owning side to null (unless already changed)
            if ($bookOrder->getSchoolClassId() === $this) {
                $bookOrder->setSchoolClassId(null);
            }
        }

        return $this;
    }
}
