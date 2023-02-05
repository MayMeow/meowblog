<?php
declare(strict_types=1);

namespace MeowBlog\Policy;

use Authorization\IdentityInterface;
use MeowBlog\Model\Entity\Blog;

/**
 * Blog policy
 */
class BlogPolicy
{
    /**
     * Check if $user can add Blog
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Blog $blog
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Blog $blog)
    {
        return true;
    }

    /**
     * Check if $user can edit Blog
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Blog $blog
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Blog $blog)
    {
        return true;
    }

    /**
     * Check if $user can delete Blog
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Blog $blog
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Blog $blog)
    {
        return true;
    }

    /**
     * Check if $user can view Blog
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Blog $blog
     * @return bool
     */
    public function canView(IdentityInterface $user, Blog $blog)
    {
        return true;
    }
}
