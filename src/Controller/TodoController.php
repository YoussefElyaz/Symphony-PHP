<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Todo;
use App\Form\TodoType;

/**
 * @Route("/todos")
 */
class TodoController extends AbstractController
{
    /**
     * @Route("/", name="todos_list")
     */
    public function list(): Response
    {
        // Récupération des Todos
        $repository = $this->getDoctrine()->getRepository(Todo::class);
        $todos = $repository->findAll();

        // Appel de l'affichage, en passant les todos en paramètre
        return $this->render('todos/list.html.twig', [
            'todos' => $todos
        ]);
    }

    /**
     * @Route("/new", name="todos_new")
     */
    public function new(Request $request):Response
    {
        $todo = new Todo();

        $form = $this->createForm(TodoType::class, $todo);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $todo = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($todo);
            $entityManager->flush();

            return $this->redirectToRoute('todos_list');
        }

        return $this->render('todos/new.html.twig', [
            'form'  => $form->createView(),
            'todo'  => $todo
        ]);
    }

    /**
     * @Route("/{id}", name="todos_show")
     */
    public function show($id): Response
    {
        $todo_show = $this->getDoctrine()
            ->getRepository(Todo::class)
            ->find($id);

        return $this->render('todos/show.html.twig', [
            'todo' => $todo_show
        ]);
    }

    /**
     * @Route("/{id}/edit", name="todos_edit")
     */
    public function edit($id, Request $request):Response
    {
        $todo_edit = $this->getDoctrine()
            ->getRepository(Todo::class)
            ->find($id);

        $form = $this->createForm(TodoType::class, $todo_edit);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $todo_edit = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($todo_edit);
            $entityManager->flush();

            return $this->redirectToRoute('todos_list');
        }

        return $this->render('todos/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="todos_delete")
     */
    public function delete($id, Request $request):Response
    {
        $todo_delete = $this->getDoctrine()
            ->getRepository(Todo::class)
            ->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($todo_delete);
        $entityManager->flush();

        return $this->redirectToRoute('todos_list');
    }

}