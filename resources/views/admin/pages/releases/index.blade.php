@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Releases</li>
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
                    <a href="{{ route('releases.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Novo Release
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6  right text-right">
                    <form action="{{ route('releases.index') }}" method="get" class="form-inline" style="display: block;">
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
                        <th width=""></th>
                        <th width="">Selo</th>
                        <th width="">Release Number</th>
                        <th width="">Cat Number</th>
                        <th class="text-center" width="200">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($releases as $release)
                        <tr>
                            <td style="vertical-align: middle;">
                                @if ($release->image)
                                    <a href="{{ url("{$release->image}") }}" target="_blank">
                                        <img src="{{ url("{$release->image}") }}" alt="{{ $release->cat_num }}" width="100">
                                    </a>
                                @else
                                    <img src="{{ url("images/no-image.jpg") }}" alt="{{ $release->cat_num }}" width="100">
                                @endif
                            </td>
                            <td style="vertical-align: middle;">
                                {{ $release->label->name }}
                            </td>
                            <td style="vertical-align: middle;">
                                {{ $release->release_num }}
                            </td>
                            <td style="vertical-align: middle;">
                                {{ $release->cat_num }}
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                <a href="{{ route('releases.edit', $release->cat_num) }}" class="btn btn-outline-info">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" align="center">Nenhum resultado encontrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {{ $releases->appends($filters)->links() }}
            @else
                {{ $releases->links() }}
            @endif

        </div>
    </div>
@stop
