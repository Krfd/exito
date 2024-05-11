<?php

$key = bin2hex(random_bytes(64));
$token = hash_hmac('sha256', 'CSRF Booking Token', $key);

?>