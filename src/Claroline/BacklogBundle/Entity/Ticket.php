<?php

/*
 * This file is part of the Claroline Connect package.
 *
 * (c) Claroline Consortium <consortium@claroline.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Claroline\BacklogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column()
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(nullable=true)
     */
    private $time;

    /**
     * @ORM\Column(nullable=true)
     */
    private $path;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isValidated = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isBlocked = false;

    /**
     * @ORM\Column(nullable=true)
     */
    private $githubLink;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Claroline\BacklogBundle\Entity\User",
     *     inversedBy="tickets"
     * )
     * @ORM\JoinColumn(nullable=false)
     */
    private $creator;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Claroline\BacklogBundle\Entity\Status",
     *     inversedBy="tickets"
     * )
     */
    private $status;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Claroline\BacklogBundle\Entity\Version",
     *     inversedBy="tickets"
     * )
     */
    private $version;

    /**
     * @ORM\OneToMany(
     *     targetEntity="Claroline\BacklogBundle\Entity\Comment",
     *     mappedBy="author"
     * )
     */
    private $comments;

    /**
     * @ORM\ManyToMany(
     *     targetEntity="Claroline\BacklogBundle\Entity\Team",
     *     inversedBy="tickets"
     * )
     */
    private $teams;

    /**
     * @ORM\ManyToMany(
     *     targetEntity="Claroline\BacklogBundle\Entity\Role",
     *     inversedBy="tickets"
     * )
     */
    private $roles;

    /**
     * @ORM\ManyToMany(
     *     targetEntity="Claroline\BacklogBundle\Entity\Category",
     *     inversedBy="tickets"
     * )
     */
    private $categories;

    /**
     * @ORM\ManyToMany(
     *     targetEntity="Claroline\BacklogBundle\Entity\Package",
     *     inversedBy="tickets"
     * )
     */
    private $packages;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->teams = new ArrayCollection();
        $this->roles = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->packages = new ArrayCollection();
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->categories = $category;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->categories;
    }

    /**
     * @param mixed $package
     */
    public function setPackage($package)
    {
        $this->packages = $package;
    }

    /**
     * @return mixed
     */
    public function getPackage()
    {
        return $this->packages;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->roles = $role;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->roles;
    }

    /**
     * @param mixed $team
     */
    public function setTeam($team)
    {
        $this->teams = $team;
    }

    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->teams;
    }


    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $isBlocked
     */
    public function setIsBlocked($isBlocked)
    {
        $this->isBlocked = $isBlocked;
    }

    /**
     * @return mixed
     */
    public function getIsBlocked()
    {
        return $this->isBlocked;
    }

    /**
     * @param mixed $isValidated
     */
    public function setIsValidated($isValidated)
    {
        $this->isValidated = $isValidated;
    }

    /**
     * @return mixed
     */
    public function getIsValidated()
    {
        return $this->isValidated;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $githubLink
     */
    public function setGithubLink($githubLink)
    {
        $this->githubLink = $githubLink;
    }

    /**
     * @return mixed
     */
    public function getGithubLink()
    {
        return $this->githubLink;
    }

    public function setCreator(User $creator)
    {
        $this->creator = $creator;
    }

    public function getCreator()
    {
        return $this->creator;
    }
}
