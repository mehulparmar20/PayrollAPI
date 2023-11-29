<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Requests\PlanRequest;
use App\Models\Taxmaster;


class PlanController extends Controller
{
    
    public function index()
    { 
        $tempid=0;
        $data = Plan::with('taxmaster')->get();  
        // $data=Plan::all();
        return view('admin.plan.index',compact('data','tempid'));
    }

    
    public function create()
    {
        $tax= Taxmaster::select('tax_name', '_id')->get();
        // $plan =Plan::collection()->get();
        // dd($tax);
    return  view('admin.plan.create',compact('tax'));
    }

    
    public function store(PlanRequest $request)
    {

        $new_id = Plan::max('_id');

      // $dat=((int)$new_id)+1;
       dd($new_id);
        // dd($request);
        $input= $request->all();
        // dd($input);
        $input['_id']=$new_id;
        $input['plan_name']=($input['plan_name']);
        $input['price']=($input['price']);
        $input['employee_no']=($input['employee_no']);
        $input['tax_id']=($input['tax_id']);
        $input['description']=($input['description']);
          Plan::create($input);
    // dd($input);
       return redirect()->route('admin.plan.index')->with('success','Plan Subscription Created Successfully');
    }
// public function store(PlanRequest $request)
//     {
//         $getCompany = Plan::max('_id');
//         // dd($getCompany);
//         $new_id=$getCompany;
//     //   dd($new_id);
//         $data=array(
//             // '_id' => $new_id,
//             'plan_name' => $request->input('plan_name'),
//             'price' => $request->input('price'),
//             'employee_no' =>$request->input('employee_no'),
//             'tax_id' => $request->input('tax_id'),
//             'description' => $request->input('description'),
            
           
//         );
       
//         $result = Plan::insert($data);
//         // dd($result);
//         return response()->json(['success' => 'Plan Adder successfully'], 201);
    
     
// }
   
    public function show(string $id)
    {
        $plan=Plan::find($id);
        // dd($data);
        return view('admin.plan.view',compact('plan'));
    }

   
    public function edit($id)
    {
        $data=Plan::find($id);
        // dd($data);
       $tax = Taxmaster::select('tax_name', '_id')->get();
        return view('admin.plan.edit',compact('data','tax'));
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
        'employee_no' => 'required',
        'tax_id' => 'required',
        'description' => 'required',
       
    ]);

    // Update the Plan document based on the form data
    $plan->update([
        'plan_name' => $request->input('plan_name'),
        'price' => $request->input('price'),
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

        // Check the result of the delete operation
        // if ($result) {
            return response()->json(['status'=>'Plan deleted successfully']);
            // return redirect()->route('admin.plan.index')->with('success', 'Plan deleted successfully');
        // } else {
        //    return redirect()->route('admin.plan.index')->with('error', 'Failed to delete plan');
        // }
        
    }

}
