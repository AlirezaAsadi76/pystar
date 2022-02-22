<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateTransactionRequest;
use App\Http\Resources\TransactionCollection;
use App\Http\Resources\TransactionDone;
use App\Http\Resources\TransactionFailed;
use App\Models\StatusDone;
use App\Models\StatusFailed;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function PHPUnit\Framework\returnSelf;

class TransactionController extends Controller
{

    public function index()
    {
        //
    }
    public function create(CreateTransactionRequest $request)
    {
        $data='';
        $message_error='';
        $flagestatus=true;
        $user=User::all()->where('name','=',$request->sourceFirstName)
        ->where('lastname','=',$request->sourceLastName)->first();
       if($request->amount>500000000)
       {
        $flagestatus=false;
        $message_error=['VALIDATION_ERROR','Max amount per transaction limitation exceeded'];
       }
       elseif($request->amount<10000)
       {
        $flagestatus=false;
        $message_error=['SERVICE_CALL_ERROR','Minimum amount is 10000 Rials'];
       }

       
       if($flagestatus==false)
       {
           $failed=StatusFailed::create([
            'code'=>$message_error[0],
            'message'=>$message_error[1],
           ]);
           $data=[$failed->id,StatusFailed::class];
       }
       else
       {
            echo '11111';
            $done=StatusDone::create([
            'amount'=>$request->amount,
            'description'=>$request->description,
            'destinationFirstname'=>$request->destinationFirstname,
            'destinationLastname'=>$request->destinationLastname,
            'destinationNumber'=>$request->destinationNumber,
            'inquiryDate'=>strval(date('ymd')),
            'inquirySequence'=>random_int(100,10000),
            'inquiryTime'=>strval(date('his')),
            'paymentNumber'=>$request->paymentNumber,
            'refCode'=>$this->generateRandomString(16)
            ]);
            $data=[$done->id,StatusDone::class];
       }

       $transaction=Transaction::create([
        'user_id'=>$user->id,
        'trackId'=>Str::uuid(),
        'status'=>'DONE',
        'statusable_id'=>$data[0],
        'statusable_type'=>$data[1],
        'reasonDescription'=>$request->reasonDescription,
        'type'=>'paya',
    ]);
    if($flagestatus==false)
        return new TransactionFailed($transaction->statusable);
    return new TransactionDone($transaction->statusable);
    }
    public function showTransactions(User $user)
    {

        return new TransactionCollection($user->transactions);
    }
    public function generateRandomString($length = 25) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
