<?php

namespace App\Entity;

use App\Repository\PublisherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PublisherRepository::class)]
class Publisher {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column]
    private ?int $publisherNumber = null;
    
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'publisherId', targetEntity: Book::class)]
    private Collection $books;

    public function __construct() {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getPublisherNumber(): ?int {
        return $this->publisherNumber;
    }

    public function setPublisherNumber(int $publisherNumber): self {
        $this->publisherNumber = $publisherNumber;

        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

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
            $book->setPublisher($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getPublisher() === $this) {
                $book->setPublisher(null);
            }
        }

        return $this;
    }
}
