<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = [];
        foreach (\LaravelLocalization::getSupportedLocales() as $lang => $props)
        {
            $data['name_'.$lang] = $this->faker->text(15);
        }
        $data['data']   =   [
            [
                "title" => "BASIC DETAILS",
                "divs" => [
                    [
                        "title"=>   "Basic Details",
                        "fields"=>  [
                            [
                                "placeholder"   =>  "Select Business Model",
                                "type"  =>  "drop_list",
                                'name'  =>  $this->faker->text(10),
                                "data"  =>  [2=>"else",5=>"Ahmed", 10=>"Something"],
                            ],
                            [
                                "placeholder"   =>  "Add Url",
                                "type"  =>  "url",
                                'name'  =>  $this->faker->text(10),
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
                                'name'  =>  $this->faker->text(10),
                                "data"  =>  [
                                    "min"   =>  0,
                                    "max"   =>  400
                                ]
                            ],
                            [
                                "placeholder"   =>  "When did the business start",
                                "type"  =>  "date",
                                'name'  =>  $this->faker->text(10),
                                "data"  =>  [
                                    "start" =>  "",
                                    "end"   =>  ""
                                ]
                            ],
                            [
                                'name'  =>  $this->faker->text(10),
                                "placeholder"   =>  "When did the business start making money ",
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
                                'name'  =>  $this->faker->text(10),
                            ],
                            [
                                "placeholder"   =>  "VERIFY GOOGLE ANALYTICS",
                                "type"  =>  "table",
                                'name'  =>  $this->faker->text(10),
                                "date"  =>  [
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
                                'name'  =>  $this->faker->text(10),
                                "type"  =>  "links"
                            ]
                        ]
                    ],
                    [
                        "title" =>  "Write a full description of the project",
                        "fields" => [
                            [
                                "placeholder"=> "Please Make Sure Your Answer Is At Least 250 Characters Long. (Success And Obstacles) ",
                                'name'  =>  $this->faker->text(10),
                                "type"  =>  "textarea"
                            ]
                        ]
                    ],
                    [
                        "title" =>  "Briefly Tell Us About Your Business",
                        "fields" => [
                            [
                                "placeholder"=> "Please make sure your answer is no longer than 150 characters",
                                'name'  =>  $this->faker->text(10),
                                "type"  =>  "textarea"
                            ]
                        ]
                    ],
                    [
                        "title" =>  "Add Photos And Media",
                        "fields" => [
                            [
                                'name'  =>  $this->faker->text(10),
                                "type"  =>  "assets"
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
                                'name'  =>  $this->faker->text(10),
                                "type"  =>  "number"
                            ],[
                                "type"  =>  "checkbox",
                                'name'  =>  $this->faker->text(10),
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
                                'name'  =>  $this->faker->text(10),
                                "type"  =>  "number"
                            ],[
                                "type"  =>  "checkbox",
                                'name'  =>  $this->faker->text(10),
                                "placeholder"=> "Automatic Expiration Setting And Automatic Price Determination From The Expiration Date.",
                            ]
                        ]
                    ]
                ],
            ]
        ];

        return $data;
    }
}
