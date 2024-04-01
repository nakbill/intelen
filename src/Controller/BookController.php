<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\Type\BookType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/book/action/{id<\d+>?}', name: 'book_add_edit')]
    public function new(Request $request,  EntityManagerInterface $entityManager, ?Book $book): Response
    {
        $book = $book ?? new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($book);
            $entityManager->flush();
            return $this->redirectToRoute('book_add_edit', ['id' => $book->getId()]);
        }

        return $this->render('book/new.html.twig', [
            'form' => $form->createView(),
            'books' => $entityManager->getRepository(Book::class)->findAll()
        ]);
    }

    #[Route('/book/delete/{id}', name: 'book_delete')]
    public function delete(Book $book, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($book);
        $entityManager->flush();
        return $this->redirectToRoute('book_add_edit');
    }
}

