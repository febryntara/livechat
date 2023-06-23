<div class='chat__box__text-box flex items-end float-right mb-4'>
    <div class='bg-primary px-4 py-3 text-white rounded-l-md rounded-t-md'>
        @if ($type != 'text')
            @if ($type == 'file')
                <a class="flex gap-1" href="{{ asset('storage/' . $message) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-paperclip">
                        <path
                            d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l8.57-8.57A4 4 0 1 1 18 8.84l-8.59 8.57a2 2 0 0 1-2.83-2.83l8.49-8.48" />
                    </svg>
                    <p>{{ $alias ?? 'FILE' }}</p>
                </a>
            @else
                <img src="{{ asset('storage/' . $message) }}" alt="{{ $message }}" class="cursor-pointer"
                    data-action="zoom">
            @endif
        @else
            {!! nl2br(e($message)) !!}
        @endif
        <div class='mt-1 text-xs text-white text-opacity-80'>{{ $time }}</div>
    </div>
    <div class='w-10 h-10 hidden sm:block flex-none image-fit relative ml-5'>
        <img alt='Midone - HTML Admin Template' class='rounded-full' src='{{ asset('dist/images/profile-2.jpg') }}'>
    </div>
</div>
