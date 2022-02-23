<?php

namespace App\Http\Controllers;

use app\help;
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
use Illuminate\Support\Facades\Auth;
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
        // $user=Auth::user();

       if($request->header('Authorization')==help::$request_token)
       {
        $flagestatus=false;
        $message_error=['VALIDATION_ERROR','Source And destination accounts are the same!'];
       }
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
            'refCode'=>help::generateRandomString(16)
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
        return response()->json(new TransactionFailed($transaction->statusable),400);
    return new TransactionDone($transaction->statusable);
    }
    public function showTransactions(User $user)
    {

        return new TransactionCollection($user->transactions()->paginate(25));
    }


}
