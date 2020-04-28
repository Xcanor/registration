<?php

namespace App\Http\Controllers\Agency;
use App\Services\OfferDetailsService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OfferDetailsRequest;
use Illuminate\Support\Facades\Auth;
use App\Offer;
use App\Agency;
use App\OfferDetails;
use App\Photo;
use App\Category;
use Image;

class OffersDetailController extends Controller
{
    protected $offerdetailservice;

    public function __construct(OfferDetailsService $offerdetailservice)
	{
		$this->offerdetailservice = $offerdetailservice;
    }

    public function add($offerId)
    {   
        $offer = Offer::findOrFail($offerId);
        return view('auth.agency.pages.create-details',compact('offer'));
    }

    public function save(OfferDetailsRequest $request)
    {    
        $this->offerdetailservice->create($request);
        return redirect('agency/dashboard');
    }

    public function showdetails($offerId)
    {
        $offer = $this->offerdetailservice->read($offerId);
        return view('auth.agency.pages.show-details', compact('offer'));
    }

    public function editDetails($detailId)
    {
        $detail = OfferDetails::findOrFail($detailId);
        return view('auth.agency.pages.edit-details', compact('detail'));
    }

    public function updateDetails(OfferDetailsRequest $request)
    {
        $this->offerdetailservice->update($request);  
        return redirect('agency/dashboard');  
    }

    public function destroy($detailId)
    {
        $this->offerdetailservice->delete($detailId);
        return redirect()->back();
    }

}
