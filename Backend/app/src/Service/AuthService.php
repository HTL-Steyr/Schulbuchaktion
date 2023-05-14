<?php

namespace app\src\Service;

use app\src\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class AuthService
{
    private ManagerRegistry $registry;

    public function __construct( ManagerRegistry $registry){
        $this->registry=$registry;
    }
    public function authenticateByAuthorizationHeader(Request $request) :?User{


        $bearer = $request->headers->get("Authorization");
        $bearer = str_replace("Bearer ", "", $bearer);

        $user = $this->registry->getRepository(User::class)->findOneBy(["token" => $bearer]);

        if (isset($user)) {
            if (time() < $user->getTimestamp()) {
                $user->setTimestamp(time()+60*10);
                $this->registry->getRepository(User::class)->save($user,true);
                return $user;
            }

        }
        return null;

    }

}