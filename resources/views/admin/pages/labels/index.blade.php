@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb">
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
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <a href="{{ route('labels.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Novo Selo
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6  right text-right">
                    <form action="{{ route('labels.index') }}" method="get" class="form-inline" style="display: block;">
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
                        <th width="200px"></th>
                        <th width="">Nome</th>
                        <th width="">Discogs</th>
                        <th class="text-center" width="200">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($labels as $label)
                        <tr>
                            <td style="vertical-align: middle;">
                                @if ($label->logo)
                                    <a href="{{ url("{$label->logo}") }}" target="_blank">
                                        <img src="{{ url("{$label->logo}") }}" alt="{{ $label->name }}" width="100">
                                    </a>
                                @else
                                    <img src="{{ url("images/no-image.jpg") }}" alt="{{ $label->name }}" width="100">
                                @endif
                            </td>
                            <td style="vertical-align: middle;">
                                {{ $label->name }}
                            </td>
                            <td style="vertical-align: middle;">
                                <a href="{{ $label->discogs }}" target="_blank">{{ $label->discogs }}</a>
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                <a href="{{ route('labels.edit', $label->url) }}" class="btn btn-outline-info">Editar</a>
                                <a href="{{ route('labels.show', $label->url) }}" class="btn btn-outline-warning">Ver releases</a>
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
                {{ $labels->appends($filters)->links() }}
            @else
                {{ $labels->links() }}
            @endif

        </div>
    </div>
@stop
