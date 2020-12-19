<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class EceController extends AbstractController
{ 
	/**
	* @Route("/Ece/Controller")
    */
    public function nom(): Response{
        $nom = 'youssef';

        return $this->render('Ece.html.twig', [
            'nom' => $nom
        ]);
    }
}