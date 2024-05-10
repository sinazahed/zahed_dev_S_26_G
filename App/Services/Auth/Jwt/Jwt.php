<?php
namespace App\Services\Auth\Jwt;

class Jwt
{
    const KEY = "sina-key";
    const DECODEALG = 'sha256';

    const header = [
        'typ' => 'JWT',
        'alg' => 'HS256'
    ];

    public static function encode($payload,$algorithm) :string
    {
        $header = json_encode(self::header);
        $header = base64_encode($header);

        $payload = json_encode($payload);
        $payload = base64_encode($payload);
        
        $signature = hash_hmac("{$algorithm}", "{$header}.{$payload}", self::KEY, true);
        $signature = base64_encode($signature);

        return  "{$header}.{$payload}.{$signature}";
    }

    public static function decode($jwt): array
    {
        list($header, $payload, $signature) = explode('.', $jwt);

        $decodedHeader = base64_decode($header);
        $decodedPayload = base64_decode($payload);

        $decodedSignature = base64_decode($signature);
        $computedSignature = hash_hmac(self::DECODEALG, "{$header}.{$payload}", self::KEY, true);

        if (hash_equals($decodedSignature, $computedSignature))
            return json_decode($decodedPayload, true);
        return null;
    }


}