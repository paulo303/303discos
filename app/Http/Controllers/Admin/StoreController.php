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
    protected Store $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function index(Request $request)
    {
        return view('admin.pages.stores.index', [
            'title' => 'Lojas',
            'stores' => $this->store->getAll($request->search),
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

            $store = $this->store->create($data);
            DB::commit();

            return redirect()->route('stores.index')->with('success', "Loja <b>{$store->name}</b> cadastrada com sucesso!");

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
        if (!$store = $this->store->find($id))
            return redirect()->back()->withErrors('A loja não foi encontrada!');

        return view('admin.pages.stores.edit', [
            'title' => $store->name,
            'store' => $store,
        ]);
    }

    public function update(StoreUpdateStoreRequest $request, Store $store)
    {
        if (!$store)
            return redirect()->back()->withErrors('A loja não foi encontrada!');

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

            return redirect()->route('stores.index')->with('success', "Loja <b>{$store->name}</b> editada com sucesso!");

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
