<?php

namespace App\Controller;

use App\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/blogs", name="api_blogs")
     */
    public function blogs()
    {
        $blogs = $this->getDoctrine()->getRepository(Blog::class)->findAll();

        $data = $this->get('serializer')->serialize($blogs, 'json', [
            'groups' => 'api_blogs',
        ]);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
