<?php

namespace App\Controller;

use App\Entity\Status;
use App\Entity\Todo;
use App\Form\TodoType;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class TodoController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $todos = $doctrine->getRepository(Todo::class)->findAll();
        // dd($todos);
        return $this->render('todo/index.html.twig', [
            "todos" => $todos,
            "type"=>"all"
        ]);
    }

    #[Route('/filter/{type}', name: 'filter')]
    public function filter($type=null,ManagerRegistry $doctrine): Response
    {
        $todos = $doctrine->getRepository(Todo::class)->findAll();
        if(isset($type) && $type!="all")
        $todos = $doctrine->getRepository(Todo::class)->findBy(['priority'=>$type]);
        // dd($todos);
        return $this->render('todo/index.html.twig', [
            "todos" => $todos,
            "type"=>$type
        ]);
    }

    #[Route('/create', name: 'create-todo')]
    public function createAction(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $todo = new Todo();
        $form = $this->createForm(TodoType::class, $todo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $todo = $form->getData();
            $picture = $form->get('picture')->getData();

            if ($picture) {
                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$picture->guessExtension();
                try {
                    $picture->move(
                        $this->getParameter('picture_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $todo->setPicture($newFilename);
            }

            $todo->setStartDate(new \DateTime('now'));

            $em = $doctrine->getManager();

            $em->persist($todo);
            $em->flush();

            return $this->redirectToRoute('index');
        }

        
        return $this->render('todo/create.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route('/edit/{id}', name: 'edit-todo')]
    public function editAction($id, Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $todo = $doctrine->getRepository(Todo::class)->find($id);
        $form = $this->createForm(TodoType::class, $todo);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $picture = $form->get('picture')->getData();

            if ($picture) {
                if($todo->getPicture())
                unlink( $this->getParameter('picture_directory'). "/".$todo->getPicture());
                // unlink( "pictures/".$todo->getPicture());
                $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$picture->guessExtension();
                try {
                    $picture->move(
                        $this->getParameter('picture_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $todo->setPicture($newFilename);
            }
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $todo = $form->getData();
          
            

            $em = $doctrine->getManager();

            $em->persist($todo);
            $em->flush();

            return $this->redirectToRoute('index');
        }
        return $this->render('todo/edit.html.twig', [
            "form" => $form->createView()
        ]);
    }

    #[Route('/details/{id}', name: 'details-todo')]
    public function detailsAction($id, ManagerRegistry $doctrine): Response
    {
        $todo = $doctrine->getRepository(Todo::class)->find($id);
        
        $fk_status = $todo->getFkStatus()->getId();
        // dd($todo->getFkStatus()->getId());
        $status = $doctrine->getRepository(Status::class)->find($fk_status);
        return $this->render('todo/details.html.twig', [
            "todo" => $todo,
            "status" => $status
        ]);
    }

    #[Route('/delete/{id}', name: 'delete-todo')]
    public function deleteAction($id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $todo = $doctrine->getRepository(Todo::class)->find($id);
        $em->remove($todo);
        $em->flush(); 

        return $this->redirectToRoute("index");
    }
}



