<?php

namespace App\Http\Controllers;

use App\Service;
use App\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index(){
        $services = Service::all();
        $category;
        foreach($services as $service){
            $category = Category::where('idcategory', $service->category_idcategory)->first();
            $service->category = $category;
        }
        
        return view('pages.services')->with('services', $services);
    }

    public function viewservice($idservice){
        $service = Service::where('id_service', $idservice)->first();
        $category = Category::where('idcategory', $service->category_idcategory)->first();
        $service->category = $category;
        
        return view('pages.service')->with(array('service'=> $service, 'edit' => false, 'add' => false));
    }

    public function editservice($idservice){
        $service = Service::where('id_service', $idservice)->first();
        $category = Category::where('idcategory', $service->category_idcategory)->first();
        $service->category = $category;
        $categories = Category::all();        
        return view('pages.service')->with(array('service'=> $service, 'edit' => true, 'add' => false, 'categories' => $categories));
    }

    public function addservice(){
       // $service = DB::table('services')->orderBy('id_service', 'DESC')->first();
        $service = new Service;        
        $service->id_service ="";
        $service->service_name = "";
        $service->service_description = "";
        $service->service_price = "";
        $service->category_idcategory = "";
        $service->service_duration_time = "";
        $service->concurrent_services = "";     
        $categories = Category::all();
        //return $service;              
        return view('pages.service')->with(array('service'=> $service, 'edit' => true, 'add' => true, 'categories' => $categories));
    }


    /**
     * Edit a service.
     *
     * @param  $request srvice
     * @return void
     */
    public function update(Request $request){      
        $service = Service::find($request->idservice);
        if($request->idservice==0){
            $service = new Service; //save new service
            $last_service = DB::table('services')->orderBy('id_service', 'DESC')->first();
            $service->id_service = $last_service->id_service+1;
            //return $service;
        }        
        $service->service_name = $request->name;
        $service->service_description = $request->description;
        $service->service_price = $request->price;
        $service->category_idcategory = $request->category;
        $service->service_duration_time = $request->duration;
        $service->concurrent_services = $request->concurrent;
             

        $service->save();

        /*$customer = Customer::where('idcustomer', $request->idcustomer)->first();
        $company = Company::where('idcompany', $customer->companies_idcompany)->first();*/
        return redirect('viewservice/save/'.$service->id_service)->with(array('success'=> true, 'add' => false));
           


    }

    public function saveservice($idservice){
        $service = Service::where('id_service', $idservice)->first();
        $category = Category::where('idcategory', $service->category_idcategory)->first();
        $service->category = $category;
        
        return view('pages.service')->with(array('service'=> $service, 'edit' => false, 'success' =>true, 'add' =>false));
    }
}
