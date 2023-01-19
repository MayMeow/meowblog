<?php
declare(strict_types=1);

namespace MeowBlog\Policy;

use Authorization\IdentityInterface;
use MeowBlog\Model\Entity\Tag;

/**
 * Tag policy
 */
class TagPolicy
{
    /**
     * Check if $user can add Tag
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Tag $tag Tag
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Tag $tag)
    {
        return true;
    }

    /**
     * Check if $user can edit Tag
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Tag $tag Tag
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Tag $tag)
    {
        return true;
    }

    /**
     * Check if $user can delete Tag
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Tag $tag Tag
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Tag $tag)
    {
        return true;
    }

    /**
     * Check if $user can view Tag
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Tag $tag Tag
     * @return bool
     */
    public function canView(IdentityInterface $user, Tag $tag)
    {
        return true;
    }
}
