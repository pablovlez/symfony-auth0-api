<?php

/**
 * This file contains the WebServiceAnonymousUser class for representing anonymous users.
 *
 * @package App\Security\User
 * @author  Symfony Auth0 API
 * @since   1.0.0
 */

namespace App\Security\User;

/**
 * Anonymous user implementation for unauthenticated access.
 *
 * This class extends WebServiceUser to represent users who are not authenticated
 * but still need to be represented in the security system. It's used for
 * endpoints that allow anonymous access.
 *
 * @package App\Security\User
 */
class WebServiceAnonymousUser extends WebServiceUser
{
    /**
     * WebServiceAnonymousUser constructor.
     *
     * Creates an anonymous user with no JWT data and the special
     * 'IS_AUTHENTICATED_ANONYMOUSLY' role that indicates anonymous access.
     */
    public function __construct()
    {
        parent::__construct(null, array('IS_AUTHENTICATED_ANONYMOUSLY'));
    }

    /**
     * Get username for anonymous user.
     *
     * Anonymous users don't have a username, so this always returns null.
     * This overrides the parent method to ensure anonymous users are
     * properly identified.
     *
     * @return string|null Always returns null for anonymous users
     */
    public function getUsername(): ?string
    {
        return null;
    }
}
