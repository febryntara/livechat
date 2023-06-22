<div class='chat__box__text-box flex items-end float-right mb-4'>
    {{-- <div class='hidden sm:block dropdown mr-3 my-auto'>
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
    <div class='bg-primary px-4 py-3 text-white rounded-l-md rounded-t-md'>
        {!! nl2br(e($message)) !!}
        <div class='mt-1 text-xs text-white text-opacity-80'>{{ $time }}</div>
    </div>
    <div class='w-10 h-10 hidden sm:block flex-none image-fit relative ml-5'>
        <img alt='Midone - HTML Admin Template' class='rounded-full' src='{{ asset('dist/images/profile-2.jpg') }}'>
    </div>
</div>
