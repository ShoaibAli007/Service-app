<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\BrainTreeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Service\ServiceRequest;
use App\Http\Requests\Service\PurchaseServiceRequest;
use App\Interfaces\ServiceInterface;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $serviceInterface;
    public function __construct(ServiceInterface $serviceInterface) {
        $this->serviceInterface = $serviceInterface;
    }


    public function index()
    {
        $data = $this->serviceInterface->index();
        return view('landing-page',$data);
    }

    public function getPurchaseService()
    {
        $services =  $this->serviceInterface->getPurchaseService();
        return view('admin.services.purchase-service-listing',compact('services'))
                ->with('i',0);
    }

    public function purchaseService(Request $purchaseService)
    {
        $this->serviceInterface->purchaseService($purchaseService);
        return redirect()->back();
    }
}
