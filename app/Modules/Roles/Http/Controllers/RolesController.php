<?php

namespace App\Modules\Roles\Http\Controllers;

use App\Modules\Roles\Http\Requests\RoleRequest;
use App\Modules\Roles\Models\Role;
use App\Modules\Roles\Repositories\PermissionsRepository;
use App\Modules\Roles\Repositories\RolesRepository;
use Illuminate\Http\Request;
use App\Bootstrap\Http\Controllers\Controller;
use Exception;

class RolesController extends Controller
{

    /* @var RolesRepository */
    protected $rolesRepository;

    /* @var PermissionsRepository */
    protected $permissionsRepository;

    /**
     * RolesController constructor.
     * @param RolesRepository $rolesRepository
     * @param PermissionsRepository $permissionsRepository
     */
    public function __construct(RolesRepository $rolesRepository, PermissionsRepository $permissionsRepository)
    {
        $this->rolesRepository = $rolesRepository;
        $this->permissionsRepository = $permissionsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('roles.index');
        $roles = $this->rolesRepository->fetchAll($request->get('search'), $request->get('per_page'));
        return view('roles::roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('roles.create');
        $permissions = $this->permissionsRepository->all();
        return view('roles::roles.form', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(RoleRequest $request)
    {
        $this->authorize('roles.create');

        try {
            $data = $request->only(['name', 'permissions']);
            $this->rolesRepository->create($data);
        } catch (Exception $e) {
            return redirect()->back()
                ->withError('Não foi possível salvar o registro. Motivo: ' . $e->getMessage());
        }

        return redirect()->route('roles.index')->withSuccess('Registro criado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modules\Roles\Models\Role $role
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Role $role)
    {
        $this->authorize('roles.edit');
        $permissions = $this->permissionsRepository->all();
        return view('roles::roles.form', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param  \App\Modules\Roles\Models\Role $role
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('roles.edit');
        try {
            $data = $request->only(['name', 'permissions']);
            $this->rolesRepository->update($role, $data);
        } catch (Exception $e) {
            return redirect()->back()
                ->withError('Não foi possível salvar o registro. Motivo: ' . $e->getMessage());
        }

        return redirect()->route('roles.index')->withSuccess('Registro alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Roles\Models\Role $role
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Role $role)
    {
        $this->authorize('roles.destroy');
        $this->rolesRepository->destroy($role);

        return redirect()
            ->route('roles.index')
            ->with(['success' => 'Registro foi deletado com sucesso.']);
    }
}
