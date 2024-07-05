<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $datas = User::all();

        $key = $request->key ?? null;
        $sortBy = $request->sortBy ?? 'latest';

        $query = User::query();

        if ($key) {
            $query->where('name', 'like', "%$key%");
        }

        $query->orderBy('created_at', $sortBy === 'latest' ? 'desc' : 'asc');

        $datas = $query->paginate(config('myconfig.user_per_page'));

        if ($request->ajax()) {
            return view('admin.pages.user.table', ['datas' => $datas])->render();
        }

        return view('admin.pages.user.index', ['datas' => $datas]);
    }

    public function create()
    {
        return view('admin.pages.user.create');
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::updateOrCreate(
            ['email' => $request['email']],
            [
                'name' => $request['name'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'dob' => $request['dob'],
                'role' => $request['role'],
                'password' => bcrypt('P@ssword!17102003'),
            ]
        );

        $message = $user ? 'Tạo người dùng thành công!' : 'Tạo người dùng thất bại!';
        return redirect()->route('admin.user.index')->with('message', $message);
    }


    public function detail($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.user.index')->with('message', 'Không tìm thấy người dùng này!');
        }

        $data = $user->toArray();

        return view('admin.pages.user.detail', compact('data'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.user.index')->with('message', 'Không tìm thấy người dùng này!');
        }

        $user->update($request->validated());

        $message = $user ? 'Cập nhật thông tin người dùng thành công!' : 'Cập nhật thông tin người dùng thất bại!';
        return redirect()->route('admin.user.index')->with('message', $message);
    }
}