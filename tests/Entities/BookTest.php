<?php

namespace App\Tests\Entities;

use App\Entity\Author;
use App\Entity\Book;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    /**
     * @return void
     */
    public function testBookProperties()
    {
        $book = new Book();

        $book->setTitle('Test Book Title');
        $this->assertEquals('Test Book Title', $book->getTitle());

        $publicationYear = new \DateTime('2022-01-01');
        $book->setPublicationYear($publicationYear);
        $this->assertEquals($publicationYear, $book->getPublicationYear());

        $book->setIsbn('978-3-16-148410-0');
        $this->assertEquals('978-3-16-148410-0', $book->getIsbn());

        $book->setPublisher('Test Publisher');
        $this->assertEquals('Test Publisher', $book->getPublisher());

        $author = new Author();
        $author->setName('John');
        $author->setSurName('Doe');
        $book->setAuthor($author);
        $this->assertSame($author, $book->getAuthor());

        $book->setUrl('https://example.com');
        $this->assertEquals('https://example.com', $book->getUrl());
    }
}
