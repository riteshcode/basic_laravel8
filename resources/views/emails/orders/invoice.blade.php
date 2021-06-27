@component('mail::message')


@component('mail::table')
|<img src="https://laravel.com/img/notification-logo.png" style="text-align: center;" class="logo" alt="Laravel Logo">|
|:------------------:|
@endcomponent


@component('mail::table')
| Shipping Address| Billing Address|
|:-------------   | --------------:|
| f-67, alli vihar <br/>Sarita vihar <br/>New delhi-100222 | K-78, Alli gaon<br/>Sarita vihar <br/>New delhi-100222 |

@endcomponent


@component('mail::table')
| Product       | Quntity         | Price  |
|:------------- |:-------------:| --------:|
| <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">      | 1 | $10      |
| <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">      | 2 | $20      |
| | Total | $300 |
@endcomponent

@component('mail::panel')
This is the panel content.
@endcomponent

@component('mail::button', ['url' => ''])
Download Invoice
@endcomponent



Thanks,<br>

{{ config('app.name') }}

@endcomponent
