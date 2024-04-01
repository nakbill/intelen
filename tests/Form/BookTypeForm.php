<?php

namespace App\Tests\Form;

use App\Entity\Book;
use App\Form\Type\BookType;
use Symfony\Component\Form\Test\TypeTestCase;

class BookTypeForm extends TypeTestCase
{
    /**
     * @return void
     */
    public function testSubmitValidData()
    {
        $formData = [
            'title' => 'Test Title',
            'publicationYear' => new \DateTime('2022-01-01'),
            'isbn' => '960-7510-94-1',
            'publisher' => 'Test Publisher',
            'author' => 1, // Assuming this is the ID of an existing author
            'url' => 'http://example.com',
        ];

        $objectToCompare = new Book();
        // Populate the object with expected data
        foreach ($formData as $property => $value) {
            $setter = 'set' . ucfirst($property);
            if (method_exists($objectToCompare, $setter)) {
                $objectToCompare->$setter($value);
            }
        }

        $form = $this->factory->create(BookType::class);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($objectToCompare, $form->getData());

        $view = $form->createView();
        $children = $view->children;
        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
