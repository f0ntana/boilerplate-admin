<?php

namespace App\Modules\Companies\Http\Controllers;

use App\Modules\Companies\Repositories\CompaniesRepository;
use App\Modules\Companies\Http\Requests\CompanyRequest;
use App\Bootstrap\Http\Controllers\Controller;
use App\Modules\Companies\Models\Company;
use Illuminate\Http\Request;
use Exception;

class CompaniesController extends Controller
{

    /* @var CompaniesRepository */
    protected $companiesRepository;

    /**
     * CompaniesController constructor.
     * @param CompaniesRepository $companiesRepository
     */
    public function __construct(CompaniesRepository $companiesRepository)
    {
        $this->companiesRepository = $companiesRepository;
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
        $this->authorize('companies.index');
        $companies = $this->companiesRepository
            ->fetchAll(
                $request->get('search'),
                $request->get('per_page')
            );

        return view('companies::companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('companies.create');

        return view('companies::companies.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CompanyRequest $request)
    {
        $this->authorize('companies.create');
        try {
            $data = $request->only(['name', 'website']);
            $data['active'] = $request->has('active');

            $this->companiesRepository->create($data);
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withError('Não foi possível salvar o registro. Motivo: ' . $e->getMessage());
        }

        return redirect()
            ->route('companies.index')
            ->withSuccess('Registro criado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Company $company)
    {
        $this->authorize('companies.edit');
        return view('companies::companies.form', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompanyRequest $request
     * @param Company $company
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $this->authorize('companies.edit');

        try {
            $data = $request->only(['name', 'website']);
            $data['active'] = $request->has('active');
            $this->companiesRepository->update($company, $data);
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withError('Não foi possível salvar o registro. Motivo: ' . $e->getMessage());
        }

        return redirect()
            ->route('companies.index')
            ->withSuccess('Registro alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Company $company)
    {
        $this->authorize('companies.destroy');
        $this->companiesRepository->destroy($company);

        return redirect()
            ->route('companies.index')
            ->withSuccess('Registro foi deletado com sucesso.');
    }
}
