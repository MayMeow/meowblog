<?php
declare(strict_types=1);

namespace MeowBlog\Policy;

use Authorization\IdentityInterface;
use MeowBlog\Model\Entity\Link;

/**
 * Link policy
 */
class LinkPolicy
{
    /**
     * Check if $user can add Link
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Link $link
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Link $link)
    {
        return true;
    }

    /**
     * Check if $user can edit Link
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Link $link
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Link $link)
    {
        return true;
    }

    /**
     * Check if $user can delete Link
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Link $link
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Link $link)
    {
        return true;
    }

    /**
     * Check if $user can view Link
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Link $link
     * @return bool
     */
    public function canView(IdentityInterface $user, Link $link)
    {
        return true;
    }
}
