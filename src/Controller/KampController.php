<?php

namespace App\Controller;

use App\Entity\Kamp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class KampController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {



        $repository = $this->getDoctrine()->getRepository(Kamp::class);
        $kamps = $repository->findAll();
        $spotlitKamps = $repository->findBy(
            ['spotlight' => true]
        );

        $randKamp = $spotlitKamps[array_rand($spotlitKamps)];


        /*
        $manager = $this->getDoctrine()->getManager();
        //$qb = $manager->createQueryBuilder();

        $qb = $manager->createQueryBuilder('k')
            ->andWhere('k.price > :price')
            ->setParameter('price', '2')
            ->orderBy('p.price', 'ASC')
            ->getQuery();

        $executed = $qb->execute();
        dump($executed);
        die();
        */


        return $this->render('kamp/index.html.twig', [
        'controller_name' => 'KampController',
            'kamps' => $kamps,
            'randKamp' => $randKamp,
    ]);

    }

    /**
     * @Route("/kamp/{id}", name="kamp")
     */
    public function kamp(int $id)
    {

        $repository = $this->getDoctrine()->getRepository(Kamp::class);
        $kamp = $repository->find($id);

        return $this->render('kamp/kamp.html.twig', [
            'controller_name' => 'KampController',
            'kamp' => $kamp,
        ]);
    }

    /**
     * @Route("/kamp/comment/{slug}", name="addComment")
     */
    public function addComment($slug)
    {

        dump($slug);
        die();

        $manager = $this->getDoctrine()->getManager();
        $kamp = new Kamp();
        $comment->setContent('random content');
        $comment->setId('random content');

        $manager->persist($comment);
        $manager->flush();

        dump($manager);

        return new Response();
    }

    public function new(Request $request)
    {

        $comment = new Comment();
        $comment->setContent('Write a blog post');
        $comment->setKampId(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($comment)
            ->add('content', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Comment'])
            ->getForm();

        return $this->render('task/new.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}
