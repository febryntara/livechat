@extends('layouts.admin')
@section('body')
    {{-- <div class="flex" id="chat-stack"> --}}
    <div class="grid grid-cols-12 gap-6 mt-5" id="chat-stack">
        <!-- BEGIN: Users Layout -->
        @foreach ($rooms as $item)
            <div class="intro-y col-span-12 md:col-span-6" data-customer-code="{{ $item->customer->code }}">
                <div class="box">
                    <div
                        class="flex flex-col lg:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                            <img alt="PNB Live Chat Base Image" class="rounded-full"
                                src="{{ asset('dist/images/profile-5.jpg') }}">
                        </div>
                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                            <a href="" class="font-medium">{{ $item->customer->name }}</a>
                            <div class="text-slate-500 text-xs mt-0.5">{{ $item->customer->jurusan }}</div>
                        </div>
                    </div>
                    <div class="flex flex-wrap lg:flex-nowrap items-center justify-center p-5">
                        <div class="w-full lg:w-1/2 mb-4 lg:mb-0 mr-auto">
                            <div class="flex text-slate-500 text-xs">
                                <div class="mr-auto">Time</div>
                                <div>{{ $item->created_at->format('H:i') }}</div>
                            </div>
                        </div>
                        <a href="{{ route('chat.open', ['room' => $item]) }}"
                            data-customer-code="{{ $item->customer->code }}"
                            class="btn btn-primary py-1 px-2 mr-2">Message</a>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- END: Users Layout -->
    </div>
    </div>
@endsection
@section('script')
    <script>
        window.Echo.channel("{{ $department->code }}").listen("RoomAppear", (event) => {
            // room_code = event.room.code;
            if ($(`#room-${event.room.code}`).length == 0) {
                let date = new Date(event.room.created_at);
                let options = {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    timeZone: 'Asia/Makassar'
                };
                $(`[data-customer-code="${event.customer.code}"]`).each(function() {
                    $(this).remove();
                });
                $('#chat-stack').append(`
                  <div class="intro-y col-span-12 md:col-span-6" data-customer-code="${event.customer.code}">
                    <div class="box">
                        <div
                            class="flex flex-col lg:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                                <img alt="PNB Live Chat Base Image" class="rounded-full"
                                    src="/dist/images/profile-5.jpg">
                            </div>
                            <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                <a href="javascript:;" class="font-medium">${event.customer.name}</a>
                                <div class="text-slate-500 text-xs mt-0.5">${event.customer.jurusan}</div>
                            </div>
                        </div>
                        <div class="flex flex-wrap lg:flex-nowrap items-center justify-center p-5">
                            <div class="w-full lg:w-1/2 mb-4 lg:mb-0 mr-auto">
                                <div class="flex text-slate-500 text-xs">
                                    <div class="mr-auto">Time</div>
                                    <div>${getCurrentTime()}</div>
                                </div>
                            </div>
                            <a href="/chat/${event.room.code}"
                                class="btn btn-primary py-1 px-2 mr-2">Message</a>
                        </div>
                    </div>
                </div>
                `)
            }
        });
    </script>
@endsection
