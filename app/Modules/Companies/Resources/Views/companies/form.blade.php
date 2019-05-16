@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="header mt-md-5">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1 class="header-title">
                                    {{ isset($company) ? 'Editar Empresas' : 'Criar Empresas' }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        @component('components.alert')@endcomponent
                        @if(isset($company))
                            {!! Form::model($company, ['route' => ['companies.update', $company->id], 'method' => 'put']) !!}
                        @else
                            {!! Form::open(['method' => 'post', 'route' => ['companies.store']]) !!}
                        @endif
                        <div class="row">
                            <div class="col-lg-5">
                                {!! Form::openGroup('name', 'Nome') !!}
                                {!! Form::text('name', null, ['required']) !!}
                                {!! Form::closeGroup() !!}
                            </div>
                            <div class="col-lg-5">
                                {!! Form::openGroup('website', 'Website') !!}
                                {!! Form::text('website', null, ['required']) !!}
                                {!! Form::closeGroup() !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::openGroup('active', 'Situação') !!}
                                {!! Form::select('active', [1 => 'Ativo', 0=> 'Inativo'], null, ["data-toggle" => "select"]) !!}
                                {!! Form::closeGroup() !!}
                            </div>
                        </div>
                        <hr class="mt-5 mb-5">
                        <button type="submit" class="btn btn-block btn-primary">
                            Salvar
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-block btn-link text-muted">
                            Cancelar
                        </a>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
