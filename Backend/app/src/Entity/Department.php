<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
class Department {
    #[Groups(['subject', 'department', 'schoolclass'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['subject', 'department', 'schoolclass'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['subject', 'department', 'schoolclass'])]
    #[ORM\Column]
    private ?int $budget = null;

    #[Groups(['subject', 'department', 'schoolclass'])]
    #[ORM\Column]
    private ?int $usedBudget = null;

    #[Groups(['subject', 'department', 'schoolclass'])]
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $headOfDepartment = null;

    #[Groups(['department'])]
    #[ORM\OneToMany(mappedBy: 'departmentId', targetEntity: SchoolClass::class)]
    private Collection $schoolClasses;

    public function __construct() {
        $this->schoolClasses = new ArrayCollection();
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

    public function getBudget(): ?int {
        return $this->budget;
    }

    public function setBudget(int $budget): self {
        $this->budget = $budget;

        return $this;
    }

    public function getUsedBudget(): ?int {
        return $this->usedBudget;
    }

    public function setUsedBudget(int $usedBudget): self {
        $this->usedBudget = $usedBudget;

        return $this;
    }

    public function getHeadOfDepartment(): ?User {
        return $this->headOfDepartment;
    }

    public function setHeadOfDepartment(User $headOfDepartment): self {
        $this->headOfDepartment = $headOfDepartment;

        return $this;
    }

    /**
     * @return Collection<int, SchoolClass>
     */
    public function getSchoolClasses(): Collection {
        return $this->schoolClasses;
    }

    public function addSchoolClass(SchoolClass $schoolClass): self {
        if (!$this->schoolClasses->contains($schoolClass)) {
            $this->schoolClasses->add($schoolClass);
            $schoolClass->setDepartment($this);
        }

        return $this;
    }

    public function removeSchoolClass(SchoolClass $schoolClass): self {
        if ($this->schoolClasses->removeElement($schoolClass)) {
            // set the owning side to null (unless already changed)
            if ($schoolClass->getDepartment() === $this) {
                $schoolClass->setDepartment(null);
            }
        }

        return $this;
    }
}
