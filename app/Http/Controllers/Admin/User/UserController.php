<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $key = $request->key ?? null;
        $sortBy = $request->sortBy ?? 'latest';
        $sortByRole = $request->sortByRole ?? null;

        $query = User::query();

        if ($key) {
            $query->where('name', 'like', "%$key%");
        }

        if ($sortByRole !== null) {
            $query->where('role', $sortByRole);
        }

        $query->orderBy('created_at', $sortBy === 'latest' ? 'desc' : 'asc');

        $datas = $query->paginate(config('myconfig.user_per_page'));

        if ($request->ajax()) {
            return view('admin.pages.user.table', ['datas' => $datas])->render();
        }

        return view('admin.pages.user.index', [
            'datas' => $datas,
            'sortByRole' => $sortByRole
        ]);
    }


    public function create()
    {
        return view('admin.pages.user.create');
    }

    public function store(UserStoreRequest $request)
    {
        $dob = Carbon::createFromFormat('d/m/Y', $request['dob'])->startOfDay();

        $user = User::updateOrCreate(
            ['email' => $request['email']],
            [
                'name' => $request['name'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'dob' => $dob,
                'role' => $request['role'],
                'password' => bcrypt('P@ssword!17102003'),
                'status' => $request['status'],
            ]
        );

        $message = $user ? 'Tạo người dùng thành công!' : 'Tạo người dùng thất bại!';
        return redirect()->route('admin.user.index')->with('message', $message);
    }


    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.user.index')->with('danger', 'Không tìm thấy người dùng này!');
        } else {
            $dob = Carbon::createFromFormat('d/m/Y', $request['dob'])->format('Y-m-d');

            // $currentRole = $user->role;
            // $updatedRole = $currentRole == 2 ? $currentRole : $request['role'];

            // if ($request['role'] != $currentRole) {
            //     return redirect()->route('admin.user.index')->with('danger', 'Bạn chưa được cấp quyền để thay đổi vai trò người dùng!');
            // }

            $result = User::find($id)->update([
                'name' => $request['name'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'dob' => $dob,
                'status' => $request['status'],
                // 'role' => $updatedRole
                'role' =>  $request['role']
            ]);

            $message = $result ? 'Cập nhật thông tin người dùng thành công!' : 'Cập nhật thông tin người dùng thất bại!';
            return redirect()->route('admin.user.index')->with('message', $message);
        }
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
}
