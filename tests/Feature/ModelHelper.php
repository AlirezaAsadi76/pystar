<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

trait ModelHelper
{
    public function testInsertData()
    {
        
        $model=$this->model();
        $data=$model::factory()->make();
        if($data instanceof User)
           {
                $data=$data->toArray();
                $data['password']=123456;
           }
       else
            $data=$data->toArray();
        $model::create($data);
        $this->assertDatabaseHas($model->getTable(),$data);
    }
    abstract protected function model():Model;
}
