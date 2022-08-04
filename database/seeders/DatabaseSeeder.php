<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use App\Models\Admin;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\ClientComment;
use App\Models\FAQ;
use App\Models\HomeText;
use App\Models\Package;
use App\Models\Product;
use App\Models\ProductData;
use App\Models\ProductView;
use App\Models\SocialMediaAccount;
use App\Models\SocialMediaLink;
use App\Models\Subcategory;
use App\Models\TermsOfUse;
use App\Models\User;
use App\Models\UserVerificationAssets;
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
        User::factory(5)->create();
        UserVerificationAssets::factory(5)->create();

        Category::factory(8)->create();
        Subcategory::factory(10)->create();
        BlogPost::factory(50)->create();
        ClientComment::factory(10)->create();
        Package::factory(7)->create();
        AboutUs::factory(1)->create();
        FAQ::factory(50)->create();
        TermsOfUse::factory(2)->create();
        SocialMediaAccount::factory(5)->create();

        Product::factory(50)->create();
        ProductData::factory(50)->create();
        ProductView::factory(10000)->create();

        Admin::factory(1)->create();

        //aya
        HomeText::query()->create([
            'key' => 'first_section',
            'value' => 'some text'
        ]);
        HomeText::query()->create([
            'key' => 'cookie',
            'value' => 'some text'
        ]);
        HomeText::query()->create([
            'key' => 'deskise',
            'value' => 'some text'
        ]);
        HomeText::query()->create([
            'key' => 'request_product',
            'value' => 'some text'
        ]);
        HomeText::query()->create([
            'key' => 'about_us',
            'value' => 'some text'
        ]);
        HomeText::query()->create([
            'key' => 'staff',
            'value' => 'some text'
        ]);
        HomeText::query()->create([
            'key' => 'trust_clients',
            'value' => 'some text'
        ]);
        HomeText::query()->create([
            'key' => 'connect_us',
            'value' => 'some text'
        ]);
        HomeText::query()->create([
            'key' => 'close_account',
            'value' => 'some text'
        ]);
        HomeText::query()->create([
            'key' => 'payout_request',
            'value' => 'some text'
        ]);
    }
}
