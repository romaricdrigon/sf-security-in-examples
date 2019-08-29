<?php

namespace App\Controller;

use App\Entity\Blog;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function index()
    {
        // Doctrine filter will filter only Blogs I own
        $blogs = $this->getDoctrine()->getRepository(Blog::class)->findAll();

        return $this->render('admin/index.html.twig', [
            'blogs' => $blogs,
        ]);
    }
}
