<?php

namespace Claroline\BacklogBundle\Controller;

use Claroline\BacklogBundle\Entity\Ticket;
use Claroline\BacklogBundle\Entity\Status;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;

class BacklogController extends Controller
{
    /**
     * @EXT\Route("/tickets", name="tickets")
     * @EXT\Template
     */
    public function ticketsAction()
    {
        $tickets = $this->get('doctrine.orm.entity_manager')
            ->getRepository('ClarolineBacklogBundle:Ticket')
            ->findAll();

        return array('tickets' => $tickets);
    }

    /**
     * @EXT\Route("/tickets/new", name="new_ticket_form")
     * @EXT\Template
     */
    public function ticketFormAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('title', 'text', array('max_length' => 80, 'required' => true, 'label' => 'Sujet'))
            ->add('description', 'textarea', array('required' => false, 'label' => 'Description'))
            ->add('time', 'text', array('max_length' => 80, 'required' => false, 'label' => 'Temps'))
            ->add('path', 'text', array('max_length' => 80, 'required' => false, 'label' => 'Chemin'))
            ->add('status', 'collection', array('options' => array('data_class' => 'Claroline\BacklogBundle\Entity\Status')))
            ->add('save', 'submit')
            ->getForm();

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $ticket = new Ticket();
                $ticket->setTitle($form->get('title')->getData());
                $ticket->setCreator($this->getUser());
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($ticket);
                $em->flush();

                return $this->redirect($this->generateUrl('tickets'));
            }
        }

        return array('form' => $form->createView());
    }

    /**
     * @EXT\Route("/status/new", name="new_status_form")
     * @EXT\Template
     */
    public function statusFormAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('statusName', 'text', array('max_length' => 80, 'required' => true, 'label' => 'Status'))
            ->add('save', 'submit')
            ->getForm();

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $status = new Status();
                $status->setStatus($form->get('statusName')->getData());
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($status);
                $em->flush();

                return $this->redirect($this->generateUrl('tickets'));
            }
        }

        return array('form' => $form->createView());
    }
}
