<?php

namespace App\Modules\Users\Http\Controllers;

use App\Bootstrap\Http\Controllers\Controller;
use App\Modules\Companies\Repositories\CompaniesRepository;
use App\Modules\Users\Http\Requests\UsersRequest;
use App\Modules\Users\Models\User;
use App\Modules\Roles\Repositories\RolesRepository;
use App\Modules\Users\Repositories\UsersRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /* @var UsersRepository */
    protected $usersRepository;

    /* @var RolesRepository */
    protected $rolesRepository;

    /* @var CompaniesRepository */
    protected $companiesRepository;

    /**
     * UsersController constructor.
     * @param UsersRepository $usersRepository
     * @param RolesRepository $rolesRepository
     * @param CompaniesRepository $companiesRepository
     */
    public function __construct(
        UsersRepository $usersRepository,
        RolesRepository $rolesRepository,
        CompaniesRepository $companiesRepository
    ) {
        $this->usersRepository = $usersRepository;
        $this->rolesRepository = $rolesRepository;
        $this->companiesRepository = $companiesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @throws AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('users.index');
        $users = $this->usersRepository->fetchAll($request->get('search'), $request->get('per_page'));
        return view('users::users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('users.create');
        $companies = $this->companiesRepository->select();
        $roles = $this->rolesRepository->select();
        return view('users::users.form', compact('roles', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UsersRequest $request
     * @throws AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $this->authorize('users.create');
        try {
            $data = $request->all();
            $data['active'] = $request->has('active');
            $this->usersRepository->create($data);
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withError('Não foi possível salvar o usuário. Motivo: ' . $e->getMessage());
        }

        return redirect()
            ->route('users.index')
            ->withSuccess('Usuário criado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modules\Users\Models\User $user
     * @throws AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('users.edit');

        $companies = $this->companiesRepository->select();
        $roles = $this->rolesRepository->select();

        return view('users::users.form', compact('roles', 'companies', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UsersRequest $request
     * @param  \App\Modules\Users\Models\User $user
     * @throws AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, User $user)
    {
        $this->authorize('users.edit');
        try {
            $data = $request->all();
            if (!$data['password']) {
                unset($data['password']);
            }
            $data['active'] = $request->has('active');
            $this->usersRepository->update($user, $data);
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withError('Não foi possível salvar o registro. Motivo: ' . $e->getMessage());
        }

        return redirect()
            ->route('users.index')
            ->withSuccess('Registro alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Users\Models\User $user
     * @throws AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('users.destroy');
        $this->usersRepository->destroy($user);

        return redirect()
            ->route('users.index')
            ->withSuccess('Registro foi deletado com sucesso.');
    }
}
