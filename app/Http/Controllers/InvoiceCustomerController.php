<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;

class InvoiceCustomerController extends Controller
{
    public function index(){

        $sections = Section::all();
        return view('reports.invoiceCustomer',compact('sections'));

    }


    public function Search_customers(Request $request){


// في حالة البحث بدون التاريخ

        if ($request->Section && $request->product && $request->start_at =='' && $request->end_at=='') {


            $invoices = Invoice::select('*')->where([['section_id','=',$request->Section],['product','=',$request->product]])->get();
            $sections = Section::all();
            return view('reports.invoiceCustomer',compact('sections'))->withDetails($invoices);


        }


        // في حالة البحث بتاريخ

        else {

            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

            $invoices = Invoice::whereBetween('invoice_Date',[$start_at,$end_at])->where([['section_id','=',$request->Section],['product','=',$request->product]])->get();
            $sections = Section::all();
            return view('reports.invoiceCustomer',compact('sections'))->withDetails($invoices);


        }



    }
}
