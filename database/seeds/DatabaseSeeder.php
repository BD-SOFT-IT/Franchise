<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminRolesTableSeeder::class);

        $this->call(AdminsTableSeeder::class);

        $this->call(ClientsTableSeeder::class);

        $this->call(SiteOptionsTableSeeder::class);

        $this->call(BannersTableSeeder::class);

        $this->call(CategoriesTableSeeder::class);

        $this->call(ProductsTableSeeder::class);

        $this->call(ProductBrandsTableSeeder::class);

        $this->call(ProductCategoriesTableSeeder::class);

        $this->call(DeliveryMethodsTableSeeder::class);

        $this->call(DeliveryLocationsTableSeeder::class);

        $this->call(DeliverySchedulesTableSeeder::class);

        $this->call(CouponsTableSeeder::class);

        $this->call(OrdersTableSeeder::class);

        $this->call(OrderDetailsTableSeeder::class);

        $this->call(ShippersTableSeeder::class);

        $this->call(ApiAgentsTableSeeder::class);

        $this->call(MembershipsTableSeeder::class);

        $this->call(PostsTableSeeder::class);
    }
}
