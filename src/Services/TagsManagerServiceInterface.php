<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\ORM\Table;
use MeowBlog\Model\Table\ArticlesTable;

interface TagsManagerServiceInterface
{
    /**
     * getAll function
     *
     * @return Table|ArticlesTable
     */
    public function getAll(): Table|ArticlesTable;
}