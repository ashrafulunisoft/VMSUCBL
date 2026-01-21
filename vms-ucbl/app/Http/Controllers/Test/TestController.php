<?php

namespace App\Http\Controllers\Test;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function play() {

    //1. use a from ; and upload a form
    //    $user =  User::all();
    //     // dd($user);
        return view('custom/test');
        // return "Hello this is from the controller class";
    }



public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:csv,txt'
    ]);

    $file = $request->file('file');
    $path = $file->getRealPath();

    $rows = array_map('str_getcsv', file($path));
    $header = array_map('trim', array_shift($rows)); // remove header row

    foreach ($rows as $row) {
        $data = array_combine($header, $row);

        Visitor::create([
            'name'       => $data['name'] ?? null,
            'phone'      => $data['phone'] ?? null,
            'email'      => $data['email'] ?? null,
            'address'    => $data['address'] ?? null,
            'is_blocked' => filter_var($data['is_blocked'] ?? false, FILTER_VALIDATE_BOOLEAN),
        ]);
    }

    return back()->with('success', 'Visitors imported successfully');
}

}
