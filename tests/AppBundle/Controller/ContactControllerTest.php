<?php

namespace Tests\AppBundle\Controller;


use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use AppBundle\Controller\ContactController;
use Symfony\Component\Form\Test\TypeTestCase;


class ContactControllerTest extends TypeTestCase
{
    public function testForm() {

        $formData = [
            'appbundle_contact[name]' => 'test',
            'appbundle_contact[email]' => 'test2@gmail.com'
        ];

        $objectToCompare = new Contact();

        $form = $this->factory->create(ContactType::class, $objectToCompare);

        $object = new Contact();

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $this->assertEquals($object, $objectToCompare);




        // $client = static::createClient();

        // $crawler = $client->request('GET', '/form');

        // $form = $crawler->selectButton('submit')->form();

        // // set some values
        // $form["appbundle_contact[name]"] = 'Lucas';
        // $form["appbundle_contact[email]"] = 'Lucals@gmail.com';

        // // submit the form
        // $crawler = $client->submit($form);

        // $this->assertContains('Lucas',$client->getResponse()->getContent());
    }
}