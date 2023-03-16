<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Traits\ApiDataCacheTrait;
use App\Interfaces\ApiDataCacheInterface;
use Illuminate\Support\Facades\Http;

class DataController extends Controller implements ApiDataCacheInterface
{
    use ApiDataCacheTrait;

    protected function fetchApiData(): array{
        $response = Http::get('https://cspf-dev-challenge.herokuapp.com/');
        return $response->json();
    }


    public function getData(){
       return $this->getCachedApiData();
    }

    public function refreshData(): array{
        return $this->refreshAPIData();
    }

    public function loadView(){
        $data =  $this->getData();
        return view('dashboard', ['data'=> $data]);
    }
}


?>