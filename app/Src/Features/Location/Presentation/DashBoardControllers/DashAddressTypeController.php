<?php

namespace Src\Features\Location\Presentation\DashBoardControllers;

use App\Http\Controllers\Controller;
use http\Message;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Src\Base\Response\DataSuccess;
use Src\Features\Location\Core\Requests\DashBoard\AddressType\AddAddressTypeWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\AddressType\DeleteAddressTypeWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\AddressType\EditeAddressTypeWebRequest;
use Src\Features\Location\Core\Requests\DashBoard\AddressType\GoToEditeAddressTypeWebRequest;
use Src\Features\Location\Domain\DashboardServices\DashAddressTypeService;


class DashAddressTypeController extends Controller
{

    private DashAddressTypeService $dashAddressTypeService;

    /**
     * @param DashAddressTypeService $dashAddressTypeService
     */
    public function __construct(DashAddressTypeService $dashAddressTypeService)
    {
        $this->dashAddressTypeService = $dashAddressTypeService;
    }


    public function index()
   {
       $dataState = $this->dashAddressTypeService->index();
       if($dataState instanceof DataSuccess){
           return view(view:'dashboard.addressType.index',data: ['address_types'=>$dataState->getData()]);
       }else{
           return view(view:'dashboard.addressType.index');
       }
   }

    public function create(AddAddressTypeWebRequest $request)
    {
        $dataState = $this->dashAddressTypeService->create($request);
        if($dataState instanceof DataSuccess){
            return $dataState->response(route:'address_types');
        }else{
            return $dataState->response();
        }
    }

    public function goToEditeBlade(GoToEditeAddressTypeWebRequest $request)
    {
        $dataState = $this->dashAddressTypeService->find($request);
        if($dataState instanceof DataSuccess){
              return view(view:'dashboard.addressType.add',data: ['address_type'=>$dataState->getData()]);
        }else{
            dd(false);
        }
    }


    public function goToAddBlade()
    {
        return view(view:'dashboard.addressType.add');
    }

    public function update(EditeAddressTypeWebRequest $request)
    {

        $dataState = $this->dashAddressTypeService->update($request);
        if($dataState instanceof DataSuccess){
            return $dataState->response(route:'address_types');
        }else{
            return $dataState->response();
        }
    }


    public function delete(DeleteAddressTypeWebRequest $request)
    {
        $dataState = $this->dashAddressTypeService->delete($request);
        if($dataState instanceof DataSuccess){
            return $dataState->redirect('address_types');
        }else{
            return $dataState->response();
        }
    }


}
