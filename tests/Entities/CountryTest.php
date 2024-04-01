<?php

namespace App\Tests\Entities;

use App\Entity\Country;
use App\Entity\Author;
use PHPUnit\Framework\TestCase;

class CountryTest extends TestCase
{
    public function testCountryProperties()
    {
        $country = new Country();

        $country->setName('Test Country');
        $this->assertEquals('Test Country', $country->getName());
    }

    public function testAddRemoveAuthor()
    {
        $country = new Country();
        $country->setName('Test Country');
        $author = new Author();
        $author->setName('John');
        $author->setSurName('Doe');

        $yearOfBirth = new \DateTime('1990-01-01');
        $author->setYearOfBirth($yearOfBirth);

        $author->setEmail('john@example.com');
        $author->setPhone('6972833981');

        $country->addAuthor($author);
        $this->assertTrue($country->getAuthors()->contains($author));
        $this->assertEquals($country, $author->getCountry());

        // Test removing author
        $country->removeAuthor($author);
        $this->assertFalse($country->getAuthors()->contains($author));
    }

    public function testValidationConstraints()
    {
        $country = new Country();
        $country->setName('Test Country');
        $errors = $this->getValidator()->validate($country);
        $this->assertCount(0, $errors);
    }


    private function getValidator()
    {
        $validatorBuilder = \Symfony\Component\Validator\Validation::createValidatorBuilder();
        return $validatorBuilder->getValidator();
    }
}
