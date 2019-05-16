<?php

namespace App\Modules\Users\Http\Controllers\Api;

use App\Bootstrap\Http\Controllers\Controller;
use App\Modules\Users\Repositories\UsersRepository;
use App\Modules\Users\Resources\Json\UsersResource;

class UsersController extends Controller
{
    private $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function index()
    {
        return UsersResource::collection($this->usersRepository->all());
    }
}
