<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Table;
use MeowBlog\Model\Table\ArticlesTable;

class TagsManagerService implements TagsManagerServiceInterface
{
    use LocatorAwareTrait;

    /**
     * Undocumented variable
     *
     * @var Table|ArticlesTable
     */
    protected Table|ArticlesTable $tags;

    public function __construct()
    {
        $this->tags = $this->fetchTable('Tags');
    }

    /**
     * Undocumented function
     *
     * @return Table|ArticlesTable
     */
    public function getAll(): Table|ArticlesTable
    {
        return $this->tags;
    }
}