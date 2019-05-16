@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="header mt-md-5">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1 class="header-title">
                                    Cias Aéreas
                                </h1>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('cias.create') }}" class="btn btn-primary">
                                    <i class="fe fe-plus"></i>
                                    Nova Cia Aérea
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @component('components.alert')@endcomponent
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <form class="row">
                                    <div class="col-auto pr-0">
                                        <span class="fe fe-search text-muted"></span>
                                    </div>
                                    <div class="col">
                                        <input type="search" class="form-control form-control-flush search"
                                               placeholder="Pesquisar" name="search" value="{{Request::get('search')}}">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-nowrap card-table">
                            <thead>
                            <tr>
                                <th class="thIds">#</th>
                                <th>Nome</th>
                                <th>Situação</th>
                                <th class="thActions">Ações</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @forelse($cias as $cia)
                                <tr>
                                    <td>{{ $cia->id }}</td>
                                    <td>{{ $cia->name }}</td>
                                    <td>{{ $cia->active ? 'ATIVO' : 'INATIVO' }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-ellipses dropdown-toggle" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                {!! Form::open(['method' => 'get', 'route' => ['cias.edit', $cia->id ]]) !!}
                                                {!! Form::button('<i class="fe fe-edit"></i> Editar', ['type' => 'submit', 'class' => 'dropdown-item']) !!}
                                                {!! Form::close() !!}

                                                {!! Form::open(['class' => 'form-remove', 'method' => 'delete', 'data-confirm' => 'Esta ação é irreverível!', 'route' => ['cias.destroy', $cia->id]] ) !!}
                                                {!! Form::button('<i class="fe fe-trash"></i> Deletar', ['type' => 'submit', 'class' => 'dropdown-item']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Nenhum registro encontrado.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
