<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all users
        $users = User::latest()->paginate(5);

        //return collection of users as a resource
        return new UserResource(true, 'List Data Pengguna', $users);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_Perusahaan' => 'required|integer',
            'name'          => 'required|string|max:255',
            'no_Telp'       => 'required|string|max:15',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:8',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create user
        $user = User::create([
            'id_Perusahaan' => $request->id_Perusahaan,
            'id_Otoritas'   => 5, // default value
            'name'          => $request->name,
            'no_Telp'       => $request->no_Telp,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        //return response
        return new UserResource(true, 'Data User Berhasil Ditambahkan!', $user);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_Perusahaan' => 'required|integer',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        //update user
        $user->update([
            'id_Perusahaan' => $request->id_Perusahaan,
            'name'          => $request->name,
            'no_Telp'       => $request->no_Telp,
            'email'         => $request->email,
            'password'      => $request->password ? Hash::make($request->password) : $user->password,
            'updated_at'    => now(),
        ]);

        //return response
        return new UserResource(true, 'Data User Berhasil Diubah!', $user);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        //delete user
        $user->delete();

        //return response
        return new UserResource(true, 'Data User Berhasil Dihapus!', null);
    }
}
