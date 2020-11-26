<?php

namespace App\Http\Controllers;

use App\Privilege;
use App\User;
use Datatables;
use Illuminate\Http\Request;

class OwnerAdminController extends Controller
{
    public function getData()
    {
        $admins = User::getRole('admin')->get();
        return Datatables::of($admins)
            ->addColumn('action', function ($admin) {
                return '<a href="' . route('manage.admins.edit', ['id' => $admin->id]) . '" class="btn btn-xs btn-primary">'. __('translations.edit') . '  </a>
      <a data-href="' . route('manage.admins.delete', ['id' => $admin->id]) . '" class="delete btn btn-xs btn-danger">'. __('translations.delete') . ' </a>';
            })
            ->make(true);
    }

    public function getShowAll()
    {
        return view('owner_dashboard.admins.all');
    }

    public function getCreate()
    {
        return view('owner_dashboard.admins.create');
    }

    public function postStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'password' => 'required|max:255',
        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->role = __('translations.crm');
        $user->save();
        $arr[] = '';
        // foreach ($request['prev'] as $item) {
        //   if($item){
        //     $arr[] =
        //   }
        // }
        //
        // return
        if (isset($request['chat_prv'])) {
            Privilege::create([
                'user_id' => $user->id,
                'privilege' => __('translations.chat'),
            ]);
        }
        if (isset($request['notification_prv'])) {
            Privilege::create([
                'user_id' => $user->id,
                'privilege' => __('translations.notification'),
            ]);
        }
        if (isset($request['email_prv'])) {
            Privilege::create([
                'user_id' => $user->id,
                'privilege' => __('translations.email'),
            ]);
        }
        if (isset($request['aff_prv'])) {
            Privilege::create([
                'user_id' => $user->id,
                'privilege' => __('translations.aff'),
            ]);
        }
        if (isset($request['cus_prv'])) {
            Privilege::create([
                'user_id' => $user->id,
                'privilege' => __('translations.cus'),
            ]);
        }
        if (isset($request['ven_prv'])) {
            Privilege::create([
                'user_id' => $user->id,
                'privilege' => __('translations.ven'),
            ]);
        }

        return redirect()->route('manage.admins.all')->withMessage(__('translations.new_moderator_added'));

    }

    public function getEdit($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('owner_dashboard.admins.edit', compact('user'));
        }
        abort(404);
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'max:255',
        ]);

        $user = User::find($id);
        if ($user) {
            $user->name = $request['name'];
            $user->email = $request['email'];

            if (!empty($request['password'])) {
                $user->password = bcrypt($request['password']);
            }

            $user->save();
            return redirect()->route('manage.admins.all')->withMessage(__('translations.moderator_updated'));
        }
        abort(404);
    }

    public function getDelete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('manage.admins.all')->withMessage(__('translations.moderator_deleted'));
        }
        abort(404);
    }

}
