<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $bookNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $shortTitle = null;

    #[ORM\Column]
    private ?int $listType = null;

    #[ORM\Column]
    private ?int $schoolForm = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $info = null;

    #[ORM\Column]
    private ?bool $ebook = null;

    #[ORM\Column]
    private ?bool $ebookPlus = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    private ?Subject $subjectId = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    private ?Publisher $publisherId = null;

    #[ORM\OneToMany(mappedBy: 'bookId', targetEntity: BookOrder::class)]
    private Collection $bookOrders;

    #[ORM\OneToMany(mappedBy: 'bookId', targetEntity: SchoolGrade::class)]
    private Collection $schoolGrades;

    #[ORM\OneToMany(mappedBy: 'bookId', targetEntity: BookPrice::class)]
    private Collection $bookPrices;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'childBooks')]
    private ?self $mainBookId = null;

    #[ORM\OneToMany(mappedBy: 'mainBookId', targetEntity: self::class)]
    private Collection $childBooks;

    public function __construct() {
        $this->bookOrders = new ArrayCollection();
        $this->schoolGrades = new ArrayCollection();
        $this->bookPrices = new ArrayCollection();
        $this->childBooks = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getBookNumber(): ?int {
        return $this->bookNumber;
    }

    public function setBookNumber(int $bookNumber): self {
        $this->bookNumber = $bookNumber;

        return $this;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(string $title): self {
        $this->title = $title;

        return $this;
    }

    public function getShortTitle(): ?string {
        return $this->shortTitle;
    }

    public function setShortTitle(string $shortTitle): self {
        $this->shortTitle = $shortTitle;

        return $this;
    }

    public function getListType(): ?int {
        return $this->listType;
    }

    public function setListType(int $listType): self {
        $this->listType = $listType;

        return $this;
    }

    public function getSchoolForm(): ?int {
        return $this->schoolForm;
    }

    public function setSchoolForm(int $schoolForm): self {
        $this->schoolForm = $schoolForm;

        return $this;
    }

    public function getInfo(): ?string {
        return $this->info;
    }

    public function setInfo(?string $info): self {
        $this->info = $info;

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

    public function getSubjectId(): ?Subject
    {
        return $this->subjectId;
    }

    public function setSubjectId(?Subject $subjectId): self
    {
        $this->subjectId = $subjectId;

        return $this;
    }

    public function getPublisherId(): ?Publisher
    {
        return $this->publisherId;
    }

    public function setPublisherId(?Publisher $publisherId): self
    {
        $this->publisherId = $publisherId;

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
            $bookOrder->setBookId($this);
        }

        return $this;
    }

    public function removeBookOrder(BookOrder $bookOrder): self {
        if ($this->bookOrders->removeElement($bookOrder)) {
            // set the owning side to null (unless already changed)
            if ($bookOrder->getBookId() === $this) {
                $bookOrder->setBookId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SchoolGrade>
     */
    public function getSchoolGrades(): Collection {
        return $this->schoolGrades;
    }

    public function addSchoolGrade(SchoolGrade $schoolGrade): self {
        if (!$this->schoolGrades->contains($schoolGrade)) {
            $this->schoolGrades->add($schoolGrade);
            $schoolGrade->setBookId($this);
        }

        return $this;
    }

    public function removeSchoolGrade(SchoolGrade $schoolGrade): self {
        if ($this->schoolGrades->removeElement($schoolGrade)) {
            // set the owning side to null (unless already changed)
            if ($schoolGrade->getBookId() === $this) {
                $schoolGrade->setBookId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BookPrice>
     */
    public function getBookPrices(): Collection {
        return $this->bookPrices;
    }

    public function addBookPrice(BookPrice $bookPrice): self {
        if (!$this->bookPrices->contains($bookPrice)) {
            $this->bookPrices->add($bookPrice);
            $bookPrice->setBookId($this);
        }

        return $this;
    }

    public function removeBookPrice(BookPrice $bookPrice): self {
        if ($this->bookPrices->removeElement($bookPrice)) {
            // set the owning side to null (unless already changed)
            if ($bookPrice->getBookId() === $this) {
                $bookPrice->setBookId(null);
            }
        }

        return $this;
    }

    public function getMainBookId(): ?self
    {
        return $this->mainBookId;
    }

    public function setMainBookId(?self $mainBookId): self
    {
        $this->mainBookId = $mainBookId;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getChildBooks(): Collection {
        return $this->childBooks;
    }

    public function addChildBook(self $childBook): self {
        if (!$this->childBooks->contains($childBook)) {
            $this->childBooks->add($childBook);
            $childBook->setMainBookId($this);
        }

        return $this;
    }

    public function removeChildBook(self $childBook): self {
        if ($this->childBooks->removeElement($childBook)) {
            // set the owning side to null (unless already changed)
            if ($childBook->getMainBookId() === $this) {
                $childBook->setMainBookId(null);
            }
        }

        return $this;
    }
}
