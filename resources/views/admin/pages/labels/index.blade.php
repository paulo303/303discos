@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $title }} <a href="{{ route('labels.create') }}" class="btn btn-dark">Adicionar novo selo</a> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Selos</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('labels.index') }}" method="get" class="form form-inline">
                <input type="text" name="search" id="search" placeholder="Nome" class="form-control" value="{{ $filters['search'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="text-center" width="200"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($labels as $label)
                        <tr>
                            <td>
                                {{ $label->name }}
                            </td>
                            <td class="text-center">
                                {{-- <a href="{{ route('labels.edit', $label->id) }}" class="btn btn-info">EDIT</a> --}}
                                <a href="{{ route('labels.show', $label->url) }}" class="btn btn-warning">Ver releases</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" align="center">Nenhum resultado encontrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {{ $labels->appends($filters)->links() }}
            @else
                {{ $labels->links() }}
            @endif

        </div>
    </div>
@stop
