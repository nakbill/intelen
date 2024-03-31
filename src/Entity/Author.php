<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
#[ORM\Index( name: "name_surName_idx", columns: ["name", "sur_name"])]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type:Types::STRING,length: 100)]
    #[Assert\NotBlank(
        message: "Please provide a name"
    )]
    private string $name ;

    #[ORM\Column(type:Types::STRING,length: 100)]
    #[Assert\NotBlank(
        message: "Please provide a surname"
    )]
    private string $surName;

    #[ORM\Column(type:Types::DATE_MUTABLE)]
    private \DateTimeInterface $yearOfBirth ;
    #[ORM\Column(type:Types::STRING,length: 50)]
    #[Assert\Email]
    private string $email;

    /**
     * @var Collection<int, Book>&iterable<Book>
     */
    #[ORM\OneToMany(targetEntity: Book::class, mappedBy: 'author', orphanRemoval: true)]
    private Collection $books;

    #[ORM\ManyToOne(inversedBy: 'authors')]
    #[ORM\JoinColumn(name:'country_id',nullable:false, onDelete: "CASCADE")]
    #[Assert\NotBlank(
        message: "Please select a country"
    )]
    private Country $country ;

    #[ORM\Column(type: Types::STRING, nullable: true)]

    private ?string $phone =  null;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurName(): ?string
    {
        return $this->surName;
    }

    public function setSurName(string $surName): static
    {
        $this->surName = $surName;

        return $this;
    }

    public function getYearOfBirth(): ?\DateTimeInterface
    {
        return $this->yearOfBirth;
    }

    public function setYearOfBirth(\DateTimeInterface $yearOfBirth): static
    {
        $this->yearOfBirth = $yearOfBirth;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): static
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setAuthor($this);
        }

        return $this;
    }

    public function removeBook(Book $book): static
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getAuthor() === $this) {
                $book->setAuthor($this);
            }
        }

        return $this;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function setCountry(Country $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }
}
