<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $description = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ';

        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Grocery & Foods',
            'category_title_bangla' => 'মুদিপণ্য ও খাবার',
            'category_description'  => $description,
            'category_slug'         => 'grocery-and-foods',
            'category_type'         => 'parent',
            'category_order'        => 1
        ]);

        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Home Appliances',
            'category_title_bangla' => 'ঘর সরঞ্জাম',
            'category_description'  => $description,
            'category_slug'         => 'home-appliances',
            'category_type'         => 'parent',
            'category_order'        => 2
        ]);

        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Beauty & Health',
            'category_title_bangla' => 'রূপচর্চা ও স্বাস্থ্য',
            'category_description'  => $description,
            'category_slug'         => 'beauty-and-health',
            'category_type'         => 'parent',
            'category_order'        => 3
        ]);

        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Stationary Products',
            'category_title_bangla' => 'ষ্টেশনারী পণ্য',
            'category_description'  => $description,
            'category_slug'         => 'stationary-products',
            'category_type'         => 'parent',
            'category_order'        => 4
        ]);

        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Men Fashion',
            'category_title_bangla' => 'ছেলেদের ফ্যাশন',
            'category_description'  => $description,
            'category_slug'         => 'men-fashion',
            'category_type'         => 'parent',
            'category_order'        => 5
        ]);

        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Women Fashion',
            'category_title_bangla' => 'মেয়েদের ফ্যাশন',
            'category_description'  => $description,
            'category_slug'         => 'women-fashion',
            'category_type'         => 'parent',
            'category_order'        => 6
        ]);

        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Fruits',
            'category_title_bangla' => 'ফল',
            'category_description'  => $description,
            'category_slug'         => 'fruits',
            'category_type'         => 'child',
            'category_parent_id'    => 1,
            'category_order'        => 1.01
        ]);

        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Vegetables',
            'category_title_bangla' => 'শাক-সব্জি',
            'category_description'  => $description,
            'category_slug'         => 'vegetables',
            'category_type'         => 'child',
            'category_parent_id'    => 1,
            'category_order'        => 1.02
        ]);
        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Fish & Meat',
            'category_title_bangla' => 'মাছ ও মাংস',
            'category_description'  => $description,
            'category_slug'         => 'fish-and-meat',
            'category_type'         => 'child',
            'category_parent_id'    => 1,
            'category_order'        => 1.03
        ]);
        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Grocery Items',
            'category_title_bangla' => 'মুদি পণ্য',
            'category_description'  => $description,
            'category_slug'         => 'grocery-items',
            'category_type'         => 'child',
            'category_parent_id'    => 1,
            'category_order'        => 1.04
        ]);
        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Dairy',
            'category_title_bangla' => 'দুগ্ধ পণ্য',
            'category_description'  => $description,
            'category_slug'         => 'dairy',
            'category_type'         => 'child',
            'category_parent_id'    => 1,
            'category_order'        => 1.05
        ]);
        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Bread & Bakery',
            'category_title_bangla' => 'পাউরুটি ও বেকারী',
            'category_description'  => $description,
            'category_slug'         => 'bread-and-bakery',
            'category_type'         => 'child',
            'category_parent_id'    => 1,
            'category_order'        => 1.06
        ]);
        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Frozen & Canned',
            'category_title_bangla' => 'ফ্রোজেন',
            'category_description'  => $description,
            'category_slug'         => 'frozen-and-canned',
            'category_type'         => 'child',
            'category_parent_id'    => 1,
            'category_order'        => 1.07
        ]);
        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Snacks & Beverages',
            'category_title_bangla' => 'স্ন্যাকস ও পানীয়',
            'category_description'  => $description,
            'category_slug'         => 'snacks-and-beverages',
            'category_type'         => 'child',
            'category_parent_id'    => 1,
            'category_order'        => 1.08
        ]);
        // Home Appliances (2)
        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Kitchen Accessories',
            'category_title_bangla' => 'রান্নাঘর সামগ্রী',
            'category_description'  => $description,
            'category_slug'         => 'kitchen-accessories',
            'category_type'         => 'child',
            'category_parent_id'    => 2,
            'category_order'        => 2.01
        ]);
        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Cleaning Accessories',
            'category_title_bangla' => 'পরিচ্ছন্নতা সামগ্রী',
            'category_description'  => $description,
            'category_slug'         => 'cleaning-accessories',
            'category_type'         => 'child',
            'category_parent_id'    => 2,
            'category_order'        => 2.02
        ]);
        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Napkins & Paper Products',
            'category_title_bangla' => 'নেপকিন ও কাগজ পণ্য',
            'category_description'  => $description,
            'category_slug'         => 'napkins-and-paper-products',
            'category_type'         => 'child',
            'category_parent_id'    => 2,
            'category_order'        => 2.03
        ]);
        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Air Fresheners',
            'category_title_bangla' => 'বায়ু সুগন্ধী',
            'category_description'  => $description,
            'category_slug'         => 'air-fresheners',
            'category_type'         => 'child',
            'category_parent_id'    => 2,
            'category_order'        => 2.04
        ]);

        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Fresh Fruits',
            'category_title_bangla' => 'তাজা ফল',
            'category_description'  => $description,
            'category_slug'         => 'fresh-fruits',
            'category_type'         => 'filtering',
            'category_parent_id'    => 7,
            'category_order'        => 7.01
        ]);

        DB::table('categories')->insert([
            'category_creator_id'   => 1,
            'category_title'        => 'Dry Fruits',
            'category_title_bangla' => 'শুকনো ফল',
            'category_description'  => $description,
            'category_slug'         => 'dry-fruits',
            'category_type'         => 'filtering',
            'category_parent_id'    => 7,
            'category_order'        => 7.02
        ]);
        // Beauty & Health 3
        for($i=1; $i<8; $i++) {
            DB::table('categories')->insert([
                'category_creator_id'   => 1,
                'category_title'        => 'Beauty & Health ' . $i,
                'category_title_bangla' => 'রূপচর্চা ও স্বাস্থ্য ' . $i,
                'category_description'  => $description,
                'category_slug'         => 'beauty-and-health-' . $i,
                'category_type'         => 'child',
                'category_parent_id'    => 3,
                'category_order'        => 3.0 + ($i/100)
            ]);
        }

        // Stationary Products 4
        for($i=1; $i<5; $i++) {
            DB::table('categories')->insert([
                'category_creator_id'   => 1,
                'category_title'        => 'Stationary Products ' . $i,
                'category_title_bangla' => 'ষ্টেশনারী পণ্য ' . $i,
                'category_description'  => $description,
                'category_slug'         => 'stationary-products-' . $i,
                'category_type'         => 'child',
                'category_parent_id'    => 4,
                'category_order'        => 4.0 + ($i/100)
            ]);
        }

        // Men Fashion 5
        for($i=1; $i<5; $i++) {
            DB::table('categories')->insert([
                'category_creator_id'   => 1,
                'category_title'        => 'Men Fashion ' . $i,
                'category_title_bangla' => 'ছেলেদের ফ্যাশন ' . $i,
                'category_description'  => $description,
                'category_slug'         => 'men-fashion-' . $i,
                'category_type'         => 'child',
                'category_parent_id'    => 5,
                'category_order'        => 5.0 + ($i/100)
            ]);
        }

        // Women Fashion 6
        for($i=1; $i<5; $i++) {
            DB::table('categories')->insert([
                'category_creator_id'   => 1,
                'category_title'        => 'Women Fashion ' . $i,
                'category_title_bangla' => 'মেয়েদের ফ্যাশন ' . $i,
                'category_description'  => $description,
                'category_slug'         => 'women-fashion-' . $i,
                'category_type'         => 'child',
                'category_parent_id'    => 6,
                'category_order'        => 6.0 + ($i/100)
            ]);
        }

    }
}
