<?php

namespace App\Http\Controllers\Admin;

use App\Helpers;
use App\Http\Requests\StoreUpdateLabelRequest;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LabelController extends Controller
{
    private Label $model;

    public function __construct(Label $label)
    {
        $this->model = $label;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $labels = $this->model->getPaginate($request->search);

        return view('admin.pages.labels.index', [
            'title' => 'Selos',
            'labels' => $labels,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.labels.create', [
            'title' => 'Criar novo Selo',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreUpdateLabelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateLabelRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();

            if ($request->logo) {
                $path = 'images/labels';
                $upload = $request->logo->move(public_path($path), Helpers::convertToUrl($request->name) . "." . $request->logo->getClientOriginalExtension());
                $data['logo'] = "{$path}/{$upload->getFilename()}";
            }

            // Obersver converte o nome do label para url antes de salvar
            $label = $this->model->create($data);
            DB::commit();

            return redirect()->route('labels.index')->with('success', "Selo <b>{$label->name}</b> cadastrado com sucesso!");

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        if (!$label = $this->model->findByURL($url))
            return redirect()->back()->withErrors('O selo não foi encontrado!');

        return view('admin.pages.labels.show', [
            'title' => $label->name,
            'label' => $label,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
        if (!$label = $this->model->findByURL($url))
            return redirect()->back()->withErrors('O selo não foi encontrado!');

        return view('admin.pages.labels.edit', [
            'title' => "Editando {$label->name}",
            'label' => $label,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateLabelRequest $request, Label $label)
    {
        if (!$label = $this->model->findByURL($label->url))
            return redirect()->back()->withErrors('O selo não foi encontrado!');

        DB::beginTransaction();
        try {
            $data = $request->all();
            if ($request->logo){
                if ($label->image && Storage::exists($label->image))
                    Storage::delete($label->image);

                $path = 'images/labels';
                $data['logo'] = $request->logo->move(public_path($path), Helpers::convertToUrl($request->name) . "." . $request->logo->getClientOriginalExtension());
            }

            // Obersver converte o nome do label para url antes de salvar
            $label->update($data);
            DB::commit();

            return redirect()->route('labels.index')->with('success', "Selo <b>{$label->name}</b> editado com sucesso!");

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
