# EcommPay PHP SDK

Forked from [ecommpay/paymentpage-sdk](https://github.com/ITECOMMPAY/paymentpage_sdk)

[![Build Status](https://travis-ci.org/ITECOMMPAY/paymentpage_sdk.svg?branch=master)](https://travis-ci.org/ITECOMMPAY/paymentpage_sdk)
[![Test Coverage](https://api.codeclimate.com/v1/badges/13f0385331642461cba7/test_coverage)](https://codeclimate.com/github/ITECOMMPAY/paymentpage_sdk/test_coverage)
[![Maintainability](https://api.codeclimate.com/v1/badges/13f0385331642461cba7/maintainability)](https://codeclimate.com/github/ITECOMMPAY/paymentpage_sdk/maintainability)

This is a set of libraries in the PHP language to ease integration of your service
with the EcommPay Payment Page.

Please note that for correct SDK operating you must have at least PHP 5.3.10  

## Payment flow

![Payment flow](flow.png)

## Installation

Install with composer
```bash
composer require ecommpay/paymentpage-sdk
```

### Get URL for payment

```php
$gate = new ecommpay\Gate('secret');
$payment = new ecommpay\Payment(100);
$payment->setPaymentAmount(1000)->setPaymentCurrency('RUB');
$url = $gate->getPurchasePaymentPageUrl($payment);
``` 

`$url` here is the signed URL.

### Handle callback from Ecommpay

You'll need to autoload this code in order to handle notifications:

```php
$gate = new ecommpay\Gate('secret');
$callback = $gate->handleCallback($data);
```

`$data` is the JSON data received from payment system;

`$callback` is the Callback object describing properties received from payment system;
`$callback` implements these methods: 
1. `Callback::getPaymentStatus();`
    Get payment status.
2. `Callback::getPayment();`
    Get all payment data.
3. `Callback::getPaymentId();`
    Get payment ID in your system.
    
### TODO

- [x] Payment Page opening 
- [x] Notifications handling
- [ ] Direct Gate requests
- [ ] PHPDoc