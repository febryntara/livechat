<div class='chat__box__text-box flex items-end float-left mb-4'>
    <div class='w-10 h-10 hidden sm:block flex-none image-fit relative mr-5'>
        <img alt='Midone - HTML Admin Template' class='rounded-full' src='{{ asset('dist/images/profile-2.jpg') }}'>
    </div>
    <div class='bg-slate-100 dark:bg-darkmode-400 px-4 py-3 text-slate-500 rounded-r-md rounded-t-md'>
        @if ($type != 'text')
            @if ($type == 'file')
                <a class="flex gap-1" href="{{ asset('storage/' . $message) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-paperclip">
                        <path
                            d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48" />
                    </svg>
                    <p>{{ $alias ?? 'FILE' }}</p>
                </a>
            @else
                <img src="{{ asset('storage/' . $message) }}" alt="{{ $message }}" class="cursor-pointer">
            @endif
        @else
            {!! nl2br(e($message)) !!}
        @endif
        <div class='mt-1 text-xs text-slate-500'>{{ $time }}</div>
    </div>
    {{-- <div class='hidden sm:block dropdown ml-3 my-auto'>
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
    </div> --}}
</div>
