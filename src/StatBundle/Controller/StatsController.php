<?php

namespace StatBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use StatBundle\Entity\User;

class StatsController extends Controller
{
    /**
     * @Route("/search/user/stats", name="search_user_stats")
     */
    public function searchUsersAction(Request $request)
    {
        $username = $request->request->get('username', null);
        if ($username) {
            if ($user = $this->getDoctrine()->getRepository('StatBundle:User')->findOneBy(array('username' => $username))) {
                return $this->redirectToRoute('player_stats', array('username' => $username));
            }
        }

        $request->getSession()->getFlashBag()->add('error', 'No user found.');
        return $this->redirectToRoute('global_stats');
    }

    /**
     * @Route("/player/{username}/stats", name="player_stats")
     * @param User $user
     * @ParamConverter("user", options={"username" = "username"})
     */
    public function userStatsAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $classes = $this->getDoctrine()->getRepository('StatBundle:Classe')->findAll();
        $types = $this->getDoctrine()->getRepository('StatBundle:Type')->findAll();
        $teams = $this->getDoctrine()->getRepository('StatBundle:Team')->findAll();
        $userClass = array();
        $userType = array();
        $total = 0;
        foreach ($teams as $team) {
            $userClass[$team->getName()]['total'] = 0;
        }
        foreach ($types as $type) {
            $userType[$type->getName()] = 0;
        }
        $mostPlayedClasse = null;
        $maxPlayed = 0;
        foreach ($user->getClasses() as $class) {
            $userClass[$class->getClasse()->getTeam()->getName()][$class->getClasse()->getId()] = $class->getNumber();
            $userClass[$class->getClasse()->getTeam()->getName()]['total'] += $class->getNumber();
            $userType[$class->getClasse()->getType()->getName()] += $class->getNumber();
            $total += $class->getNumber();
            if ($class->getNumber() > $maxPlayed) {
                $mostPlayedClasse = $class->getClasse();
                $maxPlayed = $class->getNumber();
            }
        }
        return $this->render(
            'StatBundle:Stats:user_stats.html.twig',
            array(
                "user" => $user,
                "classes" => $classes,
                "types" => $types,
                "teams" => $teams,
                "userClass" => $userClass,
                "userType" => $userType,
                "mostPlayedClasse" => $mostPlayedClasse,
                "total" => $total
            )
        );
    }

    /**
     * @Route("/global/stats", name="global_stats")
     */
    public function globalStatsAction()
    {
        $userClasses = $this->getDoctrine()->getRepository('StatBundle:UserClasse')->findAll();

        $classes = $this->getDoctrine()->getRepository('StatBundle:Classe')->findAll();
        $types = $this->getDoctrine()->getRepository('StatBundle:Type')->findAll();
        $teams = $this->getDoctrine()->getRepository('StatBundle:Team')->findAll();
        $factions = $this->getDoctrine()->getRepository('StatBundle:Faction')->findAll();

        $classData = array();
        $typeData = array();
        $teamData = array();
        $factionData = array();
        $mostPlayedClasse = null;
        $maxPlayed = 0;
        $total = 0;

        // Initialisation
        foreach ($classes as $classe) {
            $classData[$classe->getName()] = 0;
        }
        foreach ($teams as $team) {
            $teamData[$team->getName()] = 0;
        }
        foreach ($types as $type) {
            $typeData[$type->getName()] = 0;
        }
        foreach ($factions as $faction) {
            $factionData[$faction->getName()] = 0;
        }

        foreach ($userClasses as $userClass) {
            $classData[$userClass->getClasse()->getName()] += $userClass->getNumber();
            $teamData[$userClass->getClasse()->getTeam()->getName()] += $userClass->getNumber();
            $typeData[$userClass->getClasse()->getType()->getName()] += $userClass->getNumber();
            $factionData[$userClass->getClasse()->getFaction()->getName()] += $userClass->getNumber();

            if ($classData[$userClass->getClasse()->getName()] > $maxPlayed) {
                $mostPlayedClasse = $userClass->getClasse();
                $maxPlayed = $classData[$userClass->getClasse()->getName()];
            }

            $total += $userClass->getNumber();
        }

        return $this->render('StatBundle:Stats:global_stats.html.twig', array(
            'classes' => $classes,
            'types' => $types,
            'teams' => $teams,
            'faction' => $factions,
            'classData' => $classData,
            'typeData' => $typeData,
            'mostPlayedClasse' => $mostPlayedClasse,
            'teamData' => $teamData,
            'factionData' => $factionData,
            'total' => $total
        ));
    }

}
