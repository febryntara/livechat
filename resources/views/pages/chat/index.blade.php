@extends('layouts.admin')

@section('body')
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Chat Content -->
        <div class="intro-y col-span-12">
            <div class="chat__box box h-screen flex flex-col">
                <!-- Tambahkan kelas "h-screen" di sini -->
                <!-- BEGIN: Chat Active -->
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
                <div class="overflow-y-scroll scrollbar-hidden px-5 pt-5 flex-1" id="chat-area"
                    style="max-height: calc(100vh - 300px);">
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
        <!-- END: Chat Content -->
    </div>
@endsection

@section('sencondary_body')
    @cannot('chat-access')
        <div class="mt-5">
            <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#button-modal-preview"
                class="btn btn-primary w-max">Akhiri Sesi</a>
        </div>
    @endcannot
    <div id="button-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"> <a data-tw-dismiss="modal" href="javascript:;"> <i data-lucide="x"
                        class="w-8 h-8 text-slate-400"></i> </a>
                <form class="modal-body p-0" method="POST" action="{{ route('chat.end', ['room' => $room]) }}">
                    @csrf
                    <div class="p-5 text-center">
                        <div class="text-3xl mt-5">Yakin Ingin Mengakhiri Sesi?</div>
                        <div class="text-slate-500 mt-2">Berikan Rating</div>
                    </div>

                    <div class="flex items-center w-max mx-auto">
                        <svg aria-hidden="true" class="w-10 h-10 text-gray-300 star" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>First star</title>
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <svg aria-hidden="true" class="w-10 h-10 text-gray-300 star" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>Second star</title>
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <svg aria-hidden="true" class="w-10 h-10 text-gray-300 star" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>Third star</title>
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <svg aria-hidden="true" class="w-10 h-10 text-gray-300 star" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>Fourth star</title>
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <svg aria-hidden="true" class="w-10 h-10 text-gray-300 star" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>Fifth star</title>
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                    </div>
                    <input type="hidden" name="star_value" id="star-value">
                    <input type="hidden" name="ending_token" value="{{ $room->key }}">
                    <div class="mt-5 px-5 pb-8 text-center"> <button type="submit" data-tw-dismiss="modal"
                            class="btn btn-primary text-primary w-max">Akhiri Layanan</button> </div>
                </form>
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
                    scrollToBottom();
                },
                function() {},
                function(error) {
                    console.log(error);
                })

        });

        const stars = document.querySelectorAll('.star');

        stars.forEach((star, index) => {

            star.addEventListener('click', () => {
                $('#star-value').val(index + 1)
                for (let i = 0; i <= index; i++) {
                    stars[i].classList.remove('text-gray-300');
                    stars[i].classList.add('text-yellow-400');
                }
                for (let i = index + 1; i < stars.length; i++) {
                    stars[i].classList.remove('text-yellow-400');
                    stars[i].classList.add('text-gray-300');
                }
            });
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

        var textarea = document.getElementById("chat-input");
        textarea.addEventListener("keydown", function(event) {
            if (event.keyCode === 13 && !event.shiftKey) {
                event.preventDefault();
                sendMessage('{{ $room->customer->code }}', '{{ $room->department->code }}')
            } else if (event.keyCode === 13 && event.shiftKey) {
                // Insert new line
                var start = this.selectionStart;
                var end = this.selectionEnd;
                var value = this.value;
                this.value = value.substring(0, start) + "\n" + value.substring(end);
                this.selectionStart = this.selectionEnd = start + 1;
                event.preventDefault();
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

        function scrollToBottom() {
            var chatArea = document.getElementById('chat-area');
            chatArea.scrollTop = chatArea.scrollHeight;
        }
    </script>
@endsection
