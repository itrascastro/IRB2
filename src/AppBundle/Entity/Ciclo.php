<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ciclo
 *
 * @ORM\Table(name="ciclo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CicloRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Ciclo
{
    const GRADES = ['MITJA', 'SUPERIOR'];

    const CICLOS = [
        'MITJA' => [
            'ACTIVITATS COMERCIALS',
            'CAFEMN',
            'CAI',
            'GESTIÓ ADMINISTRATIVA',
            'JARDINERIA I FLORISTERIA',
            'PERRUQUERIA I COSMÈTICA CAPIL·LAR',
            'PRODUCCIÓ AGROECOLÒGICA',
            'SISTEMES MICROINFORMÀTICS I XARXES',
        ],
        'SUPERIOR' => [
            'ADMINISTRACIÓ DE SISTEMES INFORMÀTICS EN LA XARXA',
            'ADMINISTRACIÓ I FINANCES',
            'COMERÇ INTERNACIONAL',
            'DESENVOLUPAMENT D´APLICACIONS WEB',
            'PAISATGISME I MEDI RURAL',
            'TAFE',
            'TRANSPORT I LOGÍSTICA',
        ]
    ];

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
     * @ORM\Column(name="grade", type="string", length=30)
     */
    private $grade;

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
     * @ORM\OneToMany(targetEntity="Trascastro\UserBundle\Entity\User", mappedBy="ciclo", cascade={"remove"})
     */
    private $instructors;

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
     * @return Ciclo
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
     * Set grade
     *
     * @param string $grade
     *
     * @return Ciclo
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return string
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Ciclo
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
     * @ORM\PreUpdate()
     *
     * @return Ciclo
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
     * @return Ciclo
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

    function __toString()
    {
        return $this->name;
    }
}
