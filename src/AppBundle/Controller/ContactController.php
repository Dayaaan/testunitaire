<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ContactController extends Controller
{
    /**
     * @Route("/form", name="form")
     */
    public function formAction(Request $request) {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute("contact", ["id" => $contact->getId()]);
        }

        return $this->render("default/contact.html.twig", ["formContact" => $form->createView()]);


    }
    /**
     * @Route("/displaycontact/{id}", name="contact")
     */
    public function displayContactAction(Contact $contact) {
        // $em = $this->getDoctrine()->getManager();

        // $contact = $em->getRepository(Contact::class)->find($id);

        return $this->render("default/showcontact.html.twig", ["contact" => $contact]);
    }
}
