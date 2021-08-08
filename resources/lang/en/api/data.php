<?php

    return [
        'errors'    =>  [

            'headers'   =>  [
                'notProvided'   =>  'You Must Provide (:name) on request header',
                'noMatch'       =>  [
                    'array' =>  '(:name) must be one of this (:values)',
                    'str'   =>  '(:name) must be (:value)'
                ],
            ],


            'requests'  =>  [
                'notValid'  =>  'error validating the request',
                'messages'  =>  [
                    'contact'   =>  [
                        'name.required' =>  'name must be provided'
                        ///TODO: Complete This shit
                    ],
                    'products'  =>  [
                        'email.required' =>  'name must be provided'
                        ///TODO: Complete This shit
                    ],
                ]
            ]
        ],


        'contact'   =>  [
            'message'   =>  [
                'success'   =>  'New Contact Message Created Successfully',
            ]
        ],


        'products'  =>  [
            'request'   =>  [
                'success'   =>  'Product Request Sent Successfully'
            ]
        ]
    ];
