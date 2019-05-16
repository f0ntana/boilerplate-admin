@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="header-body">
        <div class="row align-items-end">
            <div class="col">
                <h6 class="header-pretitle">
                    Overview
                </h6>
                <h1 class="header-title">
                    Dashboard
                </h1>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <br/>
    <div class="row">
        <div class="col-12 col-lg-6 col-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="card-title text-uppercase text-muted mb-2">
                                Usuários
                            </h6>
                            <span class="h2 mb-0">
                                {{ $users }}
                            </span>
                        </div>
                        <div class="col-auto">
                            <span class="h2 fe fe-user text-muted mb-0"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="card-title text-uppercase text-muted mb-2">
                                Empresas
                            </h6>
                            <span class="h2 mb-0">
                                {{ $companies }}
                            </span>
                        </div>
                        <div class="col-auto">
                            <span class="h2 fe fe-trending-up text-muted mb-0"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
