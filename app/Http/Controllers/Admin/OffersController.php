<?php

namespace App\Http\Controllers\Admin;
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

    public function viewOffer($offerId)
    {
       $offer = $this->offerservice->read($offerId);
        return view('auth.admin.pages.show-offers', compact('offer'));
    }

    // Return the Create Form
    public function create()
    {   
        $agencies = Agency::all();
        $categories = Category::all();
        return view('auth.admin.pages.create-offer',compact('agencies','categories'));
    }

    public function storeoffer(OfferRequest $request)
    {   
        $this->offerservice->create($request);
        return redirect('admin/dashboard/offer');
    }

    // Return the Edit Form
    public function edit($offerId)
    {
        $agencies = Agency::all();
        $offer = Offer::findOrFail($offerId); //primary Key
        $categories = Category::all();
        return view('auth.admin.pages.edit-offer',compact('offer','agencies','categories'));

    }

    public function update(OfferRequest $request)
    {
        $this->offerservice->update($request);
        return redirect('admin/dashboard/offer');
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
