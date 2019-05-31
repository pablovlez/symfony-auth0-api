<?php

namespace App\Security\User;

use Auth0\JWTAuthBundle\Security\Core\JWTUserProviderInterface;
use Symfony\Component\Intl\Exception\NotImplementedException; 
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;


class WebServiceUserProvider implements JWTUserProviderInterface {
    
    public function loadUserByJWT($jwt){
        $data = ['sub' => $jwt->sub];
        $roles = array();
        $roles[] = 'ROLE_OAUTH_AUTHENTICATE';

        return new WebServiceUser($jwt, $roles);
    }

    public function getAnonymousUser(){
        return new WebServiceAnonymousUser();
    }

    public function loadUserByUserName($username){
        throw new NotImplementedException('Method not implemented');
    }

    public function refreshUser(UserInterface $user){

        if(!$user instanceof WebServiceUser){
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported', get_class($user))
            );
        }

        return $this->loadUserByUserName($user->getUsername());
    }

    public function supportsClass($class){
        return $clas === 'App\Security\User\WebServiceUser';
    }


}