<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Agency;
use Image;

class AdminManagementController extends Controller
{   
    // Read specific user data
    public function show($userId)
    {
        $user = User::findOrFail($userId);
        return view('auth.admin.pages.show', compact('user'));
    }

    // Return View of Create form to let the admin add new user
    public function create()
    {
        return view('auth.admin.pages.create');
    }

    // admin create new user to the system
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|numeric',
            'gender' => 'nullable',
            'date_of_birth' => 'nullable',
            'status' => 'required',
            'password' => 'required|min:6'
        ]);
        
        $user =  User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'telephone' => $request['telephone'],
            'gender' => $request['gender'],
            'date_of_birth' => $request['date_of_birth'],
            'status' => $request['status'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect('admin/dashboard');
    }

    
    public function edit($userId)
    {
        $user = User::findOrFail($userId); //primary Key
        return view('auth.admin.pages.edit',compact('user'));

    }

    // admin update user's data
    public function update(Request $request)
    {
        // get data of old User
        $user = User::findOrFail($request->userId);
        // validate updated data
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'gender' => 'nullable',
            'date_of_birth' => 'nullable',
            'status' => 'required',
        ]);
        // save new values
        $user -> first_name = $request -> first_name;
        $user -> last_name = $request -> last_name;
        $user -> email = $request -> email;
        $user -> telephone = $request -> telephone;
        $user -> gender = $request -> gender;
        $user -> date_of_birth = $request -> date_of_birth;
        $user -> status = $request -> status;
        $user -> save();

        return redirect('/admin/dashboard');
    }

    // admin delete (soft delete) user
    public function destroy($userId)
    {
        $user = User::findOrFail($userId); //primary Key
        $user->delete();
        return redirect()->back();

    }


    public function showAgency($agencyId)
    {
        $agency = Agency::findOrFail($agencyId);
        return view('auth.admin.pages.show-agency', compact('agency'));
    }

    public function createAgency()
    {
        return view('auth.admin.pages.create-agency');
    }

    // admin create new user to the system
    public function saveAgency(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:agencies',
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required',
            'photo' => 'required',
            'country' => 'required',
            'password' => 'required|min:6'
        ]);
        
        $user =  Agency::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'status' => $request['status'],
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'country' => $request['country'],
            'password' => Hash::make($request['password']),
        ]);

        $agency = Agency::latest()->first();
        

        if($request->hasFile('photo'))
        {   
    		$avatar = $request->file('photo');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/photos/' . $filename ) );

            $agency->photo = $filename;
    		$agency->save();
            
    	}

        return redirect('admin/dashboard');
    }

    public function editAgency($agencyId)
    {
        $agency = Agency::findOrFail($agencyId); //primary Key
        return view('auth.admin.pages.edit-agency',compact('agency'));

    }

    // admin update user's data
    public function updateAgency(Request $request)
    {
        // get data of old User
        $agency = Agency::findOrFail($request->agencyId);
        // validate updated data
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required',
            'photo' => 'required',
            'country' => 'required',
        ]);
        // save new values
        $agency -> name = $request -> name;
        $agency -> email = $request -> email;
        $agency -> phone = $request -> phone;
        $agency -> address = $request -> address;
        $agency -> status = $request -> status;
        $agency -> photo = $request -> photo;
        $agency -> country = $request -> country;
        $agency -> save();

        return redirect('/admin/dashboard/users');
    }


    public function destroyAgency($agencyId)
    {
        $agency = Agency::findOrFail($agencyId); //primary Key
        $agency->delete();
        return redirect()->back();

    }
    






    // Method for status column (active - block)
    public function updateStatus(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'User status updated successfully.']);
    }

    public function updateStatusAgency(Request $request)
    {
        $agency = Agency::findOrFail($request->agency_id);
        $agency->status = $request->status;
        $agency->save();

        return response()->json(['message' => 'Agency status updated successfully.']);
    }

    

    
}