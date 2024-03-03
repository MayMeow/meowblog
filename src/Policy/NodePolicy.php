<?php
declare(strict_types=1);

namespace MeowBlog\Policy;

use Authentication\IdentityInterface as AuthenticationInterface;
use Authorization\IdentityInterface;
use MeowBlog\Model\Entity\Node;

/**
 * Node policy
 */
class NodePolicy
{
    /**
     * Check if $user can add Node
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Node $node Node
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Node $node)
    {
        return true;
    }

    /**
     * Check if $user can edit Node
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Node $node Node
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Node $node)
    {
        /** @var \Authentication\IdentityInterface $authenticatedUser */
        $authenticatedUser = $user;

        return $this->isAuthor($authenticatedUser, $node);
    }

    /**
     * Check if $user can delete Node
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Node $node Node
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Node $node)
    {
        /** @var \Authentication\IdentityInterface $authenticatedUser Authenticated user interface */
        $authenticatedUser = $user;

        return $this->isAuthor($authenticatedUser, $node);
    }

    /**
     * Check if $user can view Node
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Node $node Node
     * @return bool
     */
    public function canView(IdentityInterface $user, Node $node)
    {
        /** @var \Authentication\IdentityInterface $authenticatedUser */
        $authenticatedUser = $user;

        return $this->isAuthor($authenticatedUser, $node);
    }

    /**
     * Check if $user is Author of node
     *
     * @param \Authentication\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Node $node Node
     * @return bool
     */
    protected function isAuthor(AuthenticationInterface $user, Node $node)
    {
        return $node->user_id === $user->getIdentifier();
    }
}
