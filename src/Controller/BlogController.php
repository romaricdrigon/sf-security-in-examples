<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @ParamConverter("blog")
     * @Route("/blog/{id}", name="blog_view")
     */
    public function view(Blog $blog)
    {
        return $this->render('blog/view.html.twig', [
            'blog' => $blog,
        ]);
    }

    /**
     * @ParamConverter("blog")
     * @Route("/blog/{id}/edit", name="blog_edit")
     */
    public function edit(Blog $blog, Request $request)
    {
        $form = $this->createForm(BlogType::class, $blog);

        if ($form->handleRequest($request) && $form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blog_view', ['id' => $blog->getId()]);
        }

        return $this->render('blog/edit.html.twig', [
            'blog' => $blog,
            'form' => $form->createView(),
        ]);
    }
}
