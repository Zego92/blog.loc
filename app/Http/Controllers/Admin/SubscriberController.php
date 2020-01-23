<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->get();
//        dd($subscribers);
        return view('admin.subscriber.index', compact('subscribers'));
    }

    public function destroy($subscribers)
    {
        $subscribers = Subscriber::findOrFail($subscribers);
        $subscribers->delete();
        Toastr::success('Подписчик Успешно Удален :)', 'Успех');
        return redirect()->route('adminsubscriber.index');
    }
}
