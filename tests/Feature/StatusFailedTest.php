<?php

namespace Tests\Feature;

use App\Models\StatusFailed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatusFailedTest extends TestCase
{
    use ModelHelper;

    protected function model(): Model
    {
        return new StatusFailed();
    }
    // public function testStatusFailedRelathionshipWithTransactions()
    // {
    //     $count=rand(1,10);
    //     $StatusFailed=StatusFailed::factory()->hasTransactions($count)->create();
    //     $this->assertCount($count,$StatusFailed->transactions);
    // }
}
