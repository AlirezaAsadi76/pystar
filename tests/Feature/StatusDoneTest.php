<?php

namespace Tests\Feature;

use App\Models\StatusDone;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatusDoneTest extends TestCase
{
    use ModelHelper;

    protected function model(): Model
    {
        return new StatusDone();
    }
    // public function testStatusDoneRelathionshipWithTransaction()
    // {
    //     $StatusDone=StatusDone::factory()->for(Transaction::factory())->create();
    //     $this->assertTrue(isset($StatusDone->transaction->id));
    // }
}
