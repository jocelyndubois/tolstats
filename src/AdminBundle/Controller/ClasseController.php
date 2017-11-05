<?php

namespace AdminBundle\Controller;

use StatBundle\Entity\Classe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AdminBundle\Form\Classe\ClasseEditType;

class ClasseController extends Controller
{
    /**
     * @Route("/classe/list", name="admin_classe_list")
     */
    public function listAction()
    {
        $classes = $this->getDoctrine()->getRepository('StatBundle:Classe')->findAll();
        return $this->render(
            'AdminBundle:Classe:list.html.twig',
            array(
                'classes' => $classes
            )
        );
    }

    /**
     * @Route("/classe/edit/{id}", name="admin_classe_edit")
     * @param Request $request
     * @param Classe $classe
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Classe $classe)
    {
        $form = $this->createForm(new ClasseEditType(), $classe);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($classe);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_classe_list'));
        }

        return $this->render('AdminBundle:Classe:edit.html.twig', array(
            'classe' => $classe,
            'form' => $form,
            'form' => $form->createView()
        ));
    }
}
