<?php

namespace App\Tests\Entities;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Country;
use PHPUnit\Framework\TestCase;

class AuthorTest extends TestCase
{
    /**
     * @return void
     */
    public function testAuthorProperties()
    {
        $author = new Author();

        $author->setName('John');
        $this->assertEquals('John', $author->getName());

        $author->setSurName('Doe');
        $this->assertEquals('Doe', $author->getSurName());

        $yearOfBirth = new \DateTime('1990-01-01');
        $author->setYearOfBirth($yearOfBirth);
        $this->assertEquals($yearOfBirth, $author->getYearOfBirth());

        $author->setEmail('john@example.com');
        $this->assertEquals('john@example.com', $author->getEmail());

        $author->setPhone('123456789');
        $this->assertEquals('123456789', $author->getPhone());

        $country = new Country();
        $author->setCountry($country);
        $this->assertEquals($country, $author->getCountry());
    }

    /**
     * @return void
     */
    public function testAddRemoveBook()
    {
        $author = new Author();

        $author->setName('John');
        $author->setSurName('Doe');
        $yearOfBirth = new \DateTime('1990-01-01');
        $author->setYearOfBirth($yearOfBirth);
        $author->setEmail('john@example.com');
        $author->setPhone('123456789');

        $book = new Book();
        $book->setTitle('Test Book Title');
        $publicationYear = new \DateTime('2022-01-01');
        $book->setPublicationYear($publicationYear);
        $book->setIsbn('978-3-16-148410-0');
        $book->setPublisher('Test Publisher');

        // Test adding book
        $author->addBook($book);
        $this->assertTrue($author->getBooks()->contains($book));
        $this->assertEquals($author, $book->getAuthor());

        // Test removing book
        $author->removeBook($book);
        $this->assertFalse($author->getBooks()->contains($book));

    }

    public function testValidationConstraints()
    {
        $author = new Author();

        // Test blank name
        $this->assertHasError($author, 2);

        // Test blank surname
        $author->setName('John');
        $this->assertHasError($author, 1);

        // Test valid author
        $author->setSurName('Doe');
        $errors = $this->getValidator()->validate($author);
        $this->assertCount(0, $errors);
    }

    private function assertHasError(Author $author, int $count)
    {
        $errors = $this->getValidator()->validate($author);
        $this->assertCount($count, $errors);
    }

    private function getValidator()
    {
        $validatorBuilder = \Symfony\Component\Validator\Validation::createValidatorBuilder();
        $validator = $validatorBuilder->getValidator();
        return $validator;
    }
}
