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

    public function __construct(\Swift_Mailer $mailer, Router $router)
    {
        $this->mailer = $mailer;
        $this->router = $router;
    }

    /*public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Bill) {
            return;
        }

        $msg = \Swift_Message::newInstance()
            ->setSubject('Confirmation de paiement')
			->setFrom('admin@example.com')
            ->setTo($entity->getCustomer())
            ->addPart(
                " Vous avez payé le montant initial de " .$entity->getAmount() ."\n"
                " Le ". $entity->getDatePayment()
            );

        $this->mailer->send($msg);
    }*/
}