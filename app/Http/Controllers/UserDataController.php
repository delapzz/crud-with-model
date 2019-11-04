<?php

namespace App\Http\Controllers;
use App\UserData;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    
    public function index()
    {
      $userData = UserData::latest()->paginate(5);
  
        return view('userData.index',compact('userData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('userData.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
  
        UserData::create($request->all());
   
        return redirect()->route('userData.index')
                        ->with('success','User created successfully.');
    }

    public function show($id)
    {
        $userData = UserData::find($id);
        return view('userData.show',compact('userData'));
    }

    public function edit($id)
    {
        $userData = UserData::find($id);
        return view('userData.edit',compact('userData','id'));
    }

    public function update(Request $request, UserData $userData)
    {
        $userData = UserData::find($id);
        $userData->name = request('name');
        $userData->email = request('email');
        $userData->save();
                $request->validate([
                'name' => 'required',
                'email' => 'required',
         ]);
        $userData->update($request->all());
  
        return redirect()->route('userData.index')
                        ->with('success','User updated successfully');
    }

    public function destroy(UserData $userData)
    {
        UserData::find($id)->delete();
  
        return redirect()->route('userData.index')
                        ->with('success','User deleted successfully');
    }
}
