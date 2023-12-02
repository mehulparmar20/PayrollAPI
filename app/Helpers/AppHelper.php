<?php
namespace App\Helpers;
use App\Models\Shipper;
use Auth;
use App\Models\API\Company_Admins;
use Illuminate\Support\Facades\DB;

class AppHelper
{
    public static function instance()
    {
        return new AppHelper();
    }

    public function checkDoc($collection,$companyId,$maxLength)
    {
        // dd($collection);
        $show = $collection->count(['company_id' => (int)$companyId]);
       
        if($show != 0){
                $show = $collection->aggregate([
                    ['$match' => ['company_id' => (int)$companyId]],
                    ['$sort' => ['_id' => -1]],
                    ['$limit' => 1]
                ]);
              // dd($show);
                foreach ($show as $s1){
                    $doc_id = $s1['_id'];
                    $ncounter = $s1['counter'];
                }  
                // if($ncounter >= $maxLength){
                //     $document = "No";
                // }
                // else{

                    $document = $ncounter ."^". $doc_id;
                // } 
                // dd($document);

        }else{
            $document = "No";
        }
        // dd($document);
        return $document;
    }
    // public function bearer_token(\Illuminate\Http\Request $request)
    // {
    //     $header = $request->header('Authorization');
    //         //  dd($header);
    //     // do some stuff
    // }
}