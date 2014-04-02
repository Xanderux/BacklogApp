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
     * @EXT\Route("/tickets/new", name="create_ticket")
     * @EXT\Template("ClarolineBacklogBundle:Backlog:ticketForm.html.twig")
     */
    public function createTicketAction(Request $request)
    {
        $form = $this->createFormBuilder(new Ticket())
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
                $ticket = $form->getData();
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
     * @EXT\Route("/tickets/update/{ticket}", name="update_ticket")
     * @EXT\Template("ClarolineBacklogBundle:Backlog:ticketForm.html.twig")
     * @EXT\ParamConverter("ticket", class="ClarolineBacklogBundle:Ticket")
     * @EXT\Template("ClarolineBacklogBundle:Backlog:ticketForm.html.twig")
     */
    public function updateTicketAction(Request $request, Ticket $ticket)
    {
        $form = $this->createFormBuilder($ticket)
            ->add('title', 'text')
            ->add('save', 'submit')
            ->getForm();

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($ticket);
                $em->flush();

                return $this->redirect($this->generateUrl('tickets'));
            }
        }

        return array('form' => $form->createView());
    }


    /**
     * @EXT\Route("/status", name="status")
     * @EXT\Template
     */
    public function StatusAction()
    {
        $status = $this->get('doctrine.orm.entity_manager')
            ->getRepository('ClarolineBacklogBundle:Status')
            ->findAll();

        return array('status' => $status);
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

                return $this->redirect($this->generateUrl('status'));
            }
        }

        return array('form' => $form->createView());
    }
}
