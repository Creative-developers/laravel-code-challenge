<?php
namespace App\Traits;
use Illuminate\Support\Facades\Cache;
use App\Models\ApiData;

trait ApiDataCacheTrait
{
    private $cacheKey = 'api_data';

    public function getApiData(): array
    {
        return $this->apiData ?? [];
    }

    public function setApiData(array $data): void
    {
        $this->apiData = $data;
    }

    public function shouldRefreshApiData(): bool
    {
        $lastRefreshed = Cache::get($this->cacheKey . '_last_refreshed');
        return (time() - $lastRefreshed) > 3600; 
    }

    public function setApiDataLastRefreshed(): void
    {
        Cache::put($this->cacheKey . '_last_refreshed', time(), now()->addHour());
        $this->apiDataLastRefreshed = time();
    }

    public function refreshAPIData(): array
    {
       Cache::forget($this->cacheKey . '_last_refreshed');
       return $this->getCachedApiData();
    }

    public function getCachedApiData(): array
    {
        if (Cache::has($this->cacheKey.'_last_refreshed')) {
            $this->apiData = Cache::get($this->cacheKey.'_last_refreshed');
        } else {
            if ($this->shouldRefreshApiData()) {
                ApiData::truncate();
                $data = $this->fetchApiData();
                $this->setApiData($data);
                $this->setApiDataLastRefreshed();
                // Save the data to the database
                $fetchedData = new ApiData(['data' => json_encode($data)]);
                $fetchedData->save();
                Cache::put($this->cacheKey . '_last_refreshed', $data, now()->addHour());
            } else {
                $fetchedData = ApiData::latest()->first();
                if ($fetchedData){
                    $data = $fetchedData->data;
                    $this->setApiData($data);
                }
            }
        }

        return $this->getApiData();
    }

    abstract protected function fetchApiData(): array;
}

?>