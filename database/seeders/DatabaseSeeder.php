<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\ClientComment;
use App\Models\FAQ;
use App\Models\Package;
use App\Models\Product;
use App\Models\ProductData;
use App\Models\SocialMediaAccount;
use App\Models\SocialMediaLink;
use App\Models\Subcategory;
use App\Models\TermsOfUse;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        User::factory(5)->create();
        Category::factory(8)->create();
//        Subcategory::factory(10)->create();
//        BlogPost::factory(50)->create();
//        ClientComment::factory(10)->create();
//        Package::factory(7)->create();
//        AboutUs::factory(1)->create();
//        FAQ::factory(50)->create();
//        TermsOfUse::factory(2)->create();
//        SocialMediaAccount::factory(5)->create();
//
//        Product::factory(50)->create();
//        ProductData::factory(50)->create();
    }
}
