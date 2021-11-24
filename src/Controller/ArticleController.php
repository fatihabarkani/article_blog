<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


use App\Entity\ArticleBlog;
use App\Entity\Category;
use App\Form\ArticleBlogType;
use App\Controller\CategoryType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;


class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(EntityManagerInterface $entityManager ): Response
    {
        $repository = $entityManager->getRepository(ArticleBlog::class);
        $articles = $repository->findAll();

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles'=>$articles
            
        ]);
    }

    
     /**
     * @Route("/article/form", name="article_form")
     */
    public function add(Request $request): Response
    {
        $article = new ArticleBlog();
        $article->setDateCreation(new DateTime());
        $form = $this->createForm(ArticleBlogType::class, $article);
        $form->handleRequest($request);
        //traitement si le form est submit et valid alors 
        if($form->isSubmitted()&& $form->isValid()){
            $article = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_detail', [
                'id'=> $article->getId()
            ]);
        }

        return $this->render('article/add.html.twig',[
            'form'=> $form->createView()
        ]);
    }


   

    /**
     * @Route("/article/detail/{id}", name="article_detail")
     */

     public function detailArticle($id, EntityManagerInterface $entityManager): Response
     {
        $repository = $entityManager->getRepository(ArticleBlog::class);
        $article = $repository->find($id);
         //on fait un render pour le detail en passant l'id de l'article
         return $this->render('article/detail.html.twig', [
             'article'=>$article,
             //votes : on nomme comme on veut
             'votes' => rand(1, 100),
            

         ]);
     }

    /**
     * @Route("/article/magique", name="article_magique")
     */
    public function magique(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager -> getRepository(ArticleBlog::class);
        $articles = $repository -> findByContenu('magique');

        return $this->render('article/affichage.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles
        ]);
    }
    
    // articles par année
     /**
     * @Route("/article/{year}", name="article_year")
     */
    public function year($year, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager -> getRepository(ArticleBlog::class);
        $articles = $repository -> findByYear($year);

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
            'year'=>$year
        ]);
    }
      /**
     * @Route("/article/vote", name="vote")
     */
     //creation route pour la page de vote pour transporter des données sous format json et non pour l'affichage (via render)
     public function voteArticle(): JsonResponse
     {

         $tab = ['votes' => rand(1, 100)];
         return new JsonResponse($tab);
     }

     //creation de la route pour la création d 'article
      /**
     * @Route("/article/form", name="creation_article")
     */

     //fonction qui permet de créer un nouvel article blog dans la db
     public function new(EntityManagerInterface $entityManager): Response

     {
         
         $article = new ArticleBlog();

         $article->setTitre('Mon 3eme Article');
         $article->setContenu('jupe noir');
         $article->setDateCreation(new DateTime());

         $entityManager->persist($article);
         $entityManager->flush();

         return $this->render('article/add.html.twig',[

            'controller_name' => 'ArticleController',
            'articleBlog'=>$article
    
         ]);
     }

     //creation des articles pour les années 2015/2018/2021

      /**
     * @Route("/article/creation", name="creation_article")
     */
    /*
    public function new2(EntityManagerInterface $entityManager): Response

     {
         
         $article1 = new ArticleBlog();
         //$article2 = new ArticleBlog();

         $article1->setTitre('Mon nouvel Article2015');
         //$article2->setTitre('Mon nouvel Article2018');

         $article1->setContenu('robe blanche');
         //$article2->setContenu('robe rose');

         $article1->setDateCreation(new DateTime("2015-03-14 00:00"));
         //$article2->setDateCreation(new DateTime("2018-03-14 00:00"));

         $entityManager->persist($article1);
         //$entityManager->persist($article2);

         $entityManager->flush();

         return $this->render('article/creation.html.twig',[

            'controller_name' => 'ArticleController',
            'articleBlog'=>$article1
            //'articleBlog'=>$article2
            
    
         ]);
     }
*/

     //fonction qui permet de créer un nouvel article blog dans la db qui contient le mot "magique".

       /**
     * @Route("/article/creation/magique", name="creation_article")
     */
    
    //  public function new3(EntityManagerInterface $entityManager): Response

    //  {
         
    //      $article = new ArticleBlog();

    //      $article->setTitre('Mon Article magique');
    //      $article->setContenu('jupe noir magique');
    //      $article->setDateCreation(new DateTime());

    //      $entityManager->persist($article);
    //      $entityManager->flush();

    //      return $this->render('article/creation.html.twig',[

    //         'controller_name' => 'ArticleController',
    //         'articleBlog'=>$article
    
    //      ]);
    //  }


    
}
