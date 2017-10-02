<?php

namespace LocationBundle\Service;

use LocationBundle\Entity\Offer;

class OfferChecker
{
    
    public function isAvailableOffer(Offer $offer)
    {
        return $offer->getIsAvailable() == 1;
    }
    
}