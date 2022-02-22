<?php

namespace Tests\Feature;

use App\Models\StatusDone;
use App\Models\StatusFailed;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{

    use ModelHelper;

    protected function model(): Model
    {
        return new Transaction();
    }
    public function testTransactionRelationshipWithUser()
    {
        $transaction=Transaction::factory()->for(User::factory())->create();
        $this->assertTrue(isset($transaction->user->id));
        $this->assertTrue($transaction->user instanceof User);
    }
    public function testTransactionRelationshipWithStatusDone()
    {
        $transaction=Transaction::factory()->hasStatusable(StatusDone::factory())->create();
        var_dump($transaction->statusable_type);
        $this->assertTrue(isset($transaction->statusable->id));

    }
    public function testTransactionRelationshipWithStatusFailed()
    {
        $transaction=Transaction::factory()->hasStatusable(StatusFailed::factory())->create();
        var_dump($transaction->statusable_type);
        $this->assertTrue(isset($transaction->statusable->id));
        // $this->assertTrue($transaction->statusable instanceof StatusFailed);

    }
}
