@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Usuários</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <a href="{{ route('users.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Novo Usuário
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6  right text-right">
                    <form action="{{ route('users.index') }}" method="get" class="form-inline" style="display: block;">
                        <input type="text" name="search" id="search" placeholder="Nome" class="form-control" value="{{ $filters['search'] ?? '' }}">
                        <button type="submit" class="btn btn-dark">Filtrar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="">Nome</th>
                        <th width="">E-mail</th>
                        <th width="">Tipo de usuário</th>
                        <th class="text-center" width="200">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td style="vertical-align: middle;">
                                {{ $user->name }}
                            </td>
                            <td style="vertical-align: middle;">
                                {{ $user->email }}
                            </td>
                            <td style="vertical-align: middle;">
                                {{ $user->userType->name }}
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-info">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" align="center">Nenhum resultado encontrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {{ $users->appends($filters)->links() }}
            @else
                {{ $users->links() }}
            @endif

        </div>
    </div>
@stop
