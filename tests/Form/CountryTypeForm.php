<?php

namespace App\Tests\Form;

use App\Entity\Country;
use App\Form\Type\CountryType;
use Symfony\Component\Form\Test\TypeTestCase;

class CountryTypeForm extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'name' => 'Test Country',
        ];

        $objectToCompare = new Country();
        $objectToCompare->setName('Test Country');

        // Create form
        $form = $this->factory->create(CountryType::class);

        // Submit form data
        $form->submit($formData);

        // Check if form is valid
        $this->assertTrue($form->isSynchronized());

        // Check if data transformation is correct
        $this->assertEquals($objectToCompare, $form->getData());

        // Check if form view is as expected
        $view = $form->createView();
        $children = $view->children;
        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    public function testValidationConstraints()
    {
        $country = new Country();

        // Test blank name
        $formData = ['name' => ''];
        $form = $this->factory->create(CountryType::class, $country);
        $form->submit($formData);
        $this->assertFalse($form->isValid());

        // Test name length less than minimum
        $formData = ['name' => 'A'];
        $form = $this->factory->create(CountryType::class, $country);
        $form->submit($formData);
        $this->assertFalse($form->isValid());

        // Test name length exceeds maximum
        $formData = ['name' => str_repeat('A', 51)];
        $form = $this->factory->create(CountryType::class, $country);
        $form->submit($formData);
        $this->assertFalse($form->isValid());

        // Test valid name
        $formData = ['name' => 'Test Country'];
        $form = $this->factory->create(CountryType::class, $country);
        $form->submit($formData);
        $this->assertTrue($form->isValid());
    }
}
