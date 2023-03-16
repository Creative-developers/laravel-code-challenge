<?php
namespace App\Interfaces;

interface ApiDataCacheInterface
{
    public function getApiData(): array;

    public function setApiData(array $data): void;

    public function shouldRefreshApiData(): bool;

    public function setApiDataLastRefreshed(): void;
}

?>