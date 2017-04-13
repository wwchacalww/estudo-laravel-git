<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Empregado;
use Kodeine\Acl\Models\Eloquent\Role;
use Kodeine\Acl\Models\Eloquent\Permission;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('name','id');

        return view('users.create',['roles' => $roles->slice(1)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate( request(),[
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->assignRole($data['role']);

        //Empregado
        $empregado = Empregado::find($data['empregado_id']);
        $empregado->user_id = $user->id;
        $empregado->update();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all()->pluck('name','id');
        $user = User::find($id);
        return view('users.edit', ['user'=>$user,'roles'=>$roles->slice(1)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate( request(),[
          'name' => 'required|min:5|max:255',
          'email' => 'required|email|max:255',
          'password' => 'required|min:6|confirmed'
      ]);

      $data = $request->all();
      $data['password'] = bcrypt($data['password']);
      $user = User::find($id);
      $user->update($data);
      //Roles
      $user->revokeAllRoles();
      $user->assignRole($data['role']);
      //Empregado
      $empregado = Empregado::find($data['empregado_id']);
      $empregado->user_id = $id;
      $empregado->update();
      return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index');
    }
}
