<?php
declare(strict_types=1);

namespace MeowBlog\Job;

use Cake\Core\Configure;
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
        if (Configure::read('MeowBlog.openai_api_key') == null) {
            return false;
        }

        if (!is_null($data)) {
            $data = json_decode($data, true);
        }

        $ai = new OpenaiChatService();
        $result = $ai->getTextSummary($data['original_text']);

        $at = $this->fetchTable('MeowBlog.Nodes');
        $node = $at->get($data['node_id']);
        $node->summary = $result;
        $at->save($node);
        
        return true;
    }
}