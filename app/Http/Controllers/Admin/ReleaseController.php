<?php

namespace App\Http\Controllers\Admin;

use App\Helpers;
use App\Models\Release;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateReleaseRequest;
use App\Models\Label;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReleaseController extends Controller
{
    private Release $model;

    public function __construct(Release $release, Label $label)
    {
        $this->model = $release;
        $this->label = $label;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $releases = $this->model->getPaginate($request->search);

        return view('admin.pages.releases.index', [
            'title'     => 'Releases',
            'releases'  => $releases,
            'filters'   => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.releases.create', [
            'title' => 'Criar novo Release',
            'selos' => Label::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateReleaseRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();

            if ($request->image) {
                $label = $this->label->findById($request->label_id);
                $path = "images/releases/{$label->name}";

                $upload = $request->image->move(public_path($path), $request->cat_num . "." . $request->image->getClientOriginalExtension());
                $data['image'] = "{$path}/{$upload->getFilename()}";
            }

            $release = $this->model->create($data);
            DB::commit();

            return redirect()->route('releases.index')->with('success', "Release <b>{$release->cat_num}</b> cadastrado com sucesso!");

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Release  $release
     * @return \Illuminate\Http\Response
     */
    public function show(Release $release)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($catNum)
    {
        if (!$release = $this->model->findByCatNum($catNum))
            return redirect()->back()->withErrors('O release não foi encontrado!');

        return view('admin.pages.releases.edit', [
            'title' => "Editando {$release->cat_num}",
            'release' => $release,
            'selos' => Label::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Release  $release
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Release $release)
    {
        if (!$release)
            return redirect()->back()->withErrors('O release não foi encontrado!');

        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($request->image){
                if ($release->image && Storage::exists($release->image))
                    Storage::delete($release->image);

                $label = $this->label->findById($request->label_id);
                $path = "images/releases/{$label->name}";
                $upload = $request->image->move(public_path($path), $request->cat_num . "." . $request->image->getClientOriginalExtension());
                $data['image'] = "{$path}/{$upload->getFilename()}";
            }

            // Obersver converte o nome do label para url antes de salvar
            $release->update($data);
            DB::commit();

            return redirect()->route('releases.index')->with('success', "<b>{$release->cat_num}</b> editado com sucesso!");

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Release  $release
     * @return \Illuminate\Http\Response
     */
    public function destroy(Release $release)
    {
        //
    }
}
