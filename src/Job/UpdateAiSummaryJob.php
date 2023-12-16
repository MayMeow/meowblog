<?php
declare(strict_types=1);

namespace MeowBlog\Job;

use Queue\Job\QueuedJobInterface;

class UpdateAiSummaryJob implements QueuedJobInterface
{
    public function execute(): bool
    {
        return true;
    }
}