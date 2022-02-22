<?php

namespace Tests\Feature;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    use ModelHelper;

    protected function model(): Model
    {
        return new User();
    }
    public function testUserRealtionshipWithTransactions()
    {
        $count=rand(1,10);
        $user=User::factory()->hasTransactions($count)->create();
        $this->assertCount($count,$user->transactions);
        $this->assertTrue($user->transactions->first() instanceof Transaction);
    }
}
