<div
    class="top-bar-boxed h-[70px] md:h-[65px] z-[51] border-b border-white/[0.08] mt-12 md:mt-0 -mx-3 sm:-mx-8 md:-mx-0 px-3 md:border-b-0 relative md:fixed md:inset-x-0 md:top-0 sm:px-8 md:px-10 md:pt-10 md:bg-gradient-to-b md:from-slate-100 md:to-transparent dark:md:from-darkmode-700">
    <div class="h-full flex items-center">
        <!-- BEGIN: Logo -->
        <a href="" class="logo -intro-x md:flex xl:w-[180px] block">
            <img alt="Midone - HTML Admin Template" class="logo__image w-6" src="{{ asset('dist/images/logo.svg') }}">
            <span class="logo__text text-white text-lg ml-3"> PNB Live Chat </span>
        </a>
        <!-- END: Logo -->
        <!-- BEGIN: Breadcrumb -->
        <nav aria-label="breadcrumb" class="-intro-x h-[45px] mr-auto">
            <ol class="breadcrumb breadcrumb-light">
                @forelse (parse_url_components(Request::url())['path_sliced'] as $item)
                    <li class="breadcrumb-item {{ $loop->last ? 'active' : null }}">
                        <span>{{ $item == '' ? 'Dashboard' : $item }}</span>
                    </li>
                @empty
                    <li class="breadcrumb-item"><span>Where Am I?</span></li>
                @endforelse
            </ol>
        </nav>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Search -->
        @if ($use_search ?? false)
            <form class="intro-x relative mr-3 sm:mr-6">
                <div class="search hidden sm:block">
                    <input type="text" name="keyword" class="search__input form-control border-transparent"
                        placeholder="Search...">
                    <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
                </div>
                <button type="submit" class="notification notification--light sm:hidden"> <i data-lucide="search"
                        class="notification__icon dark:text-slate-500"></i> </button>
            </form>
        @endif
        <!-- END: Search -->
        <!-- BEGIN: Account Menu -->
        <div class="intro-x dropdown w-8 h-8">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110"
                role="button" aria-expanded="false" data-tw-toggle="dropdown">
                <img alt="Midone - HTML Admin Template" src="{{ asset('dist/images/profile-5.jpg') }}">
            </div>
            <div class="dropdown-menu w-56">
                <ul
                    class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                    <li class="p-2">
                        <div class="font-medium">{{ auth()->check() ? auth()->user()->name : $iam->name }}</div>
                        <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">
                            {{ auth()->check() ? auth()->user()->role : $iam->jurusan }}</div>
                    </li>
                    <li>
                        <hr class="dropdown-divider border-white/[0.08]">
                    </li>
                    {{-- <li>
                        <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="user"
                                class="w-4 h-4 mr-2"></i> Profile </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="edit"
                                class="w-4 h-4 mr-2"></i> Add Account </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="lock"
                                class="w-4 h-4 mr-2"></i> Reset Password </a>
                    </li>
                    <li>
                        <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="help-circle"
                                class="w-4 h-4 mr-2"></i> Help </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider border-white/[0.08]">
                    </li> --}}
                    <li>
                        @if (auth()->check())
                            <a href="{{ route('auth.signout') }}" class="dropdown-item hover:bg-white/5"> <i
                                    data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                        @else
                            <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#button-modal-preview"
                                class="dropdown-item hover:bg-white/5"> <i data-lucide="toggle-right"
                                    class="w-4 h-4 mr-2"></i> Akhiri Sesi </a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <!-- END: Account Menu -->
    </div>
</div>
