<?php

namespace App\Modules\Companies\Http\Controllers\Api;

use App\Bootstrap\Http\Controllers\Controller;
use App\Modules\Companies\Repositories\CompaniesRepository;

class CompaniesController extends Controller
{

    private $companiesRepository;

    function __construct(CompaniesRepository $companiesRepository)
    {
        $this->companiesRepository = $companiesRepository;
    }

    public function index()
    {
        return response()->json(
            $this->companiesRepository->all()
        );
    }
}
