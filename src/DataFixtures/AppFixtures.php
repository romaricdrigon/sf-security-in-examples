<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Blog;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $romaric = (new User())
            ->setEmail('romaric.drigon@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
        ;
        $password = $this->encoder->encodePassword($romaric, 'mysecretpassword');
        $romaric->setPassword($password);

        $manager->persist($romaric);

        $ivo = (new User())
            ->setEmail('ivo@netgen.io')
        ;
        $passwordIvo = $this->encoder->encodePassword($ivo, 'shhhtTellNoOne!');
        $ivo->setPassword($passwordIvo);

        $manager->persist($ivo);

        $webBlog = (new Blog())
            ->setName('Web Summer Camp official blog')
            ->setOwner($ivo)
        ;

        $manager->persist($webBlog);

        $welcomeArticle = (new Article())
            ->setTitle('Welcome to WSC 2019!')
            ->setContent('Ever since we started this event in 2012, the main concept hasn’t changed: '
                .'hands-on workshops held by experts in a relaxing environment, '
                .'a chance to go deeper with a topic than you can in a regular conference...')
            ->setBlog($webBlog)
        ;

        $manager->persist($welcomeArticle);

        $rdBlog = (new Blog())
            ->setName('Romaric Drigon\'s blog')
            ->setOwner($romaric)
        ;

        $manager->persist($rdBlog);

        $helloWorld = (new Article())
            ->setTitle('Hello World!')
            ->setContent('Welcome to my blog! After blogging for a while on https://blog.netinfluence.ch, '
                .'in French, I wanted to start writing in English too. Hence this blog! '
                .'I will continue publishing articles on both, though. They will have different topics and approaches. '
                .'Here, I will try to dig into more advanced Symfony topics...')
            ->setBlog($rdBlog)
        ;

        $manager->persist($helloWorld);

        $doctrine = (new Article())
            ->setTitle('About Doctrine inheritance')
            ->setContent('At a previous SymfonyLive conference (slides here, in French), '
                .'I advised not to use Doctrine inheritance mapping. After a discussion with another developer last week, '
                .'I realized the subject is worth an article with more details...')
            ->setBlog($rdBlog)
        ;

        $manager->persist($doctrine);

        $manager->flush();
    }
}
