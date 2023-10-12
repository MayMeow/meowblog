<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Http\ServerRequest;

interface BlogsManagerServiceInterface
{
    public function getTheme(ServerRequest $request): string;

    public function getSchemeVariant(ServerRequest $request): string;

    public function getName(ServerRequest $request): string;

    public function getDescription(ServerRequest $request): string;

    public function getDefaultRoute(ServerRequest $request): ?string;

    public function getId(ServerRequest $request): ?int;

    /**
     * Undocumented function
     *
     * @param ServerRequest $request
     * @return null|array<\MeowBlog\Model\Entity\Link>
     */
    public function getLinks(ServerRequest $request): ?array;

    /**
     * Clear the cache for the links that are showed in the header
     *
     * @param int $id Blog ID
     * @return void
     */
    public function clearLinkCache(int $id): void;
}