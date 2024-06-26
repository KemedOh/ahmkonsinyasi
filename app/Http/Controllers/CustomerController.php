<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;
use Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $users = customer::all();
        return view('customers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'company_name' => 'required',
            'customer_address' => 'required',
            'contact_customer' => 'required',
        ]);

        $data = $request->all();
        // dd($data);
        $check = customer::create([
            'customer_name' => $data['customer_name'],
            'company_name' => $data['company_name'],
            'customer_address' => $data['customer_address'],
            'contact_customer' => $data['contact_customer']
        ]);

        return redirect()->route('customers.index')->withSucces('Great! You have succesfully updated');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = customer::find($id);
        return view('customers.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, customer $customer)
    {
        $request->validate([
            'customer_name' => 'required',
            'company_name' => 'required',
            'customer_address' => 'required',
            'contact_customer' => 'required',

        ]);

        $customer->customer_name = $request->customer_name;
        $customer->company_name = $request->company_name;
        $customer->customer_address = $request->customer_address;
        $customer->contact_customer = $request->contact_customer;
        $customer->save();

        return redirect()->route('customers.index')->withSucces('Great! You have succesfully updated' . $customer->customer_name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->withSucces('Great! You have succesfully DELETED' . $customer->customer_name);
    }
}
