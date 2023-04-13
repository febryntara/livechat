@extends('layouts.admin')

@section('body')
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Chat Content -->
        <div class="intro-y col-span-12">
            <div class="chat__box box">
                <!-- BEGIN: Chat Active -->
                <div class="hidden h-full flex flex-col">
                    <div class="flex flex-col sm:flex-row border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 flex-none image-fit relative">
                                <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/profile-2.jpg">
                            </div>
                            <div class="ml-3 mr-auto">
                                <div class="font-medium text-base">Kate Winslet</div>
                                <div class="text-slate-500 text-xs sm:text-sm">Hey, I am using chat <span
                                        class="mx-1">•</span> Online</div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-y-scroll scrollbar-hidden px-5 pt-5 flex-1" id="chat-area">
                        <div class="chat__box__text-box flex items-end float-right mb-4">
                            <div class="hidden sm:block dropdown mr-3 my-auto">
                                <a href="javascript:;" class="dropdown-toggle w-4 h-4 text-slate-500" aria-expanded="false"
                                    data-tw-toggle="dropdown"> <i data-lucide="more-vertical" class="w-4 h-4"></i> </a>
                                <div class="dropdown-menu w-40">
                                    <ul class="dropdown-content">
                                        <li>
                                            <a href="" class="dropdown-item"> <i data-lucide="corner-up-left"
                                                    class="w-4 h-4 mr-2"></i> Reply </a>
                                        </li>
                                        <li>
                                            <a href="" class="dropdown-item"> <i data-lucide="trash"
                                                    class="w-4 h-4 mr-2"></i> Delete </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="bg-primary px-4 py-3 text-white rounded-l-md rounded-t-md">
                                Lorem ipsum sit amen dolor, lorem ipsum sit amen dolor
                                <div class="mt-1 text-xs text-white text-opacity-80">1 mins ago</div>
                            </div>
                            <div class="w-10 h-10 hidden sm:block flex-none image-fit relative ml-5">
                                <img alt="Midone - HTML Admin Template" class="rounded-full"
                                    src="dist/images/profile-2.jpg">
                            </div>
                        </div>
                        <div class="clear-both"></div>
                        <div class="chat__box__text-box flex items-end float-left mb-4">
                            <div class="w-10 h-10 hidden sm:block flex-none image-fit relative mr-5">
                                <img alt="Midone - HTML Admin Template" class="rounded-full"
                                    src="dist/images/profile-2.jpg">
                            </div>
                            <div
                                class="bg-slate-100 dark:bg-darkmode-400 px-4 py-3 text-slate-500 rounded-r-md rounded-t-md">
                                lorem
                                <div class="mt-1 text-xs text-slate-500">2 mins ago</div>
                            </div>
                            <div class="hidden sm:block dropdown ml-3 my-auto">
                                <a href="javascript:;" class="dropdown-toggle w-4 h-4 text-slate-500" aria-expanded="false"
                                    data-tw-toggle="dropdown"> <i data-lucide="more-vertical" class="w-4 h-4"></i> </a>
                                <div class="dropdown-menu w-40">
                                    <ul class="dropdown-content">
                                        <li>
                                            <a href="" class="dropdown-item"> <i data-lucide="corner-up-left"
                                                    class="w-4 h-4 mr-2"></i>
                                                Reply </a>
                                        </li>
                                        <li>
                                            <a href="" class="dropdown-item"> <i data-lucide="trash"
                                                    class="w-4 h-4 mr-2"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="pt-4 pb-10 sm:py-4 flex items-center border-t border-slate-200/60 dark:border-darkmode-400">
                        <textarea id="chat-input"
                            class="chat__box__input form-control dark:bg-darkmode-600 h-16 resize-none border-transparent px-5 py-3 shadow-none focus:border-transparent focus:ring-0"
                            rows="1" placeholder="Type your message..."></textarea>
                        <a href="javascript:;" onclick="sendMessage(2015323078, 2015)"
                            class="w-8 h-8 sm:w-10 sm:h-10 block bg-primary text-white rounded-full flex-none flex items-center justify-center mr-5">
                            <i data-lucide="send" class="w-4 h-4"></i> </a>
                    </div>
                </div>
                <!-- END: Chat Active -->
                <!-- BEGIN: Chat Default -->
                <div class="h-full flex items-center">
                    <div class="mx-auto text-center">
                        <div class="w-16 h-16 flex-none image-fit rounded-full overflow-hidden mx-auto">
                            <img alt="Midone - HTML Admin Template" src="dist/images/profile-2.jpg">
                        </div>
                        <div class="mt-3">
                            <div class="font-medium">Hey, {{ $room->name }}</div>
                            <div class="text-slate-500 mt-1">Silahkan Pilih Departemen Untuk Memulai Percakapan.</div>
                        </div>
                    </div>
                </div>
                <!-- END: Chat Default -->
            </div>
        </div>
        <!-- END: Chat Content -->
    </div>
@endsection

@section('sencondary_body')
    <!-- BEGIN: Chat Side Menu -->
    <div class="col-span-12 mt-5">
        <div class="intro-y pr-1">
            <div class="box p-2">
                <ul class="nav nav-pills" role="tablist">
                    <li id="chats-tab" class="nav-item flex-1" role="presentation">
                        <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#chats"
                            type="button" role="tab" aria-controls="chats" aria-selected="true"> Chats
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div id="chats" class="tab-pane active" role="tabpanel" aria-labelledby="chats-tab">
                <div class="pr-1">
                    <div class="box px-5 pt-5 pb-5 lg:pb-0 mt-5">
                        <div class="relative text-slate-500">
                            <input type="text" class="form-control py-3 px-4 border-transparent bg-slate-100 pr-10"
                                placeholder="Search for messages or users...">
                            <i class="w-4 h-4 hidden sm:absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                        </div>
                        <div class="overflow-x-auto scrollbar-hidden">
                            <div class="flex mt-5">
                                @forelse ($departments as $department)
                                    <a href="" class="w-10 mr-4 cursor-pointer">
                                        <div class="w-10 h-10 flex-none image-fit rounded-full">
                                            <img alt="Midone - HTML Admin Template" class="rounded-full"
                                                src="dist/images/profile-2.jpg">
                                            <div
                                                class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600">
                                            </div>
                                        </div>
                                        <div class="text-xs text-slate-500 truncate text-center mt-2">
                                            {{ $department->name }}</div>
                                    </a>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat__chat-list overflow-y-auto scrollbar-hidden pr-1 pt-1 mt-4">
                    @forelse ($departments as $department)
                        <div class="intro-x cursor-pointer box relative flex items-center p-5 ">
                            <div class="w-12 h-12 flex-none image-fit mr-1">
                                <img alt="Midone - HTML Admin Template" class="rounded-full"
                                    src="dist/images/profile-2.jpg">
                                <div
                                    class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600">
                                </div>
                            </div>
                            <div class="ml-2 overflow-hidden">
                                <div class="flex items-center">
                                    <a href="javascript:;" class="font-medium">{{ $department->name }}</a>
                                    <div class="text-xs text-slate-400 ml-auto">05:09 AM</div>
                                </div>
                                <div class="w-full truncate text-slate-500 mt-0.5">{{ $department->location }}</div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
        </div>
    </div>
    <!-- END: Chat Side Menu -->
@endsection

@section('script')
    <script>
        window.Echo.channel("messages.{{ $room->code }}").listen("MessageCreated", (event) => {
            console.log(event);
            let receiver = `<div class='chat__box__text-box flex items-end float-left mb-4'>
    <div class='w-10 h-10 hidden sm:block flex-none image-fit relative mr-5'>
        <img alt='Midone - HTML Admin Template' class='rounded-full' src='dist/images/profile-2.jpg'>
    </div>
    <div class='bg-slate-100 dark:bg-darkmode-400 px-4 py-3 text-slate-500 rounded-r-md rounded-t-md'>${event.message}
        <div class='mt-1 text-xs text-slate-500'>2 mins ago</div>
    </div>
    <div class='hidden sm:block dropdown ml-3 my-auto'>
        <a href='javascript:;' class='dropdown-toggle w-4 h-4 text-slate-500' aria-expanded='false'
            data-tw-toggle='dropdown'> <i data-lucide='more-vertical' class='w-4 h-4'></i> </a>
        <div class='dropdown-menu w-40'>
            <ul class='dropdown-content'>
                <li>
                    <a href='' class='dropdown-item'> <i data-lucide='corner-up-left' class='w-4 h-4 mr-2'></i>
                        Reply </a>
                </li>
                <li>
                    <a href='' class='dropdown-item'> <i data-lucide='trash' class='w-4 h-4 mr-2'></i> Delete
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
`;

            let sender = `<div class='chat__box__text-box flex items-end float-right mb-4'>
    <div class='hidden sm:block dropdown mr-3 my-auto'>
        <a href='javascript:;' class='dropdown-toggle w-4 h-4 text-slate-500' aria-expanded='false'
            data-tw-toggle='dropdown'> <i data-lucide='more-vertical' class='w-4 h-4'></i> </a>
        <div class='dropdown-menu w-40'>
            <ul class='dropdown-content'>
                <li>
                    <a href='' class='dropdown-item'> <i data-lucide='corner-up-left' class='w-4 h-4 mr-2'></i>
                        Reply </a>
                </li>
                <li>
                    <a href='' class='dropdown-item'> <i data-lucide='trash' class='w-4 h-4 mr-2'></i> Delete
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class='bg-primary px-4 py-3 text-white rounded-l-md rounded-t-md'>
        ${event.message}
        <div class='mt-1 text-xs text-white text-opacity-80'>1 mins ago</div>
    </div>
    <div class='w-10 h-10 hidden sm:block flex-none image-fit relative ml-5'>
        <img alt='Midone - HTML Admin Template' class='rounded-full' src='dist/images/profile-2.jpg'>
    </div>
</div>
`;
            ajaxWrapper('/api/get-message', 'post', event, function(result) {
                    console.log(result);
                    $('#chat-area').append(sender)
                    $('#chat-area').append(`<div class="clear-both"></div>`);
                },
                function() {},
                function(error) {
                    console.log(error);
                })

        });

        // function sendMessage(sender, receiver) {
        //     $.ajax({
        //         type: 'POST',
        //         url: '/api/send-message',
        //         data: {
        //             message: $('#chat-input').val(),
        //             sender: sender,
        //             receiver: receiver,
        //             room: '{{ $room->code }}'
        //         },
        //         beforeSend: function(data) {

        //         },
        //         success: function(result) {

        //         }
        //     })
        // }

        function sendMessage(senderId, receiverId) {
            const xhr = new XMLHttpRequest();
            const url = '/api/send-message';

            const data = new FormData();
            data.append('sender', senderId);
            data.append('receiver', receiverId);
            data.append('message', $('#chat-input').val());
            data.append('room_code', '{{ $room->code }}');

            xhr.open('POST', url, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    console.log(response.message);
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
                xhr.beforeSend = beforeSendCallback;
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
