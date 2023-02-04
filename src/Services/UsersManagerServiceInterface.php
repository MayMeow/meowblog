<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Datasource\EntityInterface;
use Cake\Http\ServerRequest;
use Cake\ORM\Table;
use MeowBlog\Model\Entity\User;
use MeowBlog\Model\Table\UsersTable;

interface UsersManagerServiceInterface
{
    public function getAll(bool $withRelations = false): Table | UsersTable;

    public function getOne(string $id, bool $withRelations = false): EntityInterface | User;

    public function saveToDatabase(User $user, ServerRequest $request): User | false;
}