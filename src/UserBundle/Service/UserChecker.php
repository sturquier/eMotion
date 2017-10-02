<?php

namespace UserBundle\Service;

use UserBundle\Entity\User;
use FOS\UserBundle\Model\UserInterface;

class UserChecker 
{
    public function check(User $user, UserInterface $current_user)
    {
        return $user == $current_user;
    }
}