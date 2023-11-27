<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Requests\PlanRequest;
class PlanController extends Controller
{
    
    public function index()
    {
        $data=Plan::all();
        // dd($data);
        return view('admin.plan.index',compact('data'));
    }

    
    public function create()
    {
        // $plan =Plan::collection()->get();
        // dd($plan);
    return  view('admin.plan.create');
    }

    
    public function store(PlanRequest $request)
    {
       
        // dd($request);
        $input= $request->all();
        // dd($input);
        $input['plan_name']=($input['plan_name']);
        $input['price']=($input['price']);
        $input['product_id']=($input['product_id']);
        $input['employee_no']=($input['employee_no']);
        $input['tax_id']=($input['tax_id']);
        $input['description']=($input['description']);
          Plan::create($input);
    // dd($request);
       return redirect()->route('admin.plan.index')->with('success','Plan Subscription Created Successfully');
    }

   
    public function show(string $id)
    {
        //
    }

   
    public function edit($id)
    {
        $data=Plan::find($id);
        // dd($data);
        return view('admin.plan.edit',compact('data'));
    }

    
    public function update(PlanRequest $request, string $id)
    {
        $plan = Plan::find($id);

    // Check if the Plan is not found
    if (!$plan) {
        return redirect()->route('admin.plan.index')->with('error', 'Plan not found');
    }

    $request->validate([
        'plan_name' => 'required',
        'price' => 'required',
        'product_id' => 'required',
        'employee_no' => 'required',
        'tax_id' => 'required',
        'description' => 'required',
       
    ]);

    // Update the Plan document based on the form data
    $plan->update([
        'plan_name' => $request->input('plan_name'),
        'price' => $request->input('price'),
        'product_id' => $request->input('product_id'),
        'employee_no' => $request->input('employee_no'),
        'tax_id' => $request->input('tax_id'),
        'description' => $request->input('description'),
  
    ]);

  
    return redirect()->route('admin.plan.index')->with('success', 'Plan updated successfully');
}


   
    public function destroy($id)
    {
        // dd($id);
        $result = Plan::where('_id', $id)->delete();
// dd('deleteed');
return response()->json(['status'=>'Plan deleted successfully']);
        // Check the result of the delete operation
        // if ($result) {
        //    return response()->json(['status'=>'Plan deleted successfully']);
            // return redirect()->route('admin.plan.index')->with('success', 'Plan deleted successfully');
        // } else {
        //    return redirect()->route('admin.plan.index')->with('error', 'Failed to delete plan');
        // }
        
    }

}
