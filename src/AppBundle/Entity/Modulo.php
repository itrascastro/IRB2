<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Modulo
 *
 * @ORM\Table(name="modulo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ModuloRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Modulo
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=2)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="grup", type="string", length=1, nullable=true)
     */
    private $grup;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity="Trascastro\UserBundle\Entity\User", inversedBy="modulos")
     */
    private $instructors;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ciclo", inversedBy="modulos")
     */
    private $ciclo;

    /**
     * Modulo constructor.
     */
    public function __construct()
    {
        $this->instructors = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->updatedAt = $this->createdAt;
    }

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
     * @return Modulo
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
     * Set number
     *
     * @param string $number
     *
     * @return Modulo
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set grup
     *
     * @param string $grup
     *
     * @return Modulo
     */
    public function setGrup($grup)
    {
        $this->grup = $grup;

        return $this;
    }

    /**
     * Get grup
     *
     * @return string
     */
    public function getGrup()
    {
        return $this->grup;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Modulo
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @return Modulo
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add instructor
     *
     * @param \Trascastro\UserBundle\Entity\User $instructor
     *
     * @return Modulo
     */
    public function addInstructor(\Trascastro\UserBundle\Entity\User $instructor)
    {
        $this->instructors[] = $instructor;

        return $this;
    }

    /**
     * Remove instructor
     *
     * @param \Trascastro\UserBundle\Entity\User $instructor
     */
    public function removeInstructor(\Trascastro\UserBundle\Entity\User $instructor)
    {
        $this->instructors->removeElement($instructor);
    }

    /**
     * Get instructors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInstructors()
    {
        return $this->instructors;
    }

    /**
     * Set ciclo
     *
     * @param \AppBundle\Entity\Ciclo $ciclo
     *
     * @return Modulo
     */
    public function setCiclo(\AppBundle\Entity\Ciclo $ciclo = null)
    {
        $this->ciclo = $ciclo;

        return $this;
    }

    /**
     * Get ciclo
     *
     * @return \AppBundle\Entity\Ciclo
     */
    public function getCiclo()
    {
        return $this->ciclo;
    }
}
