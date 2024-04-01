<?php

namespace App\Tests\Form;

use App\Entity\Author;
use App\Form\Type\AuthorType;
use Symfony\Component\Form\Test\TypeTestCase;

class AuthorTypeForm extends TypeTestCase
{
    /**
     * @return void
     */
    public function testSubmitValidData()
    {
        $formData = [
            'name' => 'John',
            'surName' => 'Doe',
            'yearOfBirth' => new \DateTime('1990-01-01'),
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'country' => 1, // Assuming this is the ID of an existing country
        ];

        $objectToCompare = new Author();
        // Populate the object with expected data
        foreach ($formData as $property => $value) {
            $setter = 'set' . ucfirst($property);
            if (method_exists($objectToCompare, $setter)) {
                $objectToCompare->$setter($value);
            }
        }

        $form = $this->factory->create(AuthorType::class);

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
