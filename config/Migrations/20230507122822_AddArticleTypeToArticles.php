<?php
declare(strict_types=1);

use MeowBlog\Model\Entity\ArticleType;
use Migrations\AbstractMigration;

class AddArticleTypeToArticles extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('articles');
        $table->addColumn('article_type', 'string', [
            'default' => ArticleType::Article->value,
            'limit' => 50,
            'null' => false,
        ]);
        $table->update();
    }
}
