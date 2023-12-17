<?php
declare(strict_types=1);

namespace Queue\Job;

interface QueuedJobInterface
{
    public function execute(?string $data = null): bool;
    public function getRecure(): int;
}