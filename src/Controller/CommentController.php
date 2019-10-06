<?php

namespace App\Controller;
use App\Form\Type\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class CommentController extends AbstractController
{


    public function new(Request $request)
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        return $this->render('comment/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

?>