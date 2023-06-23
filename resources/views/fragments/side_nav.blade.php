<nav class="side-nav">
    <ul>
        @can('both')
            <li class="">
                <a href="javascript:;" class="side-menu {{ active_checker('/', 'side-menu--active', '') }}">
                    <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                    <div class="side-menu__title">
                        Dashboard
                        <div class="side-menu__sub-icon transform rotate-180"> <i data-lucide="chevron-down"></i>
                        </div>
                    </div>
                </a>
                <ul class="{{ active_checker('', 'side-menu__sub-open', '') }}">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="side-menu {{ active_checker('/', 'side-menu--active', '') }}">
                            <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="side-menu__title"> Summary </div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('chat-access', auth()->user())
            <li>
                <a href="javascript:;" class="side-menu {{ active_checker('chat*', 'side-menu--active', '') }}">
                    <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                    <div class="side-menu__title">
                        Dialog Stack
                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                    </div>
                </a>
                <ul class="{{ active_checker('chat*', 'side-menu__sub-open', '') }}">
                    <li>
                        <a href="{{ route('chat.stack') }}"
                            class="side-menu {{ active_checker('chat/stack', 'side-menu--active', '') }}">
                            <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="side-menu__title"> Permintaan Chat </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('chat.active') }}"
                            class="side-menu {{ active_checker('chat/active', 'side-menu--active', '') }}">
                            <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="side-menu__title"> Chat Berlangsung </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('chat.ended') }}"
                            class="side-menu {{ active_checker('chat/ended', 'side-menu--active', '') }}">
                            <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="side-menu__title"> Chat selesai </div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        <li class="side-nav__devider my-6"></li>
        @can('crud-department', auth()->user())
            <li>
                <a href="javascript:;" class="side-menu {{ active_checker('department', 'side-menu--active', '') }}">
                    <div class="side-menu__icon"> <i data-lucide="shopping-bag"></i> </div>
                    <div class="side-menu__title">
                        Data Departemen
                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                    </div>
                </a>
                <ul class="{{ active_checker('department*', 'side-menu__sub-open', '') }}">
                    <li>
                        <a href="{{ route('department.all') }}"
                            class="side-menu {{ active_checker('department', 'side-menu--active', '') }}">
                            <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="side-menu__title"> Semua Departemen </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('department.create') }}"
                            class="side-menu {{ active_checker('department/tambah', 'side-menu--active', '') }}">
                            <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="side-menu__title"> Tambah Departemen </div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('crud-cs', auth()->user())
            <li>
                <a href="javascript:;" class="side-menu {{ active_checker('cs*', 'side-menu--active', '') }}">
                    <div class="side-menu__icon"> <i data-lucide="shopping-bag"></i> </div>
                    <div class="side-menu__title">
                        Data CS
                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                    </div>
                </a>
                <ul class="{{ active_checker('cs*', 'side-menu__sub-open', '') }}">
                    <li>
                        <a href="{{ route('cs.all') }}"
                            class="side-menu {{ active_checker('cs', 'side-menu--active', '') }}">
                            <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="side-menu__title"> Daftar CS </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cs.create') }}"
                            class="side-menu {{ active_checker('cs/tambah', 'side-menu--active', '') }}">
                            <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                            <div class="side-menu__title"> Tambah CS </div>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('both')
            <li>
                <a href="javascript:;" class="side-menu {{ active_checker('customer*', 'side-menu--active', '') }}">
                    <div class="side-menu__icon"> <i data-lucide="edit"></i> </div>
                    <div class="side-menu__title">
                        Data Mahasiswa
                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                    </div>
                </a>
                <ul class="{{ active_checker('customer*', 'side-menu__sub-open', '') }}">
                    @foreach (json_decode(env('APP_JURUSAN')) as $item)
                        <li>
                            <a href="{{ route('customer.index', ['jurusan' => $item->code]) }}"
                                class="side-menu {{ request()->jurusan == $item->code ? 'side-menu--active' : null }}">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> {{ $item->name }} </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endcan
    </ul>
</nav>
