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
     * @ORM\Column()
     */
    private $time;

    /**
     * @ORM\Column()
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



    // m to o
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


    // m to m
    private $teams;
    private $roles;
    private $categories;
    private $packages;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
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
}
