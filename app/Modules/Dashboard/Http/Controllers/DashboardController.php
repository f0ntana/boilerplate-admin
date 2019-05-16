<?php

namespace App\Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use App\Bootstrap\Http\Controllers\Controller;
use App\Modules\Users\Repositories\UsersRepository;
use App\Modules\Companies\Repositories\CompaniesRepository;


class DashboardController extends Controller
{
    /**
     * Users Repository
     *
     * @var string
     */
    private $userRepository;

    /**
     * Companies Repository
     *
     * @var string
     */
    private $companiesRepository;


    /**
     * Construct method
     *
     * @param UsersRepository $userRepository
     * @param CompaniesRepository $companiesRepository
     */
    public function __construct(
        UsersRepository $userRepository,
        CompaniesRepository $companiesRepository
    ) {
        $this->userRepository = $userRepository;
        $this->companiesRepository = $companiesRepository;
    }

    /**
     * Dashboard index
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $this->authorize('users.index');
        $users = $this->userRepository->all()->count();
        $companies = $this->companiesRepository->all()->count();
        $orders = 1;
        return view('dashboard::dashboard.index', compact('users', 'adverts', 'companies', 'orders'));
    }
}
