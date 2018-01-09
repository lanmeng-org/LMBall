<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index', [
            'data' => \Auth::user(),
        ]);
    }

    public function update(ProfileRequest $request)
    {
        $user = \Auth::user();

        $data = [
            'name'  => $request->get('name'),
            'email' => $request->get('email'),
        ];

        if ($request->has('password')) {
            $data['password'] = bcrypt($request->get('password'));
        }

        $user->update($data);

        return redirect()->route('admin.profile')->with('tips.success', '更新成功');
    }
}
