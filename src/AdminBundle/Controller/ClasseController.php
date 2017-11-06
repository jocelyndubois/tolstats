<?php

namespace AdminBundle\Controller;

use StatBundle\Entity\Classe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * @Route("/classe/add", name="admin_classe_add")
     * @param Request $request
     * @param Classe $classe
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addOrEditAction(Request $request, $_route, Classe $classe = null)
    {
        if ($_route == 'admin_classe_edit') {
            $type = 'edit';
        } else {
            $classe = new Classe();
            $type = 'add';
        }
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
            'type' => $type,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/classe/delete/{id}", name="admin_classe_delete")
     * @param Request $request
     * @param Classe $classe
     * @return \Symfony\Component\HttpFoundation\Response
     * @ParamConverter("classe", options={"id" = "id"})
     */
    public function deleteAction(Request $request, Classe $classe)
    {
        $form = $this->createFormBuilder()->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($classe);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Class ' . $classe->getName() . ' successfully removed');
            return $this->redirectToRoute('admin_classe_list');
        } else if ($request->isMethod('POST') && !$form->isValid()) {
            $request->getSession()->getFlashBag()->add('danger', 'Error !');
        }

        return $this->render(
            'AdminBundle:Global:delete.html.twig',
            array(
                'form'   => $form->createView(),
                'type' => 'class',
                'route' => 'admin_classe_delete',
                'classe' => $classe
            )
        );
    }
}
