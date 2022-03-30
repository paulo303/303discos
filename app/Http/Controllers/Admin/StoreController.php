<?php

namespace App\Http\Controllers\Admin;

use App\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateStoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    protected Store $model;

    public function __construct(Store $store)
    {
        $this->model = $store;
    }

    public function index(Request $request)
    {
        return view('admin.pages.stores.index', [
            'title' => 'Lojas',
            'stores' => $this->model->getAll($request->search),
            'filters' => $request->all(),
        ]);
    }

    public function create()
    {
        return view('admin.pages.stores.create', [
            'title' => 'Criar nova Loja',
        ]);
    }

    public function store(StoreUpdateStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $path = 'images/stores';

            if ($request->logo) {

                $upload = $request->logo->move(public_path($path), Helpers::convertToUrl($request->name) . "." . $request->logo->getClientOriginalExtension());
                $data['logo'] = "{$path}/{$upload->getFilename()}";
            }

            $store = $this->model->create($data);
            DB::commit();

            $message = "Loja <b>{$store->name}</b> cadastrada com sucesso!";
            return redirect()->route('stores.index')->with('message_success', $message);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (!$store = $this->model->find($id))
            return redirect()->back()->with('message_warning', 'A loja não foi encontrada!');

        return view('admin.pages.stores.edit', [
            'title' => $store->name,
            'store' => $store,
        ]);
    }

    public function update(StoreUpdateStoreRequest $request, $id)
    {
        if (!$store = $this->model->find($id))
            return redirect()->back()->with('message_error', 'A loja não foi encontrada!');

        DB::beginTransaction();
        try {
            $data = $request->all();
            $path = 'images/stores';

            if ($request->logo){
                if ($store->image && Storage::exists($store->image))
                    Storage::delete($store->image);

                $upload = $request->logo->move(public_path($path), Helpers::convertToUrl($request->name) . "." . $request->logo->getClientOriginalExtension());
                $data['logo'] = "{$path}/{$upload->getFilename()}";
            }

            $store->update($data);
            DB::commit();

            $message = "Loja <b>{$store->name}</b> editada com sucesso!";
            return redirect()->route('stores.index')->with('message_success', $message);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function destroy($id)
    {
        //
    }
}
