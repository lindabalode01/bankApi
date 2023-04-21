<?php
require_once 'vendor/autoload.php';

$bank = new App\BankApiClient();
$usersAmount = (float)(readline('Enter amount: '));
$usersCurrencyChoice = readline('Enter currency: ');
echo $bank->convert($usersCurrencyChoice, $usersAmount);
