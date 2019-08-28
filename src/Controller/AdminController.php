<?php

namespace App\Controller;

use App\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        // TODO: should be only Blogs I can admin
        $blogs = $this->getDoctrine()->getRepository(Blog::class)->findAll();

        return $this->render('admin/index.html.twig', [
            'blogs' => $blogs,
        ]);
    }
}
