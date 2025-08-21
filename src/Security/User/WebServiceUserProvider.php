<?php

/**
 * This file contains the WebServiceUserProvider class for managing JWT-based user authentication.
 *
 * @package App\Security\User
 * @author  Symfony Auth0 API
 * @since   1.0.0
 */

namespace App\Security\User;

use Auth0\JWTAuthBundle\Security\Core\JWTUserProviderInterface;
use Symfony\Component\Intl\Exception\NotImplementedException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User provider for JWT-based authentication with Auth0.
 *
 * This class implements JWTUserProviderInterface to provide user objects
 * based on JWT tokens received from Auth0. It handles both authenticated
 * and anonymous users in the security system.
 *
 * @package App\Security\User
 */
class WebServiceUserProvider implements JWTUserProviderInterface
{
    /**
     * Load user from JWT token.
     *
     * Creates a WebServiceUser instance from the provided JWT token data.
     * Extracts the user's subject (sub) and assigns the appropriate roles
     * for OAuth authentication.
     *
     * @param object $jwt JWT token object containing user information
     *
     * @return WebServiceUser User instance created from JWT data
     */
    public function loadUserByJWT($jwt): WebServiceUser
    {
        $data = ['sub' => $jwt->sub];
        $roles = array();
        $roles[] = 'ROLE_OAUTH_AUTHENTICATED';

        return new WebServiceUser($data, $roles);
    }

    /**
     * Get anonymous user instance.
     *
     * Returns a WebServiceAnonymousUser for handling unauthenticated requests
     * that still need to be processed by the security system.
     *
     * @return WebServiceAnonymousUser Anonymous user instance
     */
    public function getAnonymousUser(): WebServiceAnonymousUser
    {
        return new WebServiceAnonymousUser();
    }

    /**
     * Load user by username.
     *
     * This method is required by UserProviderInterface but is not implemented
     * for JWT authentication as users are loaded from tokens, not usernames.
     *
     * @param string $username The username to load
     *
     * @throws NotImplementedException Always thrown as this method is not supported
     *
     * @return never This method never returns successfully
     */
    public function loadUserByUsername($username): never
    {
        throw new NotImplementedException('method not implemented');
    }

    /**
     * Refresh user instance.
     *
     * Refreshes the provided user instance. For JWT authentication,
     * this delegates to loadUserByUsername, though that method is
     * not implemented for this provider.
     *
     * @param UserInterface $user The user to refresh
     *
     * @throws UnsupportedUserException If the user is not a WebServiceUser instance
     * @throws NotImplementedException  When trying to refresh via username
     *
     * @return UserInterface The refreshed user instance
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof WebServiceUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * Check if this provider supports the given user class.
     *
     * Determines whether this provider can handle users of the specified class.
     * Only supports WebServiceUser instances.
     *
     * @param string $class The fully qualified class name to check
     *
     * @return bool True if the class is supported, false otherwise
     */
    public function supportsClass($class): bool
    {
        return $class === 'App\Security\User\WebServiceUser';
    }
}
