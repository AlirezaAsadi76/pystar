<?php
namespace app;
class help{
    static  public function generateRandomString($length = 25) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
   static public $request_token='Bearer cea2f28c-11df-4848-88f5-8b4b72d66bab';
}
