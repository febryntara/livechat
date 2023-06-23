<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MessageEncryption;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['chipertext', 'room_code', 'customer_code', 'cs_code', 'sender', 'type', 'alias'];

    public static function SecureCreate(array $params, String $token_10, String $token_16)
    {
        $encryptor = new MessageEncryption($token_10, $token_16);
        $message = Message::create([
            'chipertext'    => $encryptor->encrypt($params['message']),
            'room_code'     => $params['room_code'],
            'customer_code' => $params['customer_code'],
            'cs_code'       => $params['cs_code'],
            'sender'        => $params['sender'],
            'type'        => $params['type'],
            'alias'        => $params['alias']
        ]);
        return $message;
    }

    public static function SecureRead($token_10, $token_16, $chipertext)
    {
        $encryptor = new MessageEncryption($token_10, $token_16);
        return $encryptor->decrypt($chipertext);
    }
}
