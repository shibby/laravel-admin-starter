<?php

namespace App\Console\Commands;

use App\Model\City;
use App\Model\Company;
use App\Model\CompanyContact;
use App\Model\District;
use Illuminate\Console\Command;

class CrawlVeterinerCoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:veterinerco';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $data = \GuzzleHttp\json_decode(\File::get(database_path('veterinerco.json')), true);

        foreach ($data as $datum) {
            if ('Afyon' === $datum['city']) {
                $datum['city'] = 'Afyonkarahisar';
            }
            $city = City::where('name', $datum['city'])->first();

            $district = District::where('name', $datum['district'])
                ->where('city_id', $city->id)
                ->first();
            if (!$district) {
                $district = new District();
                $district->name = $datum['district'];
                $district->city_id = $city->id;
                $district->save();
            }

            $company = new Company();
            $company->name = $datum['name'];
            $company->city_id = $city->id;
            $company->district_id = $district->id;
            $company->status = Company::STATUS_ACTIVE;
            $company->save();

            $company->categories()->sync([1]);
            $contact = new CompanyContact();
            $contact->company_id = $company->id;
            $contact->address = $datum['address'];
            $contact->phone = $datum['phone'];
            $contact->save();
        }
    }
}
