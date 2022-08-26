<?php

use Illuminate\Database\Seeder;

use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = ['essenziali', 'wi-fi', 'vista sul mare', 'vista sul giardino', 'shampoo', 'balsamo', 'vista sulle montagne', 'vasca da bagno', 'bidet', 'doccia all\'aperto', 'cassaforte', 'cuscini e coperte extra', 'ferro da stiro', 'culla', 'seggiolone', 'climatizzatore', 'riscaldamento', 'estintore', 'kit di pronto soccorso', 'lavastovigle', 'garage', 'barbecue', 'ingresso privato', 'accesso alla spiaggia', 'accesso al lago'];

        foreach($services as $service) {
            $newService = new Service();
            $newService->name = $service;
            $newService->save();
        }
    }
}
