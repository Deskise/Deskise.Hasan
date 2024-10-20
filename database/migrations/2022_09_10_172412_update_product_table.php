<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['name_en','description_en','summary_en','name_ar','description_ar','summary_ar']);
            $table->string('description')->after('user_id');
            $table->string('summary')->after('user_id');
            $table->string('name')->after('user_id');

            // UPDATE category data:
            DB::update('UPDATE categories SET data=?',[
                json_encode([
                    [
                        "title" => "BASIC DETAILS",
                        "divs" => [
                            [
                                "title"=>   "Basic Details",
                                "fields"=>  [
                                    [
                                        "placeholder"   =>  "Select Business Model",
                                        "type"  =>  "drop_list",
                                        "name"  =>  strtolower(Str::random()),
                                        "data"  =>  [2=>"else",5=>"Ahmed", 10=>"Something"],
                                    ],
                                    [
                                        "placeholder"   =>  "Add Url",
                                        "name"  =>  strtolower(Str::random()),
                                        "type"  =>  "url",
                                        "hint"  =>  "lorem ipsum"
                                    ]
                                ]
                            ],
                            [
                                "title"     =>  "Lorem ipsum",
                                "fields"    =>  [
                                    [
                                        "placeholder"   =>  "Average monthly traffic",
                                        "type"  =>  "number",
                                        "name"  =>  strtolower(Str::random()),
                                        "data"  =>  [
                                            "min"   =>  0,
                                            "max"   =>  400
                                        ]
                                    ],
                                    [
                                        "placeholder"   =>  "When did the business start",
                                        "type"  =>  "date",
                                        "name"  =>  strtolower(Str::random()),
                                        "data"  =>  [
                                            "start" =>  "",
                                            "end"   =>  ""
                                        ]
                                    ],
                                    [
                                        "placeholder"   =>  "When did the business start making money ",
                                        "name"  =>  strtolower(Str::random()),
                                        "type"  =>  "date"
                                    ],
                                ]
                            ],
                            [
                                "title"     =>  "Do You Currently Have Either Google Analytics Or Clicky Installed?",
                                "fields"    =>  [
                                    [
                                        "placeholder"   =>  "Average monthly traffic",
                                        "type"  =>  "y_n",
                                        "name"  =>  strtolower(Str::random()),
                                    ],
                                    [
                                        "placeholder"   =>  "VERIFY GOOGLE ANALYTICS",
                                        "type"  =>  "table",
                                        "name"  =>  strtolower(Str::random()),
                                        "data"  =>  [
                                            "rows"  =>  [
                                                "months", "profit", "visits"
                                            ],
                                            "cols"  =>  [
                                                "1","2","3","4","5","6","7","8","9","10","11","12"
                                            ]
                                        ],
                                    ],
                                ]
                            ],
                            [
                                "title" =>  "Business Assets Included",
                                "fields" => [
                                    [
                                        "type"  =>  "links",
                                        "name"  =>  strtolower(Str::random()),
                                    ]
                                ]
                            ],
                            [
                                "title" =>  "Write a full description of the project",
                                "fields" => [
                                    [
                                        "placeholder"=> "Please Make Sure Your Answer Is At Least 250 Characters Long. (Success And Obstacles) ",
                                        "type"  =>  "textarea",
                                        "name"  =>  strtolower(Str::random()),
                                        "data"  => ['min'=>250]
                                    ]
                                ]
                            ],
                            [
                                "title" =>  "Briefly Tell Us About Your Business",
                                "fields" => [
                                    [
                                        "placeholder"=> "Please make sure your answer is no longer than 150 characters",
                                        "type"  =>  "textarea",
                                        "name"  =>  strtolower(Str::random()),
                                        "data"  =>  ['max'=>150]
                                    ]
                                ]
                            ],
                            [
                                "title" =>  "Add Photos And Media",
                                "fields" => [
                                    [
                                        "type"  =>  "assets",
                                        "name"  =>  strtolower(Str::random()),
                                    ]
                                ]
                            ],
                        ]
                    ],
                    [
                        "title" => "Price",
                        "divs" => [
                            [
                                "title" =>  "Price",
                                "fields" => [
                                    [
                                        "placeholder"=> "Price",
                                        "type"  =>  "number",
                                        "name"  =>  strtolower(Str::random()),
                                    ],[
                                        "type"  =>  "checkbox",
                                        "name"  =>  strtolower(Str::random()),
                                        "placeholder"=> "Automatic Expiration Setting And Automatic Price Determination From The Expiration Date.",
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        "title" => "Site Service",
                        "divs"=>[
                            [
                                "title" =>  "Price",
                                "fields" => [
                                    [
                                        "placeholder"=> "Price",
                                        "type"  =>  "number",
                                        "name"  =>  strtolower(Str::random()),
                                    ],[
                                        "type"  =>  "checkbox",
                                        "name"  =>  strtolower(Str::random()),
                                        "placeholder"=> "Automatic Expiration Setting And Automatic Price Determination From The Expiration Date.",
                                    ]
                                ]
                            ]
                        ],
                    ]
                ])
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
