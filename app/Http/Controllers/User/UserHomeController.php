<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Offer;
use App\Agency;
use Image;

class UserHomeController extends Controller
{
    public function showprofile()
    {   
        $auth_user = Auth::user();
        
        return view('auth.user.pages.profile', compact('auth_user'));
    }
    
    public function edit($userId)
    {
        $user = User::findOrFail($userId); //primary Key
        return view('auth.user.pages.edit',compact('user'));

    }

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
            
        ]);
        // save new values
        $user -> first_name = $request -> first_name;
        $user -> last_name = $request -> last_name;
        $user -> email = $request -> email;
        $user -> telephone = $request -> telephone;
        $user -> gender = $request -> gender;
        $user -> date_of_birth = $request -> date_of_birth;
        $user -> save();

        return redirect('/user/profile');
    }

    public function changephoto()
    {
        $auth_user = Auth::user();
        return view ('auth.user.pages.changephoto', compact('auth_user'));
    }

    public function update_avatar(Request $request)
    {
        
    	// Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );

    		$user = Auth::user();
    		$user->avatar = $filename;
    		$user->save();
    	}

    	return redirect('/user/profile');
    }

    public function showOffers()
    {   
        $agencies = Agency::all();
        $offers = Offer::all();
        return view('auth.user.pages.offers',compact('offers','agencies'));
    }

    public function showdetails($offerId)
    {
        $offer = Offer::findOrFail($offerId);
        return view('auth.user.pages.show-details', compact('offer'));
    }

}
