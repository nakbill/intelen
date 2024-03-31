<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type:Types::STRING,length: 255)]
    private string $title ;

    #[ORM\Column(type:Types::DATE_MUTABLE)]
    private \DateTimeInterface $publicationYear;

    #[ORM\Column(type:Types::SMALLINT, length: 10)]
    #[Assert\Isbn(
        type: Assert\Isbn::ISBN_10,
        message: 'This value is not valid.',
    )]
    private string $isbn ;

    #[ORM\Column(type:Types::STRING, length: 255)]
    private string $publisher ;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(name:'author_id',nullable:false, onDelete: "CASCADE")]
    #[Assert\NotBlank(
        message: "Please select an Author"
    )]
    private Author $author ;

    #[ORM\Column(length: 200)]
    #[Assert\Url(
        message: "Please type a valid URL"
    )]
    private string $url ;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getPublicationYear(): \DateTimeInterface
    {
        return $this->publicationYear;
    }

    public function setPublicationYear(\DateTimeInterface $publicationYear): static
    {
        $this->publicationYear = $publicationYear;

        return $this;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getPublisher(): string
    {
        return $this->publisher;
    }

    public function setPublisher(string $publisher): static
    {
        $this->publisher = $publisher;

        return $this;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setAuthor(Author $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }
}
