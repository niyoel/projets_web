<?php

namespace App\Controller;
use App\Entity\Projet;
use App\Repository\ProjetRepository;
use App\Form\ProjetType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class ProjectController extends AbstractController
{
    #[Route('/ ', name: 'app_home')]
    public function index(ManagerRegistry $doctrine, ProjetRepository $repo): Response
    {
       

    return $this->render('project/index.html.twig', ['projects' => $repo->findAll()]);
    }
    #[Route('/project/{id<[0-9]+>}', name:'app_projet_show', methods:'GET')]
    public function show(Projet $projet): Response
    {
        return $this->render('project/show.html.twig', compact('projet'));
    }  
    #[Route("/project/create", name:"app_projet_create", methods: ["GET","POST"])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $projet = new Projet;
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($projet);
            $em->flush();
            return $this->redirectToRoute('app_home');
        }
        return $this->render('project/create.html.twig', ['monForm' => $form->createView()]);   
       }  
}
