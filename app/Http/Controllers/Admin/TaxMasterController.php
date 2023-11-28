<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaxMasterRequest;
use App\Models\Taxmaster;
use Illuminate\Http\Request;

class TaxMasterController extends Controller
{
    public function index()
    {
        $temp=1;
        $data=Taxmaster::all();
        return view('admin.tax.index',compact('data','temp'));
    }

    
    public function create()
    {
    return  view('admin.tax.create');
    }

    
    public function store(TaxMasterRequest $request)
    {
        $input= $request->all();
        // dd($input);
        $input['tax_name']=($input['tax_name']);
        $input['tax_percentage']=($input['tax_percentage']);
          Taxmaster::create($input);
    // dd($request);
       return redirect()->route('admin.tax.index')->with('success','Tax Created Successfully');
    }

   
    public function show(string $id)
    {
        //
    }

   
    public function edit($id)
    {
        $data=Taxmaster::find($id);
        return view('admin.tax.edit',compact('data'));
    }

    
    public function update(TaxMasterRequest $request, string $id)
    {
        $tax= Taxmaster::find($id);
        // dd($tax);
        if (!$tax) {
            return redirect()->route('admin.tax.index')->with('error', 'Tax not found');
        }
    
        $request->validate([
            'tax_name' => 'required',
            'tax_percentage' => 'required',
            
           
        ]);
        $tax->update([
            'tax_name' => $request->input('tax_name'),
            'tax_percentage' => $request->input('tax_percentage'),
      
        ]);
    
        return redirect()->route('admin.tax.index')->with('success', 'Tax Uupdated Successfully');
    }

   
    public function destroy($id)
    {
        $result = Taxmaster::where('_id', $id)->delete();
        return response()->json(['status'=>'Tax Deleted Successfully']);
        // if ($result) {
        //     return redirect()->route('admin.tax.index')->with('success', 'Tax deleted successfully');
        // } else {
        //    return redirect()->route('admin.tax.index')->with('error', 'Failed to delete tax');
        // }
        
    }
    }
