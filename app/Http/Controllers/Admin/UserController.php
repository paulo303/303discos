<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserType;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected User $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index(Request $request)
    {
        return view('admin.pages.users.index', [
            'title' => 'Usuários',
            'users' => $this->model->getAll($request->search),
            'filters' => $request->all(),
        ]);
    }

    public function create()
    {
        return view('admin.pages.users.create', [
            'title' => 'Criar novo Usuário',
            'userTypes' => UserType::all(),
        ]);
    }

    public function store(Request $request)
    {
        dd($request);
        DB::beginTransaction();
        try {
            $user = $this->model->create($request->all());
            DB::commit();

            $message = "Usuário <b>{$user->name}</b> cadastrado com sucesso!";
            return redirect()->route('users.index')->with('message_success', $message);

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
        if (!$user = $this->model->find($id))
            return redirect()->back()->with('message_warning', 'O usuário não foi encontrada!');

        return view('admin.pages.users.edit', [
            'title' => $user->name,
            'user' => $user,
            'userTypes' => UserType::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!$user = $this->model->find($id))
            return redirect()->back()->with('message_error', 'O usuário não foi encontrada!');

        DB::beginTransaction();
        try {
            $data = $request->except('password');

            if ($request->password) {
                $data['password'] = bcrypt($request->password);
            }

            $user->update($request->all());
            DB::commit();

            $message = "Loja <b>{$user->name}</b> editada com sucesso!";
            return redirect()->route('users.index')->with('message_success', $message);

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
