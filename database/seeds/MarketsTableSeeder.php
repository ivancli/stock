<?php

use Illuminate\Database\Seeder;

class MarketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::transaction(function () {
            \DB::table('markets')->insert([
                [
                    'name' => 'New York Stock Exchange',
                    'symbol' => 'NYSE',
                    'resource_url' => 'https://www.nasdaq.com/screening/companies-by-name.aspx?letter=0&exchange=nyse&render=download',
                    'type' => 'csv',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'name' => 'NASDAQ',
                    'symbol' => 'NASDAQ',
                    'resource_url' => 'https://www.nasdaq.com/screening/companies-by-name.aspx?letter=0&exchange=nasdaq&render=download',
                    'type' => 'csv',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'name' => 'American Stock Exchange',
                    'symbol' => 'AMEX',
                    'resource_url' => 'https://www.nasdaq.com/screening/companies-by-name.aspx?letter=0&exchange=amex&render=download',
                    'type' => 'csv',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'name' => 'Australia Security Exchange',
                    'symbol' => 'ASX',
                    'resource_url' => 'https://www.asx.com.au/asx/research/ASXListedCompanies.csv',
                    'type' => 'csv',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
            ]);
        });
    }
}
