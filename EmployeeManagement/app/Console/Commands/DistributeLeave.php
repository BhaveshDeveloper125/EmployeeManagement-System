<?php

namespace App\Console\Commands;

use App\Models\ExtraUserData;
use Illuminate\Console\Command;

class DistributeLeave extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'distribute:leave';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $records = ExtraUserData::all();

        foreach ($records as $i) {
            $sum = (int)$i->leaves + (int)$i->unused_leaves;

            $i->update([
                'leaves' => '12',
                'unused_leaves' => $sum
            ]);
        }
    }
}
