<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserType;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUpdateUserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index(Request $request)
    {
        return view('admin.pages.users.index', [
            'title' => 'Usuários',
            'users' => $this->model->getPaginate($request->search),
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

    public function store(StoreUpdateUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();

            if ($request->password)
                $data['password'] = bcrypt($request->password);

            $user = $this->model->create($data);
            DB::commit();

            $message = "Usuário <b>{$user->name}</b> cadastrado com sucesso!";
            return redirect()->route('users.index')->with('success', $message);

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
        if (!$user = $this->model->findById($id))
            return redirect()->back()->withErrors('O usuário não foi encontrado!');

        return view('admin.pages.users.edit', [
            'title' => $user->name,
            'user' => $user,
            'userTypes' => UserType::all(),
        ]);
    }

    public function update(StoreUpdateUserRequest $request, User $user)
    {
        if (!$user)
            return redirect()->back()->withErrors('O usuário não foi encontrado!');

        DB::beginTransaction();
        try {
            $data = $request->except('password');

            if ($request->password)
                $data['password'] = bcrypt($request->password);

            $user->update($data);
            DB::commit();

            $message = "<b>{$user->name}</b> editado com sucesso!";
            return redirect()->route('users.index')->with('success', $message);

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
