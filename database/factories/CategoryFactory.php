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
                'title' => 'BASIC DETAILS',
                [
                    'title'=>   'Basic Details',
                    'fields'=>  [
                        [
                            'placeholder'   =>  'Select Business Model',
                            'type'  =>  'select',
                            'data'  =>  [2=>'else',5=>'Ahmed', 10=>'Something'],
                        ],
                        [
                            'placeholder'   =>  'Add Url',
                            'type'  =>  'url'
                        ]
                    ]
                ],
                [
                    'title'     =>  'Lorem ipsum',
                    'fields'    =>  [
                        [
                            'placeholder'   =>  'Average monthly traffic',
                            'type'  =>  'number'
                        ],
                        [
                            'placeholder'   =>  'When did the business start',
                            'type'  =>  'date'
                        ],
                        [
                            'placeholder'   =>  'When did the business start making money ',
                            'type'  =>  'date'
                        ],
                    ]
                ],
                [
                    'title'     =>  'Do You Currently Have Either Google Analytics Or Clicky Installed?',
                    'fields'    =>  [
                        [
                            'placeholder'   =>  'Average monthly traffic',
                            'type'  =>  'y_n',
                        ],
                        [
                            'placeholder'   =>  'VERIFY GOOGLE ANALYTICS',
                            'type'  =>  'google_analytics'
                        ],
                    ]
                ],
                [
                    'title' =>  'Business Assets Included',
                    'fields' => [
                        ['type'  =>  'links']
                    ]
                ],
                [
                    'title' =>  'Write a full description of the project',
                    'fields' => [
                        [
                            'placeholder'=> 'Please Make Sure Your Answer Is At Least 250 Characters Long. (Success And Obstacles) ',
                            'type'  =>  'textarea'
                        ]
                    ]
                ],
                [
                    'title' =>  'Briefly Tell Us About Your Business',
                    'fields' => [
                        [
                            'placeholder'=> 'Please make sure your answer is no longer than 150 characters',
                            'type'  =>  'textarea'
                        ]
                    ]
                ],
                [
                    'title' =>  'Add Photos And Media',
                    'fields' => [
                        [
                            'type'  =>  'assets'
                        ]
                    ]
                ],
            ],
            [
                'title' => 'Price',
                [
                    'title' =>  'Price',
                    'fields' => [
                        [
                            'placeholder'=> 'Price',
                            'type'  =>  'number'
                        ]
                    ]
                ],[
                    'title' =>  'Automatic Expiration Setting And Automatic Price Determination From The Expiration Date.',
                    'fields' => [
                        [
                            'type'  =>  'checkbox'
                        ]
                    ]
                ],
            ],
            [
                'title' => 'Site Service',
                [
                    'title' =>  'Price',
                    'fields' => [
                        [
                            'placeholder'=> 'Price',
                            'type'  =>  'number'
                        ]
                    ]
                ],
                [
                    'title' =>  'Automatic Expiration Setting And Automatic Price Determination From The Expiration Date.',
                    'fields' => [
                        [
                            'type'  =>  'checkbox'
                        ]
                    ]
                ],
            ]
        ];

        return $data;
    }
}
