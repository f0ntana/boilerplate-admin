<?php

namespace App\Modules\Companies\Http\Controllers;

use App\Modules\Companies\Repositories\CiasRepository;
use App\Modules\Companies\Http\Requests\CiaRequest;
use App\Bootstrap\Http\Controllers\Controller;
use App\Modules\Companies\Models\Cia;
use Illuminate\Http\Request;
use Exception;

class CiasController extends Controller
{

    /* @var CiasRepository */
    protected $ciasRepository;

    /**
     * CiasController constructor.
     * @param CiasRepository $ciasRepository
     */
    public function __construct(CiasRepository $ciasRepository)
    {
        $this->ciasRepository = $ciasRepository;
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
        $this->authorize('cias.index');
        $cias = $this->ciasRepository
            ->fetchAll(
                $request->get('search'),
                $request->get('per_page')
            );

        return view('companies::cias.index', compact('cias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('cias.create');

        return view('companies::cias.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CiaRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CiaRequest $request)
    {
        $this->authorize('cias.create');
        try {
            $data = $request->only(['name']);
            $data['active'] = $request->has('active');

            $this->ciasRepository->create($data);
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withError('Não foi possível salvar o registro. Motivo: ' . $e->getMessage());
        }

        return redirect()
            ->route('cias.index')
            ->withSuccess('Registro criado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Cia $cia
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Cia $cia)
    {
        $this->authorize('cias.edit');
        return view('companies::cias.form', compact('cia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CiaRequest $request
     * @param Cia $cia
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(CiaRequest $request, Cia $cia)
    {
        $this->authorize('cias.edit');

        try {
            $data = $request->only(['name']);
            $data['active'] = $request->has('active');
            $this->ciasRepository->update($cia, $data);
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withError('Não foi possível salvar o registro. Motivo: ' . $e->getMessage());
        }

        return redirect()
            ->route('cias.index')
            ->withSuccess('Registro alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cia $cia
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Cia $cia)
    {
        $this->authorize('cias.destroy');
        $this->ciasRepository->destroy($cia);

        return redirect()
            ->route('cias.index')
            ->withSuccess('Registro foi deletado com sucesso.');
    }
}
