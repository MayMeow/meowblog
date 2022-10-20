<?php
declare(strict_types=1);

namespace MeowBlog\Policy;

use Authentication\IdentityInterface as AuthenticationInterface;
use Authorization\IdentityInterface;
use MeowBlog\Model\Entity\Article;

/**
 * Article policy
 */
class ArticlePolicy
{
    /**
     * Check if $user can add Article
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Article $article Article
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Article $article)
    {
        return true;
    }

    /**
     * Check if $user can edit Article
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Article $article Article
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Article $article)
    {
        /** @var \Authentication\IdentityInterface $authenticatedUser */
        $authenticatedUser = $user;

        return $this->isAuthor($authenticatedUser, $article);
    }

    /**
     * Check if $user can delete Article
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Article $article Article
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Article $article)
    {
        /** @var \Authentication\IdentityInterface $authenticatedUser Authenticated user interface */
        $authenticatedUser = $user;

        return $this->isAuthor($authenticatedUser, $article);
    }

    /**
     * Check if $user can view Article
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Article $article Article
     * @return bool
     */
    public function canView(IdentityInterface $user, Article $article)
    {
        /** @var \Authentication\IdentityInterface $authenticatedUser */
        $authenticatedUser = $user;

        return $this->isAuthor($authenticatedUser, $article);
    }

    /**
     * Check if $user is Author of article
     *
     * @param \Authentication\IdentityInterface $user The user.
     * @param \MeowBlog\Model\Entity\Article $article Article
     * @return bool
     */
    protected function isAuthor(AuthenticationInterface $user, Article $article)
    {
        return $article->user_id === $user->getIdentifier();
    }
}
