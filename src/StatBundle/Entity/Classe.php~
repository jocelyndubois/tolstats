<?php

namespace StatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Classe
 *
 * @ORM\Table(name="classe")
 * @ORM\Entity(repositoryClass="StatBundle\Repository\ClasseRepository")
 */
class Classe
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="goal", type="string", length=255, nullable=true)
     */
    private $goal;

    /**
     * @ORM\ManyToOne(targetEntity="\StatBundle\Entity\Type", inversedBy="classes", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Valid()
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="\StatBundle\Entity\Faction", inversedBy="classes", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Valid()
     */
    private $faction;

    /**
     * @ORM\ManyToOne(targetEntity="\StatBundle\Entity\Team", inversedBy="classes", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Valid()
     */
    private $team;

    /**
     * @ORM\OneToMany(targetEntity="UserClasse", mappedBy="classes", cascade={"persist", "remove"})
     */
    private $users;

    /**
     * @var bool
     *
     * @ORM\Column(name="visible", type="boolean")
     */
    private $visible = true;

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
     * Set name
     *
     * @param string $name
     *
     * @return Classe
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Classe
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set goal
     *
     * @param string $goal
     *
     * @return Classe
     */
    public function setGoal($goal)
    {
        $this->goal = $goal;

        return $this;
    }

    /**
     * Get goal
     *
     * @return string
     */
    public function getGoal()
    {
        return $this->goal;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set type
     *
     * @param \StatBundle\Entity\Type $type
     *
     * @return Classe
     */
    public function setType(\StatBundle\Entity\Type $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \StatBundle\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set faction
     *
     * @param \StatBundle\Entity\Faction $faction
     *
     * @return Classe
     */
    public function setFaction(\StatBundle\Entity\Faction $faction)
    {
        $this->faction = $faction;

        return $this;
    }

    /**
     * Get faction
     *
     * @return \StatBundle\Entity\Faction
     */
    public function getFaction()
    {
        return $this->faction;
    }

    /**
     * Set team
     *
     * @param \StatBundle\Entity\Team $team
     *
     * @return Classe
     */
    public function setTeam(\StatBundle\Entity\Team $team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \StatBundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Add user
     *
     * @param \StatBundle\Entity\UserClasse $user
     *
     * @return Classe
     */
    public function addUser(\StatBundle\Entity\UserClasse $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \StatBundle\Entity\UserClasse $user
     */
    public function removeUser(\StatBundle\Entity\UserClasse $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        if ($this->getFaction()) {
            return $this->getFaction()->getColor();
        } elseif ($this->getTeam()) {
            return $this->getTeam()->getColor();
        }

        return '#BDBDBD';
    }

    public function getTextColor()
    {
        if ($this->getColor() != '#BDBDBD') {
            return '#FFFFFF';
        }

        return '#000000';
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     *
     * @return Classe
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean
     */
    public function getVisible()
    {
        return $this->visible;
    }
}
