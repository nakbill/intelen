<?php

namespace App\Controller;

use App\Entity\Country;
use App\Form\Type\CountryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CoutryController extends AbstractController
{
    #[Route('/country/action/{id<\d+>?}', name: 'country_add_edit')]
    public function new(Request $request, EntityManagerInterface $entityManager, ?Country $country): Response
    {
        $country = $country ?? new Country();
        $form = $this->createForm(CountryType::class, $country);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($country);
            $entityManager->flush();
            return $this->redirectToRoute('country_new');
        }

        return $this->render('country/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
