<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    public $model;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

}
