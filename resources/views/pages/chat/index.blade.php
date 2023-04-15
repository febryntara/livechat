@extends('layouts.admin')

@section('body')
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Chat Content -->
        <div class="intro-y col-span-12">
            <div class="chat__box box">
                <!-- BEGIN: Chat Active -->
                <div class="h-full flex flex-col">
                    <div class="flex flex-col sm:flex-row border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 flex-none image-fit relative">
                                <img alt="Midone - HTML Admin Template" class="rounded-full"
                                    src="{{ asset('dist/images/profile-2.jpg') }}">
                            </div>
                            <div class="ml-3 mr-auto">
                                <div class="font-medium text-base">{{ $iam->name }}</div>
                                <div class="text-slate-500 text-xs sm:text-sm">Hey, I am using chat <span
                                        class="mx-1">•</span> Online</div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-y-scroll scrollbar-hidden px-5 pt-5 flex-1" id="chat-area">
                    </div>
                    <div class="pt-4 pb-10 sm:py-4 flex items-center border-t border-slate-200/60 dark:border-darkmode-400">
                        <textarea id="chat-input"
                            class="chat__box__input form-control dark:bg-darkmode-600 h-16 resize-none border-transparent px-5 py-3 shadow-none focus:border-transparent focus:ring-0"
                            rows="1" placeholder="Type your message..."></textarea>
                        <a href="javascript:;" onclick="sendMessage('{{ $iam->code }}', '{{ $he->code }}')"
                            class="w-8 h-8 sm:w-10 sm:h-10 bg-primary text-white rounded-full flex-none flex items-center justify-center mr-5">
                            <i data-lucide="send" class="w-4 h-4"></i> </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Chat Content -->
    </div>
@endsection


@section('script')
    <script>
        window.Echo.channel("messages.{{ $room->code }}").listen("MessageCreated", (event) => {
            ajaxWrapper('/api/get-message', 'post', event, function(result) {
                    let parsedResult = JSON.parse(result);
                    console.log(parsedResult);
                    $('#chat-area').append(parsedResult.data.role_identity == "{{ $iam->code }}" ?
                        parsedResult.view['sender'] : parsedResult.view['receiver'])
                    $('#chat-area').append(`<div class="clear-both"></div>`);
                },
                function() {},
                function(error) {
                    console.log(error);
                })

        });

        function sendMessage(senderId, receiverId) {
            const xhr = new XMLHttpRequest();
            const url = '/api/send-message';

            const data = new FormData();
            data.append('sender', senderId);
            data.append('receiver', receiverId);
            data.append('message', $('#chat-input').val());
            data.append('room_code', '{{ $room->code }}');
            data.append('role_identity', "{{ $iam->code }}");

            xhr.open('POST', url, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    console.log(response);
                } else {
                    console.log('An error occurred');
                }
            };
            xhr.send(data);
        }

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
