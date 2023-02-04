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
    
    protected Table|UsersTable $users;

    public function __construct()
    {
        $this->users = $this->fetchTable('Users');
    }

    public function getAll(bool $withRelations = false): Table | UsersTable
    {
        return $this->users;
    }

    public function getOne(string $id, bool $withRelations = false): EntityInterface | User
    {
        $q = $this->users->find()->where(['id' => $id]);

        if ($withRelations) {
            $q->contain(['Articles']);
        }

        return $q->firstOrFail();
    }

    public function saveToDatabase(User $user, ServerRequest $request): User | false
    {
        $user = $this->users->patchEntities($user, $request->getData());

        return $this->users->save($user);
    }
}