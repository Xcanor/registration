<?php

namespace App\Services;
 
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Agency;
use App\OfferDetails;
use App\Photo;
use App\Category;
use Image;

class OfferService
{

    public function create(Request $request)
	{   
        if(request()->is("admin*"))
        {
            $attributes = $request->all();

            $offer =  Offer::create($attributes);
    
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

        }
        else
        {
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

                $categories = $request['category'];
                $category = Category::find($categories);
                $offer->categories()->attach($category);
            
            }
            
        }
        
    }

    public function read($offerId)
	{
        $offer = Offer::findOrFail($offerId);
        return $offer;
    }
    
    public function update(Request $request)
	{
        if(request()->is("agency*"))
        {
            $offer = Offer::findOrFail($request->offerId);
        
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

        }
        else
        {
            $offer = Offer::findOrFail($request->offerId);

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

        }
       

	}
    
    public function delete($offerId)
    {
        $offer = Offer::findOrFail($offerId); //primary Key
        $offer->delete();
    }
    
}
