<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Application;
use App\Models\Broker;
use App\Models\CreditProduct;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class MySQLTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customersData = json_decode(file_get_contents(database_path('seeders/data/customers.json')), true);
        foreach ($customersData as $customerData) {
            Customer::create($customerData);
        }

        $addressesData = json_decode(file_get_contents(database_path('seeders/data/addresses.json')), true);
        foreach ($addressesData as $addressData) {
            Address::create($addressData);
        }

        $brokersData = json_decode(file_get_contents(database_path('seeders/data/brokers.json')), true);
        foreach ($brokersData as $brokerData) {
            Broker::create($brokerData);
        }

        $creditProductsData = json_decode(file_get_contents(database_path('seeders/data/credit_products.json')), true);
        foreach ($creditProductsData as $creditProductData) {
            CreditProduct::create($creditProductData);
        }

        $applicationsData = json_decode(file_get_contents(database_path('seeders/data/applications.json')), true);
        foreach ($applicationsData as $applicationData) {
            Application::create($applicationData);
        }

        Application::find(1)->update(['status' =>'PROCESSING']);
        Application::find(1)->update(['status'=> 'APPROVED']);
        Application::find(1)->update(['status'=> 'COMPLETED']);
        Application::find(2)->update(['status'=> 'DECLINED']);
        Application::find(3)->update(['status'=> 'CANCELLED']);
        Application::find(7)->update(['status'=> 'APPROVED']);
    }
}
