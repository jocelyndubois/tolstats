<?php

namespace StatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * UserClasse
 *
 * @ORM\Table(name="user_classe")
 * @ORM\Entity(repositoryClass="StatBundle\Repository\UserClasseRepository")
 */
class UserClasse
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer", nullable=true)
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="\StatBundle\Entity\User", inversedBy="classes", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="\StatBundle\Entity\Classe", inversedBy="users", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $classe;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return UserClasse
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set user
     *
     * @param \StatBundle\Entity\User $user
     *
     * @return UserClasse
     */
    public function setUser(\StatBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \StatBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set classe
     *
     * @param \StatBundle\Entity\Classe $classe
     *
     * @return UserClasse
     */
    public function setClasse(\StatBundle\Entity\Classe $classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return \StatBundle\Entity\Classe
     */
    public function getClasse()
    {
        return $this->classe;
    }
}
