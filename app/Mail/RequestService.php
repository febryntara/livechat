<?php

namespace App\Mail;

use App\Models\Customer;
use App\Models\RoomChat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Str;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestService extends Mailable
{
    use Queueable, SerializesModels;
    public $name, $nim, $jurusan, $room;
    /**
     * Create a new message instance.
     */
    public function __construct(Customer $customer)
    {
        $this->name = $customer->name;
        $this->nim = $customer->nim;
        $this->jurusan = $customer->jurusan;
        $this->room = RoomChat::create([
            "customer_code" => $customer->code,
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Permintaan Layanan Live Chat',
            from: new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.request-service',
            with: [
                'name' => $this->name,
                'nim' => $this->nim,
                'jurusan' => $this->jurusan,
                'link' => $this->room->link . "?key=" . $this->room->key
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
