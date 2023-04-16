@extends('layouts.admin')
@section('body')
    <div class="flex" id="chat-stack">
        @foreach ($rooms as $item)
            <a href="{{ route('chat.open', ['room' => $item]) }}" class="mt-3 mx-2 btn btn-primary shadow-md w-max">
                {{ $item->customer->name }} </a>
        @endforeach
    </div>
@endsection
@section('script')
    <script>
        window.Echo.channel("{{ $department->code }}").listen("RoomAppear", (event) => {
            // room_code = event.room.code;
            if ($(`#room-${event.room.code}`).length == 0) {
                $('#chat-stack').append(`
                        <a href="/chat/${event.room.code}" class="mt-3 mx-2 btn btn-primary shadow-md w-max" id="room-${event.room.code}">
                ${event.customer.name} </a>
                    `)
            }
        });

        function ajaxWrapper(url, method, data, successCallback, beforeSendCallback, errorCallback) {
            // Inisialisasi objek XMLHttpRequest
            var xhr = new XMLHttpRequest();

            // Atur callback untuk menerima respon dari server
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        successCallback(xhr.responseText);
                    } else {
                        errorCallback(xhr.statusText);
                    }
                }
            };

            // Buat request dengan method yang ditentukan
            xhr.open(method, url, true);

            // Set header untuk request
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');

            // Jalankan fungsi beforeSendCallback
            if (beforeSendCallback) {
                xhr.beforeSend = beforeSendCallback();
            }

            // Kirim data dengan method POST
            if (method.toLowerCase() === 'post') {
                xhr.send(JSON.stringify(data));
            } else {
                xhr.send();
            }
        }
    </script>
@endsection
