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
                                <div class="font-medium text-base">{{ $he->name }}</div>
                                <div class="text-slate-500 text-xs sm:text-sm">Hey, I am using chat <span
                                        class="mx-1">•</span> Online</div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-y-scroll scrollbar-hidden px-5 pt-5 flex-1" id="chat-area">
                        @forelse ($messages as $message)
                            {!! $message->view !!}
                            <div class="clear-both"></div>
                        @empty
                        @endforelse
                    </div>
                    <div class="pt-4 pb-10 sm:py-4 flex items-center border-t border-slate-200/60 dark:border-darkmode-400">
                        <textarea id="chat-input"
                            class="chat__box__input form-control dark:bg-darkmode-600 h-16 resize-none border-transparent px-5 py-3 shadow-none focus:border-transparent focus:ring-0"
                            rows="1" placeholder="Type your message..."></textarea>
                        <a href="javascript:;"
                            onclick="sendMessage('{{ $room->customer->code }}', '{{ $room->department->code }}')"
                            class="w-8 h-8 sm:w-10 sm:h-10 bg-primary text-white rounded-full flex-none flex items-center justify-center mr-5">
                            <i data-lucide="send" class="w-4 h-4"></i> </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Chat Content -->
    </div>
@endsection

@section('sencondary_body')
    <div class="mt-5">
        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#button-modal-preview"
            class="btn btn-primary w-max">Akhiri Sesi</a>
    </div>
    <div id="button-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"> <a data-tw-dismiss="modal" href="javascript:;"> <i data-lucide="x"
                        class="w-8 h-8 text-slate-400"></i> </a>
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <div class="text-3xl mt-5">Yakin Ingin Mengakhiri Sesi?</div>
                        <div class="text-slate-500 mt-2">Berikan Rating</div>
                    </div>
                    <div class="rating flex items-center">
                        <input type="radio" name="rating" id="star1" value="1" class="hidden" />
                        <label for="star1" class="flex items-center cursor-pointer mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M18.707 7.293a1 1 0 00-1.414 0l-3.292 3.292-3.293-3.292a1 1 0 00-1.414 1.414l3.292 3.293-3.292 3.292a1 1 0 001.414 1.414l3.293-3.292 3.292 3.292a1 1 0 001.414-1.414l-3.292-3.293 3.292-3.292a1 1 0 000-1.414z" />
                            </svg>
                        </label>
                        <input type="radio" name="rating" id="star2" value="2" class="hidden" />
                        <label for="star2" class="flex items-center cursor-pointer mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M18.707 7.293a1 1 0 00-1.414 0l-3.292 3.292-3.293-3.292a1 1 0 00-1.414 1.414l3.292 3.293-3.292 3.292a1 1 0 001.414 1.414l3.293-3.292 3.292 3.292a1 1 0 001.414-1.414l-3.292-3.293 3.292-3.292a1 1 0 000-1.414z" />
                            </svg>
                        </label>
                        <input type="radio" name="rating" id="star3" value="3" class="hidden" />
                        <label for="star3" class="flex items-center cursor-pointer mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M18.707 7.293a1 1 0 00-1.414 0l-3.292 3.292-3.293-3.292a1 1 0 00-1.414 1.414l3.292 3.293-3.292 3.292a1 1 0 001.414 1.414l3.293-3.292 3.292 3.292a1 1 0 001.414-1.414l-3.292-3.293 3.292-3.292a1 1 0 000-1.414z" />
                            </svg>
                        </label>
                        <input type="radio" name="rating" id="star4" value="4" class="hidden" />
                        <label for="star4" class="flex items-center cursor-pointer mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M18.707 7.293a1 1 0 00-1.414 0l-3.292 3.292-3.293-3.292a1 1 0 00-1.414 1.414l3.292 3.293-3.292 3.292a1 1 0 001.414 1.414l3.293-3.292 3.292 3.292a1 1 0 001.414-1.414l-3.292-3.293 3.292-3.292a1 1 0 000-1.414z" />
                            </svg>
                        </label>
                        <input type="radio" name="rating" id="star5" value="5" class="hidden" />
                        <label for="star5" class="flex items-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M18.707 7.293a1 1 0 00-1.414 0l-3.292 3.292-3.293-3.292a1 1 0 00-1.414 1.414l3.292 3.293-3.292 3.292a1 1 0 001.414 1.414l3.293-3.292 3.292 3.292a1 1 0 001.414-1.414l-3.292-3.293 3.292-3.292a1 1 0 000-1.414z" />
                            </svg>
                        </label>
                    </div>
                    <div class="px-5 pb-8 text-center"> <button type="button" data-tw-dismiss="modal"
                            class="btn btn-primary w-24">Ok</button> </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        window.Echo.channel("messages.{{ $room->code }}").listen("MessageCreated", (event) => {
            ajaxWrapper('/api/get-message', 'post', event, function(result) {
                    let parsedResult = JSON.parse(result);
                    console.log(parsedResult);
                    $('#chat-area').append(parsedResult.data.sender == "{{ $iam->code }}" ?
                        parsedResult.view['sender'] : parsedResult.view['receiver'])
                    $('#chat-area').append(`<div class="clear-both"></div>`);
                },
                function() {},
                function(error) {
                    console.log(error);
                })

        });

        function sendMessage(customer_code, cs_code) {
            const xhr = new XMLHttpRequest();
            const url = '/api/send-message';

            const data = new FormData();
            data.append('customer_code', customer_code);
            data.append('cs_code', cs_code);
            data.append('message', $('#chat-input').val());
            data.append('room_code', '{{ $room->code }}');
            data.append('sender', "{{ $iam->code }}");

            xhr.open('POST', url, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    console.log("Message Sent");
                    $('#chat-input').val("")
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
