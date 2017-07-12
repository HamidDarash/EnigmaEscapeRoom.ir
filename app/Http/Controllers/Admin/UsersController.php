<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Session;
use File;
use App\Transaction;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        session(['current_menu_select' => 'users']);
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $users = User::paginate($perPage);
        } else {
            $users = User::paginate($perPage);
        }
//         dd($request->user()->Transactions()->get());
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();
        session(['current_menu_select' => 'users']);

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        if (!empty($requestData['password'])) {
            $requestData['password'] = bcrypt($requestData['password']);
        }

        try {
            $user = User::create($requestData);
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }

        if ($requestData['image-data']) {
            try {
                $data = $requestData['image-data'];
                $pos = strpos($data, ';');
                $type = explode(':', substr($data, 0, $pos))[1];
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $decoded = base64_decode($data);

                $lowerCase = strtolower($type);
                $extension = 'unknown';
                if (strpos($lowerCase, "png") !== false) {
                    $extension = "png";
                } else if (strpos($lowerCase, "jpg") !== false || strpos($lowerCase, "jpeg") !== false) {
                    $extension = "jpg";
                } else if (strpos($lowerCase, "bmp") !== false) {
                    $extension = "bmp";
                } else if (strpos($lowerCase, "tiff") !== false) {
                    $extension = "tiff";
                } else if (strpos($lowerCase, "gif") !== false) {
                    $extension = "gif";
                }
                $filename = 'profile_user_' . $user->id . '.' . $extension;
                file_put_contents(public_path() . '/img/users/' . $filename, $decoded);
                $user->avatar = $filename;
                $user->save();

            } catch (Exception $exception) {
                dd($exception->getMessage());
            }
        }

        if (!empty($requestData['roles'])) {
            foreach ($requestData['roles'] as $item) {
                DB::table('users_roles')->insert(['user_id' => $user->id, 'role_id' => $item]);
            }
        }
        Session::flash('flash_message', 'کاربر جدید اضافه شد');
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.edit')->with(['user' => $user, 'roles' => $roles]);;
    }

    /**
     * Update the specified resource in storage.
     * @param  int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $requestData = $request->all();
        if (!empty($requestData['password'])) {
            $requestData['password'] = bcrypt($requestData['password']);
        }

        $result = DB::table('users_roles')->where('user_id', $id)->delete();
        if (!empty($requestData['roles'])) {
            foreach ($requestData['roles'] as $item) {
                DB::table('users_roles')->insert(['user_id' => $id, 'role_id' => $item]);
            }
        }
        $user = User::findOrFail($id);
        $user->update($requestData);

        if ($requestData['image-data']) {
            try {
                $data = $requestData['image-data'];
                $pos = strpos($data, ';');
                $type = explode(':', substr($data, 0, $pos))[1];
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $decoded = base64_decode($data);

                $lowerCase = strtolower($type);
                $extension = 'unknown';
                if (strpos($lowerCase, "png") !== false) {
                    $extension = "png";
                } else if (strpos($lowerCase, "jpg") !== false || strpos($lowerCase, "jpeg") !== false) {
                    $extension = "jpg";
                } else if (strpos($lowerCase, "bmp") !== false) {
                    $extension = "bmp";
                } else if (strpos($lowerCase, "tiff") !== false) {
                    $extension = "tiff";
                } else if (strpos($lowerCase, "gif") !== false) {
                    $extension = "gif";
                }
                $filename = 'profile_user_' . $user->id . '.' . $extension;
                file_put_contents(public_path() . '/img/users/' . $filename, $decoded);
                $user->avatar = $filename;
                $user->save();

            } catch (Exception $exception) {
                dd($exception->getMessage());
            }
        }
        Session::flash('flash_message', 'کاربر مورد نظر بروز رسانی شد');
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->avatar) {
            $deletePath = base_path() . '/public/img/users/' . $user->avatar;
            if (File::exists($deletePath)) {
                File::delete($deletePath);
            }
        }
        User::destroy($id);
        $result = DB::table('users_roles')->where('user_id', $id)->delete();
        Session::flash('flash_message', 'کاربر مورد نظر حذف گردید');
        return redirect('admin/users');
    }
}
