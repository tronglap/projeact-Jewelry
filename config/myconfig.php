<?php
return [
    'product_category' => [
        'item_per_page' => 6
    ],
    'product_per_page' => env('PRODUCT_PER_PAGE', 20),
    'category_product_per_page' => env('CATEGORY_PRODUCT_PER_PAGE', 5),
    'category_blog_per_page' => env('BLOG_CATEGORY_PER_PAGE', 5),
    'blog_per_page' => env('BLOG_PER_PAGE', 10),
    'order_per_page' => env('ORDER_PER_PAGE', 20),
    'user_per_page' => env('USER_PER_PAGE', 20),

    'vnpay' => [
        'TmnCode' => env('VNPAY_TMN_CODE', '2RW8W06C'),
        'HashSecret' => env('VNPAY_HASH_SECRET', 'MWMJUSCDLBKX8WTQECIEBAKML003DDYU'),
        'Url' => env('VNPAY_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
        'Returnurl' => env('VNPAY_RETURN_URL', 'http://127.0.0.1:8000/vnpayCallBack/'),
        'vnp_apiUrl' => env('VNPAY_VNP_API_URL', 'http://sandbox.vnpayment.vn/merchant_webapi/merchant.html'),
        'apiUrl' => env('VNPAY_API_URL', 'https://sandbox.vnpayment.vn/merchant_webapi/api/transaction')
    ]
];