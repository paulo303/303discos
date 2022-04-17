@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pedidos</li>
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
                    <a href="{{ route('orders.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Novo Pedido
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6  right text-right">
                    <form action="{{ route('orders.index') }}" method="get" class="form-inline" style="display: block;">
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
                        <th width="" class="text-center">ID</th>
                        <th width="" class="text-center">Solicitante</th>
                        <th width="" class="text-center">Loja</th>
                        <th width="" class="text-center">Release</th>
                        <th width="" class="text-center">Prioridade</th>
                        <th width="" class="text-center">Preço</th>
                        <th width="" class="text-center">Status</th>
                        <th width="" class="text-center">Pacote</th>
                        <th width="" class="text-center">Criado por</th>
                        <th width="" class="text-center">Data</th>
                        <th width="" class="text-center">Última atualização</th>
                        <th class="text-center" width="300"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td style="vertical-align: middle;" class="text-center">
                                {{ $order->id }}
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                {{ $order->user->name }}
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                {{ $order->store->name }}
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                <a href="{{ route('releases.show', $order->release->cat_num) }}" target="_blank">{{ $order->release->cat_num }}</a>
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                {{ $order->priority->name }}
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                {{ $order->currency->simbol }} {{ $order->price }}
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                {{ $order->orderStatus->name }}
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                @if($order->packageStatus->name ?? '') <a href="#" target="_blank">{{ $order->packageStatus->name }}</a>@endif
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                {{ $order->createdBy->name }}
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                {{ $order->created_at }}
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                {{ $order->updated_at }}
                            </td>
                            <td style="vertical-align: middle;" class="text-center">
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-outline-info">Editar</a>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-warning">Detalhes</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" align="center">Nenhum resultado encontrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {{ $orders->appends($filters)->links() }}
            @else
                {{ $orders->links() }}
            @endif

        </div>
    </div>
@stop
