<?php
declare(strict_types=1);

namespace Queue\Utils;

enum QueuedJobStatus: int
{
    case PENDING = 1;
    case RUNNING = 2;
}