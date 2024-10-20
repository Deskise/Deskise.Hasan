<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## Commands To Run This Project
- ```cp .env.example .env```
- ```composer install```
- ```artisan serve```
- ```artisan schedule:run```
- ```artisan queue:work```


## TODO:

- [x] رفع المنتج مع تغيير والغاء التحقق من المنتج من خلال الأدمن+ الحفظ كدرافت + عرض المنتج  وتفاصيل المخطط البياني يلي فيه "
ال Is The License For Life!  " تابعه لرفع المنتج فكرتها لما اجي اختار منتج بحدد هل هوا منتهي الصلاحية ولا لا فلو كان منتهي الصلاحية بيكتب تاريخ انتهاء الصلاحية فبيتم انشاء حسبة تلقائيه لسعر المنتج وامتا بيخلص الاشتراك تبع المنتج وبيصير كل شهر بيخلص بيخس سعر المنتج مقدار بال %
مثلا لما أجي ارفع كورس انا شاريه من يودمي وكان بخلص بعد سنه وانا حاطط سعرو 120$ بيصير كل شهر يخلص بدون ما ابيع الكورس بيخس من سعرو 10$ على اساس انو السعر بيتحول ل 100% على عدد الاشهر وبنخصم تلقائي الشهر الاول بيكون 120$ والتاني 110$ والتالت 100$ والرابع 90$ وهكذا …

- [ ] سيناريو الشراء طريقان :

  - [ ] اولا المشتري يقوم بمراجعه تفاصيل المنتج ويقوم ارسال طلب مراسلة للبائع في حال  قام البائع بالقبول يتم المناقشه بالشراء وانشاء اتفاقية شراء والدفع داخل الموقع
  ثانيا شراء مباشر يتحول الي الدفع مباشره ثم يتم تحويله الي صفحه الشات ليتم تسليم الملفات جميعها.

  - [ ] المشتري يدفع للبائع داخل محفظة البنك الخاصه بالدي ثم يتم تسجيل في محفظة البائع المبلغ ويستطيع سحبه بعد 40 يوم من اتمام البيع ( امكانية تعديل عدد الأيام من خلال لوحة التحكم ) بعد الاأيام المتاحه يتم السحب من خلال المستخدم. ويجب تحدد قيمه المبلغ المتمكن سحبه وايضا يتم تغييرها من الداشبورد. ايضا بدنا نرسل كل الداتا لصفحه الارباح الخاصه بالبائع. ( الدفع عبر بوابة سترايب لحساب جاهز وكلشي فيه جاهز  )

- [x]  حل مشكلة تسجيل الدخول / بس بيصير خلل وبيعمل خروج للمستخدم مره او مرتين اول ما يجي يدخل

- [ ] في بروفايل المستخدم يوجد زي لوحه تحكم صغيره  برفع منها بيانات الحساب ومش زابط بعملش حفظ ولا رفع الي هي edit profile ال Payment Cards محطوط بيانات وهمية فبدنا نعرف اذا السترايب بتسمح نحفظ البيانات ولا لا وقتها اذا لا بنحذف بيانات البطاقات  وايضا بدنا  نراجع الداش كلها تعت اليوزر صفحات My sales و Product views بفتحوش

- [ ] الشات : الان الشات جاهزه كاملة كباك اند بس  ممكن نلاقي فيها شويه مشاكل بالاستجابة وتكمله الامور فرعيه  داخل الشات

- [ ] الباقات موجوده بالداتا بيز كاملة ما عدا الأمر يلي بدو يشتغل فيه الباقه ( هاي حنسيبها لاخر المشروع علشان بدي أشوف ايش بدنا خصائص بالباقات بالزبط )  مع التحكم فيها بالداشبورد 
