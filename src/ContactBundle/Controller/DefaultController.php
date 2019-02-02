<?php

namespace ContactBundle\Controller;

use ContactBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/messages", name="list_messages_page")
     */
    public function indexAction()
    {
        $messages = $this->getDoctrine()->getManager()->getRepository(Message::class)->findBy(array('enabled' => true));
        return $this->render('@Contact/Default/list.html.twig', array(
            'messages' => $messages
        ));
    }

    /**
     * @Route("/messages/delete/{id}", name="delete_message_page")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $message = $em->getRepository(Message::class)->find($id);
        $message->setEnabled(false);
        $em->flush();
        return $this->redirectToRoute('list_messages_page');
    }
}
