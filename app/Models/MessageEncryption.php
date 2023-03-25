<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageEncryption extends Model
{
    private $key;
    private $iv;

    public function __construct($key, $iv)
    {
        $this->key = $key;
        $this->iv = $iv;
    }

    public function encrypt($plaintext)
    {
        $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $this->key, OPENSSL_RAW_DATA, $this->iv);
        return base64_encode($ciphertext);
    }

    public function decrypt($ciphertext)
    {
        $ciphertext = base64_decode($ciphertext);
        $plaintext = openssl_decrypt($ciphertext, 'aes-256-cbc', $this->key, OPENSSL_RAW_DATA, $this->iv);
        return $plaintext;
    }

    public function howtouse()
    {
        $key = 'my_secret_key';
        $iv = 'my_secret_iv';

        $encryptor = new MessageEncryption($key, $iv);

        $plaintext = 'Ini adalah pesan rahasia';
        $ciphertext = $encryptor->encrypt($plaintext);

        echo "Pesan asli: $plaintext<br>";
        echo "Pesan terenkripsi: $ciphertext<br>";

        $decryptedText = $encryptor->decrypt($ciphertext);
        echo "Pesan terdekripsi: $decryptedText";
    }
}
