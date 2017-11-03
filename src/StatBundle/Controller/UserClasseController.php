<?php

namespace StatBundle\Controller;

use StatBundle\Entity\UserClasse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use StatBundle\Entity\Classe;
use StatBundle\Entity\User;

class UserClasseController extends Controller
{
    /**
     * @Route("/increment/{user}/{classe}", name="increment_classe_user")
     * @Route("/decrement/{user}/{classe}", name="decrement_classe_user")
     * @param User $user
     * @param Classe $classe
     * @ParamConverter("user", options={"id" = "user"})
     * @ParamConverter("classe", options={"id" = "classe"})
     */
    public function userStatsAction(Request $request, $_route, User $user, Classe $classe)
    {
        if ($this->getUser() == $user) {
            $em = $this->getDoctrine()->getManager();
            $userClasse = $this->getDoctrine()->getRepository('StatBundle:UserClasse')->findOneBy(array('user' => $user, 'classe' => $classe));
            if (!$userClasse) {
                $userClasse = new UserClasse();
                $userClasse->setUser($user);
                $userClasse->setClasse($classe);
                $userClasse->setNumber(0);
            }
            $number = $userClasse->getNumber();
            if ($_route == 'increment_classe_user') {
                $number++;
            } else {
                $number--;
                if ($number < 0) {
                    $number = 0;
                }
            }
            $userClasse->setNumber($number);
            $em->persist($userClasse);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Added an occurence of ' . $classe->getName() . '.');
        } else {
            $request->getSession()->getFlashBag()->add('error', 'You do not have the permission to update this user.');
        }

        return $this->redirectToRoute('player_stats', array('username' => $user->getUsername()));
    }

}
