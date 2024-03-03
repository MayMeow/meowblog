<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Datasource\EntityInterface;
use Cake\Http\ServerRequest;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Table;
use MeowBlog\Model\Entity\User;
use MeowBlog\Model\Table\UsersTable;

class UsersManagerService implements UsersManagerServiceInterface
{
    use LocatorAwareTrait;

    protected Table | UsersTable $users;

    /**
     * UsersManagerService constructor.
     */
    public function __construct()
    {
        $this->users = $this->fetchTable('Users');
    }

    /**
     * @param bool $withRelations Whether to fetch relations
     * @return \Cake\ORM\Table
     */
    public function getAll(bool $withRelations = false): Table
    {
        return $this->users;
    }

    /**
     * @param string $id User ID
     * @param bool $withRelations Whether to fetch relations
     * @return \Cake\Datasource\EntityInterface|\MeowBlog\Model\Entity\User
     */
    public function getOne(string $id, bool $withRelations = false): EntityInterface | User
    {
        $q = $this->users->find()->where(['id' => $id]);

        if ($withRelations) {
            $q->contain(['Nodes']);
        }

        //TODO fix this in next version
        /** @phpstan-ignore-next-line */
        return $q->firstOrFail();
    }

    /**
     * @param \MeowBlog\Model\Entity\User $user User
     * @param \Cake\Http\ServerRequest $request Request
     * @return \MeowBlog\Model\Entity\User|false
     */
    public function saveToDatabase(User $user, ServerRequest $request): User | false
    {
        $user = $this->users->patchEntity($user, $request->getData());

        /** @var \MeowBlog\Model\Entity\User $user */
        return $user = $this->users->save($user) !== false ? $user : false;
    }
}
