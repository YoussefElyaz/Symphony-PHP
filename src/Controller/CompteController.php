<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/compte")
 * @IsGranted("ROLE_USER")
 */
class CompteController extends AbstractController
{
	/**
	 * @Route("/", name="compte")
	 */
	public function Index(){
		return $this->render('compte/index.html.twig', [
        ]);
	}
}