<?php

// src/Controller/AuthorController.php

namespace App\Controller;

use App\Entity\Author;
use App\Form\Type\AuthorType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/author/action/{id<\d+>?}', name: 'author_add_edit')]
    public function new(Request $request, EntityManagerInterface $entityManager, ?Author $author): Response
    {
        $author = $author ?? new Author();
        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($author);
            $entityManager->flush();
            return $this->redirectToRoute('author_add_edit', ['id' => $author->getId()]);
        }

        return $this->render('author/new.html.twig', [
            'form' => $form->createView(),
            'authors' => $entityManager->getRepository(Author::class)->findAll()
        ]);
    }


    #[Route('/author/delete/{id}', name: 'author_delete')]
    public function delete(Author $author, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($author);
        $entityManager->flush();
        return $this->redirectToRoute('author_add_edit');
    }

}

