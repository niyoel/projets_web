<?php

namespace App\Controller;
use App\Entity\Projet;
use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class ProjectController extends AbstractController
{
    #[Route('/ ', name: 'app_home')]
    public function index(ManagerRegistry $doctrine, ProjetRepository $repo): Response
    {
        $project1 = new Projet;
        $project1->setTitle("student portal project ");
        $project1->setDescription("Description du projet ");    
        $em = $doctrine->getManager();
        $em->persist($project1);
        $em->flush(); 
        
        // dump($project1);

    return $this->render('project/index.html.twig', ['projects' => $repo->findAll()]);
    }
    #[Route('/project/{id<[0-9]+>}', name:'app_projet_show', methods:'GET')]
    public function show(Projet $projet): Response
    {
        return $this->render('project/show.html.twig', compact('projet'));
    }    
}
