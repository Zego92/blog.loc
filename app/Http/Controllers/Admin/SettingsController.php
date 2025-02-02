<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
//use Intervention\Image\Image;

use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request,[
           'name' => 'required',
           'email' => 'required|email',
           'image' => 'required|image',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);
        $user = User::findOrFail(Auth::id());
        if (isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('profile'))
            {
                Storage::disk('public')->exists('profile');
            }

            if (Storage::disk('public')->exists('profile' . $user->image))
            {
                Storage::disk('public')->delete('profile' . $user->image);
            }

            $profile = Image::make($image)->resize('500', '500')->save(public_path('/uploads/img/profile/' . $imageName));
            Storage::disk('public')->put('profile/' . $imageName, $profile);
        }
        else
        {
            $imageName = $user->image;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->about = $request->about;
        $user->save();
        Toastr::success('Профиль Успешно Обновлен :)', 'Успех');
        return redirect()->route('adminsettings');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            if (!Hash::check($request->password, $hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Пароль Успешно Изменен :)', 'Успех');
                Auth::logout();
                return redirect()->route('home');
            }
            else
            {
                Toastr::error('Новый Пароль Должен Отличаться от Старого', 'Ошибка');
                return redirect()->route('adminsettings');
            }
        }
        else
        {
            Toastr::error('Пароль не совпадает', 'Ошибка');
            return redirect()->route('adminsettings');
        }
    }
}
