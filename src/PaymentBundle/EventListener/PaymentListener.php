<?php

namespace PaymentBundle\EventListener;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Doctrine\ORM\Event\LifecycleEventArgs;
use PaymentBundle\Entity\Bill;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PaymentListener
{
    private $mailer;
    private $router;
    private $from;

    public function __construct(\Swift_Mailer $mailer, Router $router, $from)
    {
        $this->mailer = $mailer;
        $this->router = $router;
        $this->from   = $from;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Bill) {
            return;
        }

        $msg = \Swift_Message::newInstance()
            ->setSubject('Confirmation de paiement')
			->setFrom($from)
            ->setTo($entity->getCustomer()->getEmail())
            ->addPart(
                " Vous avez payé le montant initial de " .$entity->getAmount() ." € \n".
                " Le ". $entity->getDatePayment()->format('d M Y H:i')
            );

        $this->mailer->send($msg);
    }
}