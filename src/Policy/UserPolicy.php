<?php
declare(strict_types=1);

namespace MeowBlog\Policy;

use Authorization\IdentityInterface;
use MeowBlog\Model\Entity\User;

/**
 * User policy
 */
class UserPolicy
{
    /**
     * Check if $user can add User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\User $resource User
     * @return bool
     */
    public function canAdd(IdentityInterface $user, User $resource)
    {
        return true;
    }

    /**
     * Check if $user can edit User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\User $resource User
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {
        return true;
    }

    /**
     * Check if $user can delete User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\User $resource User
     * @return bool
     */
    public function canDelete(IdentityInterface $user, User $resource)
    {
        return true;
    }

    /**
     * Check if $user can view User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\User $resource User
     * @return bool
     */
    public function canView(IdentityInterface $user, User $resource)
    {
        return true;
    }
}
