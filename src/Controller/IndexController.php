<?php

namespace App\Controller;

use App\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $blogs = $this->getDoctrine()->getRepository(Blog::class)->findAll();

        return $this->render('index/index.html.twig', [
            'blogs' => $blogs,
        ]);
    }
}
