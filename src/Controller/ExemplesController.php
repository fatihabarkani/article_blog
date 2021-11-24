<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExemplesController extends AbstractController
{
    /**
     * @Route("/exemples", name="exemples")
     */
    public function index(): Response
    {
        //traitement des données
        $tableau = [
            'abacdefghijk',
            'defghubnlope',
            'polmeinfuhty'
            
        ];

        $tableau2 = [
            1, 8, 10, 1, 30
            
        ];



        // affichage 1er élément du tableau
        $first=$tableau[0];

        //affichage du max
        $max=max($tableau2);
        

        //affichage des données traitées
        return $this->render('exemples/index.html.twig', [
            
            //affichage tableau
            'tableau'=>$tableau,
            // affichage 1er élément du tableau
            'first'=>$first,
            //affichage max
            'tableau2'=>$tableau2,
            'max'=>$max,

        ]);
       
    }
}
