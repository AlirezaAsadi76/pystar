<?php

namespace Database\Factories;

use app\help;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusDoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function generateRandomString($length = 25) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function definition()
    {

        $type=array('internal','paya');
        return [
            'amount'=>random_int(100,100000000),
            'description'=>$this->faker->text(),
            'destinationFirstname'=>$this->faker->name(),
            'destinationLastname'=>$this->faker->lastName(),
            'destinationNumber'=>help::generateRandomString(16),
            'inquiryDate'=>strval($this->faker->year).strval($this->faker->month).strval($this->faker->dayOfMonth()),
            'inquirySequence'=>random_int(100,10000),
            'inquiryTime'=>strval($this->faker->time('His')),
            'paymentNumber'=>help::generateRandomString(16),
            'refCode'=>help::generateRandomString(16)
        ];
    }
}
