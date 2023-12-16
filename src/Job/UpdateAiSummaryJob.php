<?php
declare(strict_types=1);

namespace MeowBlog\Job;

use Cake\ORM\Locator\LocatorAwareTrait;
use MeowBlog\Services\OpenaiChatService;
use Queue\Job\QueuedJobInterface;

class UpdateAiSummaryJob implements QueuedJobInterface
{
    use LocatorAwareTrait;

    public function getRecure(): int
    {
        return 0;
    }

    public function execute(?string $data = null): bool
    {
        if (!is_null($data)) {
            $data = unserialize($data);
        }

        /** @var \MeowBlog\Model\Entity\Article $data */

        $ai = new OpenaiChatService();
        $result = $ai->getTextSummary($data->body);

        $at = $this->fetchTable('MeowBlog.Articles');
        $article = $at->get($data->id);
        $article->summary = $result;
        $at->save($article);
        
        return true;
    }
}