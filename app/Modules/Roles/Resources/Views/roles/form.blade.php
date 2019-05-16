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
                                    {{ isset($role) ? 'Editar Papel' : 'Criar Papel' }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($role))
                    {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'put']) !!}
                @else
                    {!! Form::open(['method' => 'post', 'route' => ['roles.store']]) !!}
                @endif
                <div class="card">
                    <div class="card-body">
                        @component('components.alert')@endcomponent
                        <div class="row">
                            <div class="col-lg-12">
                                {!! Form::openGroup('name', 'Nome') !!}
                                {!! Form::text('name', null, ['required']) !!}
                                {!! Form::closeGroup() !!}
                            </div>
                        </div>
                    </div>

                    <table class="table table-sm table-nowrap card-table">
                        <thead>
                        <tr>
                            <th colspan="2">Selecione as Permissões para este Papel</th>
                        </tr>
                        <tr>
                            <th width="100">Permitir?</th>
                            <th>Permissão</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{!! Form::checkbox("permissions[]", $permission->id) !!}</td>
                                <td>{{ $permission->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="card-body">
                        <hr class="mt-5 mb-5">

                        <button type="submit" class="btn btn-block btn-primary">
                            Salvar
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-block btn-link text-muted">
                            Cancelar
                        </a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
