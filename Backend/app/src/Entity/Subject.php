<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject {
    #[Groups(['subject'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['subject'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['subject'])]
    #[ORM\Column(length: 255)]
    private ?string $shortName = null;


    #[ORM\OneToMany(mappedBy: 'subject', targetEntity: Book::class)]
    private Collection $books;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'subjects')]
    private Collection $headOfSubject;

    public function __construct() {
        $this->books = new ArrayCollection();
        $this->headOfSubject = new ArrayCollection();
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

    public function getShortName(): ?string {
        return $this->shortName;
    }

    public function setShortName(string $shortName): self {
        $this->shortName = $shortName;

        return $this;
    }




    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection {
        return $this->books;
    }

    public function addBook(Book $book): self {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setSubject($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getSubject() === $this) {
                $book->setSubject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getHeadOfSubject(): Collection
    {
        return $this->headOfSubject;
    }

    public function addHeadOfSubject(User $headOfSubject): self
    {
        if (!$this->headOfSubject->contains($headOfSubject)) {
            $this->headOfSubject->add($headOfSubject);
        }

        return $this;
    }

    public function removeHeadOfSubject(User $headOfSubject): self
    {
        $this->headOfSubject->removeElement($headOfSubject);

        return $this;
    }
}
