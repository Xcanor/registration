<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Agency;
use Image;


class AgenciesController extends Controller
{
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
            'phone' => 'required|numeric',
            'address' => 'required',
            'status' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png,gif|max:100000',
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

        return redirect('admin/dashboard/agency');
    }
    
    public function editAgency($agencyId)
    {
        $agency = Agency::findOrFail($agencyId); //primary Key
        return view('auth.admin.pages.edit-agency',compact('agency'));

    }

    // Update Agency data
    public function updateAgency(Request $request)
    {
        // get data of old User
        $agency = Agency::findOrFail($request->agencyId);
        // validate updated data
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:agencies,email,'.$agency->id,
            'phone' => 'required|numeric',
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

        return redirect('admin/dashboard/agency');
    }

    // Delete Agency User
    public function destroyAgency($agencyId)
    {
        $agency = Agency::findOrFail($agencyId); //primary Key
        $agency->delete();
        return redirect()->back();

    }

    // Change the status of the agency
    public function updateStatusAgency(Request $request)
    {
        $agency = Agency::findOrFail($request->agency_id);
        $agency->status = $request->status;
        $agency->save();

        return response()->json(['message' => 'Agency status updated successfully.']);
    }
}
