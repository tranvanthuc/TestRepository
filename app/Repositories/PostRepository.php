<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Criteria\MyCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;
use App\Validators\PostValidator;

class PostRepository extends BaseRepository implements CacheableInterface
{

    // protected $cacheExcept = ['all'];

    use CacheableRepository;

    protected $fieldSearchable = [
        'title' => 'like',
        'body' => 'like'
    ];
    
    public function boot()
    {
        $this->pushCriteria(new MyCriteria());
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

    public function model()
    {
        return "App\\Post";
    }

    public function validator()
    {
        return PostValidator::class;
    }
}
