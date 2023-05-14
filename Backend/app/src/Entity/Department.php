<?php

namespace app\src\Entity;

use app\src\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartmentRepository::class)]
class Department
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $budget = null;

    #[ORM\Column]
    private ?int $usedBudget = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $headOfDepartment = null;

    #[ORM\OneToMany(mappedBy: 'departmentId', targetEntity: SchoolClass::class)]
    private Collection $schoolClasses;

    public function __construct()
    {
        $this->schoolClasses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(int $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getUsedBudget(): ?int
    {
        return $this->usedBudget;
    }

    public function setUsedBudget(int $usedBudget): self
    {
        $this->usedBudget = $usedBudget;

        return $this;
    }

    public function getHeadOfDepartment(): ?User
    {
        return $this->headOfDepartment;
    }

    public function setHeadOfDepartment(User $headOfDepartment): self
    {
        $this->headOfDepartment = $headOfDepartment;

        return $this;
    }

    /**
     * @return Collection<int, SchoolClass>
     */
    public function getSchoolClasses(): Collection
    {
        return $this->schoolClasses;
    }

    public function addSchoolClass(SchoolClass $schoolClass): self
    {
        if (!$this->schoolClasses->contains($schoolClass)) {
            $this->schoolClasses->add($schoolClass);
            $schoolClass->setDepartmentId($this);
        }

        return $this;
    }

    public function removeSchoolClass(SchoolClass $schoolClass): self
    {
        if ($this->schoolClasses->removeElement($schoolClass)) {
            // set the owning side to null (unless already changed)
            if ($schoolClass->getDepartmentId() === $this) {
                $schoolClass->setDepartmentId(null);
            }
        }

        return $this;
    }
}
