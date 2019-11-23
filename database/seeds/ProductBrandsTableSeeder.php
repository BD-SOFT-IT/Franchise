<?php

use Illuminate\Database\Seeder;

class ProductBrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = ['Unilever', 'Fresh', 'Teer', 'Pran', 'RFL', 'Rupchada'];
        $brands_bengali = ['ইউনিলিভার', 'ফ্রেশ', 'তীর', 'প্রাণ', 'আরএফএল', 'রূপচাঁদা'];
        $log = makeNewLog([
            'type'          => 'Created',
            'author_id'     => 1,
            'author_name'   => 'Jonson',
            'time'          => \Carbon\Carbon::now()
        ], null, true);

        for($i = 0; $i < 6; $i++) {
            DB::table('product_brands')->insert([
                'pb_name'           => $brands[$i],
                'pb_name_bengali'   => $brands_bengali[$i],
                'pb_website'        => null,
                'pb_phone'          => null,
                'pb_email'          => null,
                'pb_log'            => $log
            ]);
        }
    }
}
