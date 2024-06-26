<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\Selling;
use App\Models\SellingDetail;
use App\Models\User;
use App\Models\Product;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sellings = Selling::all();
        return view('sellings.index', compact('sellings'));
    }

    public function report(Request $request)
    {
        $sellings = Selling::query();
        if ($request->startDate && $request->endDate) {
            $sellings->whereBetween('date_sell', [$request->startDate, $request->endDate]);
        }
        $sellings = $sellings->get();
        return view('sellings.report', compact('sellings'));
    }

    public function reportPdf(Request $request)
    {
        $sellings = Selling::query();
        if ($request->startDate && $request->endDate) {
            $sellings->whereBetween('date_sell', [$request->startDate, $request->endDate]);
        }
        $sellings = $sellings->get();
        $pdf = PDF::loadview('sellings.reportPdf', ['sellings' => $sellings]);
        return $pdf->stream('laporan-penjualan.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = customer::all();
        $sales = User::all();

        return view('sellings.create', compact('customers', 'sales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_trans' => 'required',
            'customer_id' => 'required',
            'sales_id' => 'required',
            'date_sell' => 'required',
            'grand_total' => 'required',
            'jml' => 'required',
        ]);

        // dd($request->all());

        DB::beginTransaction();
        try {
            $data = $request->all();
            // dd($data);
            $sell = new Selling();
            $sell->code_trans = $data['code_trans'];
            $sell->customer_id = $data['customer_id'];
            $sell->sales_id = $data['sales_id'];
            $sell->date_sell = $data['date_sell'];
            $sell->grand_total = $data['grand_total'];
            $sell->save();

            for ($i = 1; $i <= $request->jml; $i++) {
                $product = Product::find($data['id_product' . $i]);
                if ($data['qty' . $i] > $product->qty) {
                    return redirect()->route('sellings.create')
                        ->withErrors('Oops !, data not available');
                }
                $detail = new SellingDetail();
                $detail->code_trans = $data['code_trans'];
                $detail->product_id = $data['id_product' . $i];
                $detail->product_name = $data['product_name' . $i];
                $detail->selling_price = $data['price' . $i];
                $detail->qty = $data['qty' . $i];
                $detail->sub_total = $data['sub_total' . $i];
                $detail->id_sell = $sell->id;
                $detail->save();
            }

            DB::commit();

            return redirect()->route('sellings.index')
                ->withSuccess('Great! You have successfully created selling');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Selling $selling)
    {
        // return view('sellings.print', compact('selling'));
        $pdf = PDF::loadview('sellings.print', ['selling' => $selling]);
        return $pdf->stream('nota-penjualan.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}