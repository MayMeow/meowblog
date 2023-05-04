<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Http\ServerRequest;

interface BlogsManagerServiceInterface
{
    public function getTheme(ServerRequest $request): string;

    public function getName(ServerRequest $request): string;

    public function getDescription(ServerRequest $request): string;
}