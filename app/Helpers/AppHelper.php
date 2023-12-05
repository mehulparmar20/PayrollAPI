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

    public function getNextSequenceForNewDoc($collection)//w
    {
        $maxId = $collection->aggregate([
            ['$group' => ['_id' => null, 'max_id' => ['$max' => '$_id']]],
        ])->toArray();

        if (!empty($maxId)) {
            $maxId = $maxId[0]['max_id'];
            $parentId = $maxId + 1;
        } else {
            $parentId = 1; // If no documents found for the company, start with 1
        }

        return $parentId;
    }

    public function getNextSequenceForNewId($collection,$name,$id,$companyId)//w
    {
        $result = $collection->aggregate([
            ['$match' => ['companyID' => $companyId]],
            ['$unwind' => '$'.$name],
            ['$group' => ['_id' => null, 'maxId' => ['$max' => $id]]],
        ]);
        
        $resultArray = $result->toArray();
        if (count($resultArray) > 0) {
            $maxId = $resultArray[0]['maxId'];
        } else {
            $maxId = 0;
        }
        $Id=$maxId+1;
        return $Id ;
    }

    public function checkDoc($collection,$companyId,$maxLength)  //w
    {
        $show = $collection->count(['company_id' => (int)$companyId]);
        if($show != 0){
                $show = $collection->aggregate([
                    ['$match' => ['company_id' => (int)$companyId]],
                    ['$sort' => ['_id' => -1]],
                    ['$limit' => 1]
                ]);
                foreach ($show as $s1){
                    $doc_id = $s1['_id'];
                    $ncounter = $s1['counter'];
                }
                if($ncounter >= $maxLength){
                    $document = "No";
                }else{
                    $document = $ncounter ."^". $doc_id;
                }

                // dd($document);
        }else{
            $document = "No";
        }
        // dd($document);
        return $document;
    }

    function getAdminDocumentSequence($key,$collection,$val, $docId)
    {
        // dd($key,$collection,$val, $docId);
        $cursor = $collection->find(['company_id'=>(int)$key, '_id' => (int)$docId]);
        $array = iterator_to_array($cursor);
        $id = 0;
        foreach ($array as $value)
        {
            $counter = $value['counter'];
            foreach ($value[$val] as $arr)
            {
                $id = $arr['_id'];
            }
        }
        // dd($id);
        $id += 1;
       $collection->updateOne(['company_id' => (int)$key,'_id'=>(int)$docId],
        ['$inc' => ['counter' => 1]]);
        return $id;
    }
    
    public function paginate($docarray)
    {
        $docarray = array_reverse($docarray);
        $value = 100;
        $doc = array();
        $arrSize = sizeof($docarray);
        for($c = 0; $c < $arrSize; $c++)
        {
            $j = 0;
            $index = array();
            $pages = $docarray[$c]['size'] / $value;
            for($i = 0; $i < $pages; $i++)
            {
                $innerarray = array();
                $innerindex = 0;
                $start = $docarray[$c]['size'] - ($i * $value);
                $end =   $start - $value;
                $innerarray[$innerindex] = array("doc" => $docarray[$c]['id'], "start" => $start, "end" => $end < 0 ? 0 : $end);
                if($start < 100)
                {
                    if($c < sizeof($docarray) - 1)
                    {
                        $diff = $value - $start;
                        $newsize = $docarray[$c+1]['size'] - $diff;
                        $temp = $newsize;
                        if($newsize  < 0)
                        {
                            $newsize = $docarray[$c+1]['size'];
                        }

                        $innerarray[$innerindex+1] = array("doc" => $docarray[$c+1]['id'], "start" => $docarray[$c+1]['size'], "end" => $newsize);
                        if($temp < 0)
                        {
                            $docarray[$c+1]['size'] = 0;
                        }
                        else
                        {
                            $docarray[$c+1]['size'] = $newsize;
                        }
                    }
                }
                $index[$j] = $innerarray;
                $j++;
            }
            $doc[0][] = $index;

        }
        return $doc;
    }


}