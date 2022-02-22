<?php

namespace Database\Factories;

use App\Models\StatusDone;
use App\Models\StatusFailed;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TransactionFactory extends Factory
{
    public function selected()
    {
        $result=[];
        $selected=rand(0,1);
        if($selected==1)
        {
            $result=['DONE',StatusDone::factory(),StatusDone::class];
        }
        else
        {
            $result=['FAILED',StatusFailed::factory(),StatusFailed::class];

        }
        return $result;
    }
    public function definition()
    {
        $type=array('internal','paya');
        $result=$this->selected();
        return [
            'user_id'=>User::factory(),
            'trackId'=>Str::random(40),
            'status'=>$result[0],
            'statusable_id'=>$result[1],
            'statusable_type'=>$result[2],
            'reasonDescription'=>$this->faker->text,
            'type'=>$type[array_rand($type)],
        ];
    }
}
