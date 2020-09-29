<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Company;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
   
    public function index(){
        $customers = Customer::all();        
        return view('pages.customers')->with('customers', $customers);
    }

    public function viewcustomer($id, $success=null){        
        $customer = Customer::where('idcustomer', $id)->first();
        $company = Company::where('idcompany', $customer->companies_idcompany)->first();
        if(isset($success)){
            return view('pages.customer')->with('customer', $customer)->with('company', $company)->with('edit', false)->with('success', $success);
        }else{
        return view('pages.customer')->with('customer', $customer)->with('company', $company)->with('edit', false)->with('success', $success);
        }
    }

    public function savecustomer($id){        
        $customer = Customer::where('idcustomer', $id)->first();
        $company = Company::where('idcompany', $customer->companies_idcompany)->first();
        return view('pages.customer')->with('customer', $customer)->with('company', $company)->with('edit', false)->with('success', true);
        
    }

    public function editcustomer($id){
        $customer = Customer::where('idcustomer', $id)->first();
        $company = Company::where('idcompany', $customer->companies_idcompany)->first();
        $companies = Company::all();
        return view('pages.customer')->with('customer', $customer)->with('company', $company)->with('edit', true)->with('companies', $companies);
    }

    /**
     * Edit a customer.
     *
     * @param  $request customer
     * @return void
     */
    public function update(Request $request){      
        $customer = Customer::find($request->idcustomer);
        $customer->customer_name = $request->fname;
        $customer->customer_last_name = $request->lname;
        $customer->customer_phone = $request->phone;
        $customer->customer_email = $request->email;
        $customer->customer_birthday = date("Y-m-d", strtotime($request->birthday));
        $customer->gender = $request->gender;
        $customer->dni = $request->dni;
        $customer->tax_id = $request->tax_id;
        $customer->customer_status = $request->status;
        $customer->companies_idcompany = $request->company;
        $customer->comment = $request->comment;
        $customer->fb_user_id = $request->fb_user_id;

        $customer->save();

        $customer = Customer::where('idcustomer', $request->idcustomer)->first();
        $company = Company::where('idcompany', $customer->companies_idcompany)->first();
        return redirect('viewcustomer/save/'.$request->idcustomer)->with('success', true);
           


    }

    public function delete(Request $request){        
          $customer = Customer::find($request->idcustomer);
          $customer->customer_status = $request->status;          
          $customer->comment = $request->comment;       
  
          $customer->save(); 
         
  
        return redirect('customers');
  
  
      }
}
