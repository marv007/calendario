<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Reservation;
use App\Reservations_has_service;
use App\Service;


use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class ReservationController extends Controller
{
    public function index($idCustomer){
        $listServices = Service::all();
        $customer = Customer::where('idcustomer', $idCustomer)->first();
        $reservations = Reservation::where('customer_idCustomer', $idCustomer)->get();
        $count = Reservation::where('Customer_idCustomer', $idCustomer)->where('reservation_status', 'completado')->count();
        foreach($reservations as $reservation){
            $has_services = Reservations_has_service::where('reservations_idreservations', $reservation->idreservation)->get();
            $services = array();
            foreach($has_services as $has_service){
                $service = Service::where('id_service', $has_service->services_id_services)->first();
                array_push($services, $service);                
            }
            $reservation->services = $services;
        }            
         return view ('pages.reservations')->with(array('reservations' => $reservations, 'count'=> $count, 'customer' => $customer, 'listServices'=> $listServices));

    }

    public function indexfilter(Request $request){        
        $idCustomer = $request->idCustomer;
        $idfilter = $request->idfilter;
        if($idfilter=='0') return redirect(route('reservations', $idCustomer)); //filter value is all
        $listServices = Service::all();
        $customer = Customer::where('idcustomer', $idCustomer)->first();
        $reservations = Reservation::where('customer_idCustomer', $idCustomer)->get();
        $count = Reservation::where('Customer_idCustomer', $idCustomer)->where('reservation_status', 'completado')->count();
        $reservationsfiltered = array();
        $has=false;
        foreach($reservations as $reservation){
            $has_services = Reservations_has_service::where('reservations_idreservations', $reservation->idreservation)->get();
            $services = array();
            foreach($has_services as $has_service){
                $service = Service::where('id_service', $has_service->services_id_services)->first();
                array_push($services, $service);
                if($service->id_service==$idfilter){
                    $has = true;
                }                
            }
            $reservation->services = $services;
            if($has){
                array_push($reservationsfiltered, $reservation);
                $has = false;
            } 
        }  
        

        return view ('pages.reservations')->with(array('reservations' => $reservationsfiltered, 'count'=> $count, 'customer' => $customer, 'listServices'=> $listServices, 'idfilter' =>$idfilter));
        
            
    }          

       
}