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

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToOne(
     *     targetEntity="Claroline\BacklogBundle\Entity\Ticket",
     *     inversedBy="comments"
     * )
     */
    private $ticket;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="Claroline\BacklogBundle\Entity\User",
     *     inversedBy="comment"
     * )
     * @ORM\JoinColumn(nullable=false)
     */
    private $creator;


}
