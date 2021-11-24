<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use App\Form\CategoryType;
use App\Entity\ArticleBlog;
use App\Entity\Category;
use App\Form\ArticleBlogType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    //creation de la route pour la création de categorie
      /**
     * @Route("/category/form", name="creation_cat")
     */

     //fonction qui permet de créer un nouvelle categorie dans la db
    //  public function new(EntityManagerInterface $entityManager): Response

    //  {
         
    //      $categorie = new Category();

    //      $categorie->setNom('Autres');

    //      $entityManager->persist($categorie);
    //      $entityManager->flush();

    //      return $this->render('category/index.html.twig',[

    //         'controller_name' => 'ArticleController',
    //         'Category'=>$categorie,
            
    
    //      ]);
    //  }

      /**
     * @Route("/category/form", name="cat_form")
     */
    public function add(Request $request): Response
    {
        $categorie = new Category();
       
        $form = $this->createForm(CategoryType::class, $categorie);
        $form->handleRequest($request);
        //traitement si le form est submit et valid alors 
        if($form->isSubmitted()&& $form->isValid()){
            $categorie = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('article_detail', [
                'id'=> $categorie->getId()
            ]);
        }
        
        return $this->render('category/index.html.twig',[
            'form'=> $form->createView()
        ]);
    }

  
  

}
