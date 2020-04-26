<?php

namespace App\Http\Controllers\Admin;

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
    public function viewOffer($offerId)
    {
        $offer = Offer::findOrFail($offerId);
        return view('auth.admin.pages.show-offers', compact('offer'));
    }


    public function create()
    {   
        $agencies = Agency::all();
        $categories = Category::all();
        return view('auth.admin.pages.create-offer',compact('agencies','categories'));
    }

    public function storeoffer(Request $request)
    {
        $this->validate($request, [
            'agency_id' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'rooms' => 'required|numeric',
            'status' => 'required',
            'agency_price' => 'required|numeric',
            'user_price' => 'required|numeric',
            'category' => 'required'
        ]);
        
        $offer =  Offer::create([
            'agency_id' => $request['agency_id'],
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

        // Insert Photo into Offer 
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

        // Insert Categories into Offers
        $categories = $request['category'];
        $category = Category::find($categories);
        $offer->categories()->attach($category);


        return redirect('admin/dashboard/offer');
    }

    public function edit($offerId)
    {
        $agencies = Agency::all();
        $offer = Offer::findOrFail($offerId); //primary Key
        $categories = Category::all();
        return view('auth.admin.pages.edit-offer',compact('offer','agencies','categories'));

    }

    
    public function update(Request $request)
    {
        
        $offer = Offer::findOrFail($request->offerId);
        
        $this->validate($request, [
            'agency_id' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'rooms' => 'required|numeric',
            'status' => 'required',
            'agency_price' => 'required',
            'user_price' => 'required',
            'category' => 'required'
        ]);
        // save new values
        $offer -> agency_id = $request -> agency_id;
        $offer -> name = $request -> name;
        $offer -> start_date = $request -> start_date;
        $offer -> end_date = $request -> end_date;
        $offer -> rooms = $request -> rooms;
        $offer -> status = $request -> status;
        $offer -> agency_price = $request -> agency_price;
        $offer -> user_price = $request -> user_price;
        
        // Update Categories that associated with offers
        $categories = $request['category'];
        $category = Category::find($categories);
        $offer->categories()->sync($category);
        $offer -> save();

        return redirect('admin/dashboard/offer');
    }

    public function destroy($offerId)
    {
        $offer = Offer::findOrFail($offerId); //primary Key
        $offer->delete();
        return redirect()->back();

    }
    public function updateStatusOffer(Request $request)
    {
        $offer = Offer::findOrFail($request->offer_id);
        $offer->status = $request->status;
        $offer->save();

        return response()->json(['message' => 'Offer status updated successfully.']);
    }
}
