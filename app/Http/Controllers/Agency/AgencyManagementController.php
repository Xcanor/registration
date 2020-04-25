<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Offer;
use App\Agency;
use App\Detail;
use App\Photo;
use App\Category;
use Image;

class AgencyManagementController extends Controller
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
            'agency_price' => 'required',
            'user_price' => 'required',
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
        return view('auth.agency.pages.edit',compact('offer'));

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
            'agency_price' => 'required',
            'user_price' => 'required',
        ]);
        // save new values
        $offer -> name = $request -> name;
        $offer -> start_date = $request -> start_date;
        $offer -> end_date = $request -> end_date;
        $offer -> rooms = $request -> rooms;
        $offer -> status = $request -> status;
        $offer -> agency_price = $request -> agency_price;
        $offer -> user_price = $request -> user_price;
        $offer -> save();

        return redirect('/agency/dashboard');
    }

    public function destroy($offerId)
    {
        $offer = Offer::findOrFail($offerId); //primary Key
        $offer->delete();
        return redirect()->back();

    }

    
    public function add($offerId)
    {   
        $offer = Offer::findOrFail($offerId);
        return view('auth.agency.pages.create-details',compact('offer'));
    }

    public function save(Request $request)
    {    
        $offer = Offer::findOrFail($request->offerId);

        $detail = Detail::create([
            'offer_id' => $offer->id,
            'from' => $request['from'],
            'to' => $request['to'],
            'departial_time' => $request['departial_time'],
            'arrival_time' => $request['arrival_time'],
            'ticket_number' => $request['ticket_number'],
            'transportation' => $request['transportation'],
        ]);

        return redirect('agency/dashboard');
    }

    public function showdetails($offerId)
    {
        $offer = Offer::findOrFail($offerId);
        return view('auth.agency.pages.show-details', compact('offer'));
    }

    public function editDetails($detailId)
    {
        $detail = Detail::findOrFail($detailId);
        return view('auth.agency.pages.edit-details', compact('detail'));
    }

    public function updateDetails(Request $request)
    {
        $detail = Detail::findOrFail($request->detailId);

        $this->validate($request, [
            'from' => 'required',
            'to' => 'required',
            'departial_time' => 'required',
            'arrival_time' => 'required',
            'ticket_number' => 'required|numeric',
            'transportation' => 'required',
        ]);
        // save new values
        $detail -> from = $request -> from;
        $detail -> to = $request -> to;
        $detail -> departial_time = $request -> departial_time;
        $detail -> arrival_time = $request -> arrival_time;
        $detail -> ticket_number = $request -> ticket_number;
        $detail -> transportation = $request -> transportation;
        $detail -> save();


        return redirect('admin/dashboard');
    }

}
