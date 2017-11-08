<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Criteria\MyCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

class PostRepository extends BaseRepository implements CacheableInterface
{

    // protected $cacheExcept = ['all'];

    use CacheableRepository;

    // cac field de search
    protected $fieldSearchable = [
        'title' => 'like',
        'body' => 'like'
    ];
    
    public function boot()
    {
        // $this->pushCriteria(new MyCriteria());

        // search nhanh
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

    public function model()
    {
        return "App\\Post";
    }
}
