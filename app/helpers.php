<?php

if (!function_exists('midtrans_client_key')) {
    function midtrans_client_key()
    {
        return env('MIDTRANS_CLIENT_KEY');
    }
}
