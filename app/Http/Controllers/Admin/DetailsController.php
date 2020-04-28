<?php

namespace App\Http\Controllers\Admin;
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
use DateTime;
use DateInterval;
use DatePeriod;


class DetailsController extends Controller
{
    protected $offerdetailservice;

    public function __construct(OfferDetailsService $offerdetailservice)
	{
		$this->offerdetailservice = $offerdetailservice;
    }

    public function addDetails($offerId)
    {
        $offer = Offer::findOrFail($offerId);
        return view('auth.admin.pages.create-details',compact('offer'));
    }

    public function save(OfferDetailsRequest $request)
    {    
        $this->offerdetailservice->create($request);
        return redirect('admin/dashboard/offer');
    }

    public function showDetails($offerId)
    {
        $offer = $this->offerdetailservice->read($offerId);
        return view('auth.admin.pages.show-details', compact('offer'));
    }

    public function editDetails($detailId)
    {
        $detail = OfferDetails::findOrFail($detailId);
        return view('auth.admin.pages.edit-details', compact('detail'));
    }

    public function updateDetails(OfferDetailsRequest $request)
    {
        $this->offerdetailservice->update($request);
        return redirect('admin/dashboard/offer');
    }

    public function destroy($detailId)
    {
        $this->offerdetailservice->delete($detailId);
        return redirect()->back();

    }

}
