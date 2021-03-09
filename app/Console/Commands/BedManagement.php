<?php

namespace App\Console\Commands;

use App\Http\Resources\BedResource;
use App\Repository\Bed\Bed;
use App\Service\Bpjs\KetersediaanTT;
use Illuminate\Console\Command;
ini_set('max_execution_time', 800);

class BedManagement extends Command
{
    /**
     * The name of service and repository
     *
     * @var string
     */
    protected $bed;
    protected $serviceBed;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:bed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Ketersediaan Kamar Aplicares';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->bed = new Bed;
        $this->serviceBed = new KetersediaanTT;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dataBed = BedResource::collection($this->bed->bedAplicare());
        foreach($dataBed as $val) {
        
            $result = json_decode($this->serviceBed->updateBed( "1105R001", json_encode($val)));
            if ($result->metadata->code != 1) {
                count($dataBed) and print " proses data => " .json_decode($this->serviceBed->createBed( "1105R001", json_encode($val)))->metadata->message;
            }
            count($dataBed) and print " proses data => ". $result->metadata->message;
        }

        return;
    }
}
