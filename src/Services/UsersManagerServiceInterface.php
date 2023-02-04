<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Datasource\EntityInterface;
use Cake\Http\ServerRequest;
use Cake\ORM\Table;
use MeowBlog\Model\Entity\User;

interface UsersManagerServiceInterface
{
    /**
     * getAll function
     *
     * @param bool $withRelations Whether to fetch relations
     * @return \Cake\ORM\Table
     */
    public function getAll(bool $withRelations = false): Table;

    /**
     * getOne function
     *
     * @param string $id User ID
     * @param bool $withRelations Whether to fetch relations
     * @return \Cake\Datasource\EntityInterface|\MeowBlog\Model\Entity\User
     */
    public function getOne(string $id, bool $withRelations = false): EntityInterface | User;

    /**
     * saveToDatabase function
     *
     * @param \MeowBlog\Model\Entity\User $user User
     * @param \Cake\Http\ServerRequest $request Request
     * @return \MeowBlog\Model\Entity\User|false
     */
    public function saveToDatabase(User $user, ServerRequest $request): User | false;
}
