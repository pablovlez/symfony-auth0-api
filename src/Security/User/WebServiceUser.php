<?php

/**
 * This file contains the WebServiceUser class for representing authenticated users from web services.
 *
 * @package App\Security\User
 * @author  Symfony Auth0 API
 * @since   1.0.0
 */

namespace App\Security\User;

use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Web service user implementation for JWT-based authentication.
 *
 * This class represents a user authenticated through a web service (Auth0) using JWT tokens.
 * It implements both UserInterface and EquatableInterface to provide full integration
 * with Symfony's security system.
 *
 * @package App\Security\User
 */
class WebServiceUser implements UserInterface, EquatableInterface
{
    /**
     * User roles collection.
     *
     * @var array<string> Array of role strings assigned to the user
     */
    private $roles;

    /**
     * JWT token data.
     *
     * @var array<string, mixed>|null JWT payload data containing user information
     */
    private $jwt;

    /**
     * WebServiceUser constructor.
     *
     * Creates a new web service user instance with the provided JWT data and roles.
     *
     * @param array<string, mixed>|null $jwt   JWT payload data containing user information
     * @param array<string>             $roles Array of role strings to assign to the user
     */
    public function __construct($jwt, array $roles)
    {
        $this->roles = $roles;
        $this->jwt = $jwt;
    }

    /**
     * Get user roles.
     *
     * Returns all roles assigned to this user. This method is required by UserInterface.
     *
     * @return array<string> Array of role strings
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * Get user password.
     *
     * Since this is a JWT-based authentication system, passwords are not stored
     * or managed locally, so this always returns null.
     *
     * @return string|null Always returns null for JWT authentication
     */
    public function getPassword(): ?string
    {
        return null;
    }

    /**
     * Get password salt.
     *
     * Since passwords are not stored locally in JWT authentication,
     * salt is not needed and this always returns null.
     *
     * @return string|null Always returns null for JWT authentication
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * Get username identifier.
     *
     * Returns the user's email if available in the JWT payload, otherwise
     * falls back to the 'sub' (subject) field from the JWT.
     *
     * @return string The user's identifier (email or subject)
     */
    public function getUsername(): string
    {
        return isset($this->jwt["email"]) ? $this->jwt["email"] : $this->jwt["sub"];
    }

    /**
     * Erase sensitive credentials.
     *
     * This method is called after authentication to remove any sensitive
     * data that should not be stored in the session. For JWT authentication,
     * no action is needed as credentials are managed externally.
     *
     * @return void
     */
    public function eraseCredentials(): void
    {
        // No sensitive data to erase for JWT authentication
    }

    /**
     * Check if this user is equal to another user.
     *
     * This method is required by EquatableInterface and is used by Symfony's
     * security system to determine if a user needs to be re-authenticated.
     *
     * @param UserInterface $user The user to compare against
     *
     * @return bool True if the users are considered equal, false otherwise
     */
    public function isEqualTo(UserInterface $user): bool
    {
        if (!$user instanceof WebServiceUser) {
            return false;
        }

        if ($this->getUsername() !== $user->getUsername()) {
            return false;
        }

        return true;
    }
}
