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
                                    {{ isset($user) ? 'Editar Usuário' : 'Criar Usuário' }}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        @component('components.alert')@endcomponent
                        @if(isset($user))
                            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
                        @else
                            {!! Form::open(['method' => 'post', 'route' => ['users.store']]) !!}
                        @endif
                        <div class="row">
                            <div class="col-lg-5">
                                {!! Form::openGroup('role_id', 'Perfil') !!}
                                {!! Form::select('role_id', $roles, null, ['required', "data-toggle" => "select"]) !!}
                                {!! Form::closeGroup() !!}
                            </div>
                            <div class="col-lg-5">
                                {!! Form::openGroup('name', 'Nome') !!}
                                {!! Form::text('name', null, ['required']) !!}
                                {!! Form::closeGroup() !!}
                            </div>
                            <div class="col-lg-2">
                                {!! Form::openGroup('active', 'Ativo') !!}
                                {!! Form::select('active', [ 1 => 'Sim', 0 => 'Não'], null, ['required', "data-toggle" => "select"]) !!}
                                {!! Form::closeGroup() !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                {!! Form::openGroup('email', 'E-mail') !!}
                                {!! Form::text('email', null, ['required']) !!}
                                {!! Form::closeGroup() !!}
                            </div>
                            <div class="col-lg-4">
                                {!! Form::openGroup('password', 'Senha') !!}
                                {!! Form::password('password') !!}
                                {!! Form::closeGroup() !!}
                            </div>
                            <div class="col-lg-4">
                                {!! Form::openGroup('document', 'Documento') !!}
                                {!! Form::text('document', null, ['required']) !!}
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
