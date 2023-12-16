<?php
declare(strict_types=1);

namespace Queue\Utils;

enum QueuedJobPriority: int
{
    case LOW = 1;
    case MEDIUM_LOW = 2;
    case MEDIUM = 3;
    case MEDIUM_HIGH = 4;
    case HIGH = 5;
}