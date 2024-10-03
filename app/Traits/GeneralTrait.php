<?php

namespace App\Traits;

trait GeneralTrait
{

    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    public function returnError($msg)
    {
        return response()->json([
            'status' => false,
            'msg' => $msg
        ]);
    }


    public function returnSuccessMessage($msg = "",)
    {
        return [
            'status' => true,
            'msg' => $msg
        ];
    }

    public function returnData($key, $value,  )
    {
        return response()->json([
            'status' => true,
         
            $key => $value
        ]);
    }

}
 

