<?php

namespace App\Modules\Companies\Http\Controllers\Api;

use App\Bootstrap\Http\Controllers\Controller;
use App\Modules\Companies\Repositories\CiasRepository;

class CiasController extends Controller
{

    private $ciasRepository;

    function __construct(CiasRepository $ciasRepository)
    {
        $this->ciasRepository = $ciasRepository;
    }

    public function index()
    {
        return response()->json(
            $this->ciasRepository->all()
        );
    }
}
