<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Offer;
use App\Agency;
use App\OfferDetails;
use App\Photo;
use App\Category;
use Image;

class OffersController extends Controller
{
    public function create()
    {   
        $categories = Category::all();
        return view('auth.agency.pages.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'rooms' => 'required|numeric',
            'status' => 'required',
            'agency_price' => 'required|numeric',
            'user_price' => 'required|numeric',
        ]);
        
        $user = Auth::guard('agency')->user();
        $user_id = $user->id;

        $offer =  Offer::create([
            'agency_id' => $user_id,
            'name' => $request['name'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rooms' => $request['rooms'],
            'status' => $request['status'],
            'agency_price' => $request['agency_price'],
            'user_price' => $request['user_price'],
        ]);

        $offer_id = Offer::latest()->first()->id;

        if($request->hasFile('images'))
        {   
            foreach( $request->file('images') as $image ) {
                    
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(300, 300)->save( public_path('/uploads/images/' . $filename ));

                Photo::create([
                'offer_id' => $offer_id,
                'imagename' => $filename
                ]);
            }
        }

        $categories = $request['category'];
        $category = Category::find($categories);
        $offer->categories()->attach($category);
       
        return redirect('agency/dashboard');
    }

  

    public function show($offerId)
    {
        $offer = Offer::findOrFail($offerId);
        $categories = Category::all();
        return view('auth.agency.pages.show', compact('offer','categories'));
    }

    public function edit($offerId)
    {
        $offer = Offer::findOrFail($offerId); //primary Key
        $categories = Category::all();
        return view('auth.agency.pages.edit',compact('offer','categories'));

    }

    
    public function update(Request $request)
    {
        
        $offer = Offer::findOrFail($request->offerId);
        
        $this->validate($request, [
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'rooms' => 'required|numeric',
            'status' => 'required',
            'agency_price' => 'required|numeric',
            'user_price' => 'required|numeric',
        ]);
        // save new values
        $offer -> name = $request -> name;
        $offer -> start_date = $request -> start_date;
        $offer -> end_date = $request -> end_date;
        $offer -> rooms = $request -> rooms;
        $offer -> status = $request -> status;
        $offer -> agency_price = $request -> agency_price;
        $offer -> user_price = $request -> user_price;

        $categories = $request['category'];
        $category = Category::find($categories);
        $offer->categories()->sync($category);
        $offer -> save();

        return redirect('/agency/dashboard');
    }

    public function destroy($offerId)
    {
        $offer = Offer::findOrFail($offerId); //primary Key
        $offer->delete();
        return redirect()->back();

    }
}
