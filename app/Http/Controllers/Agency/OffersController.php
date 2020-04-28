<?php

namespace App\Http\Controllers\Agency;
use App\Services\OfferService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;
use Illuminate\Support\Facades\Auth;
use App\Offer;
use App\Agency;
use App\OfferDetails;
use App\Photo;
use App\Category;
use Image;

class OffersController extends Controller
{
    protected $offerservice;

    public function __construct(OfferService $offerservice)
	{
		$this->offerservice = $offerservice;
    }
    
    public function create()
    {   
        $categories = Category::all();
        return view('auth.agency.pages.create',compact('categories'));
    }

    public function store(OfferRequest $request)
    {
        $this->offerservice->create($request);
        return redirect('agency/dashboard');
    }

    public function show($offerId)
    {
        $offer = $this->offerservice->read($offerId);
        $categories = Category::all();
        return view('auth.agency.pages.show', compact('offer','categories'));
    }

    public function edit($offerId)
    {
        $offer = Offer::findOrFail($offerId); //primary Key
        $categories = Category::all();
        return view('auth.agency.pages.edit',compact('offer','categories'));

    }

    public function update(OfferRequest $request)
    {
        $this->offerservice->update($request);
        return redirect('/agency/dashboard');
    }

    public function destroy($offerId)
    {
        $this->offerservice->delete($offerId);
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
