<?php

namespace App\Mail;

use App\Models\RoomChat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestService extends Mailable
{
    use Queueable, SerializesModels;
    public $to, $name, $nim, $jurusan;
    /**
     * Create a new message instance.
     */
    public function __construct($to, $name, $nim, $jurusan)
    {
        $this->to = $to;
        $this->name = $name;
        $this->nim = $nim;
        $this->jurusan = $jurusan;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Permintaan Layanan Live Chat',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $room = RoomChat::create([
            "name" => $this->name,
        ]);
        return new Content(
            view: 'mail.request-service',
            with: [
                'to' => $this->to,
                'name' => $this->name,
                'nim' => $this->nim,
                'jurusan' => $this->jurusan,
                'link' => $room->link . "?key=" . $room->key
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
