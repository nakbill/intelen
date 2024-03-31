<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\DependencyInjection\Attribute\Target;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
#[ORM\Index( name: "name_idx", columns: ["name"])]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(
        message: "Please enter a name for Country"
    )]
    #[ORM\OrderBy(['name'=>'DESC'])]
    private string $name;
    /**
     * @var Collection<int, Author>&iterable<Author>
     */
    #[ORM\OneToMany(targetEntity: Author::class, mappedBy: 'country')]
    private Collection $authors;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Author>
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(Author $author): static
    {
        if (!$this->authors->contains($author)) {
            $this->authors->add($author);
            $author->setCountry($this);
        }

        return $this;
    }

    public function removeAuthor(Author $author): static
    {
        if ($this->authors->removeElement($author)) {
            // set the owning side to null (unless already changed)
            if ($author->getCountry() === $this) {
                $author->setCountry($this);
            }
        }

        return $this;
    }
}
