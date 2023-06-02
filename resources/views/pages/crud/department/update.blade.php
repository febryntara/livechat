@extends('layouts.admin')
@section('body')
    <!-- BEGIN: Post Content -->
    <form action="{{ route('department.patch', ['department' => $department]) }}" method="POST"
        class="intro-y col-span-12 lg:col-span-8">
        @csrf
        @method('PATCH')
        <input type="text" class="intro-y form-control py-3 px-4 box pr-10 mt-3" name="name"
            value="{{ $department->name }}" placeholder="Nama Department">
        <div class="post intro-y overflow-hidden box mt-5">
            <div class="post__content tab-content">
                <div id="content" class="tab-pane p-5 active" role="tabpanel" aria-labelledby="content-tab">
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <div
                            class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                            <i data-lucide="chevron-down" class="w-4 h-4 mr-2"></i> Lokasi
                        </div>
                        <div class="mt-5">
                            <div>
                                <label for="post-form-7" class="form-label">Nama Gedung</label>
                                <input id="post-form-7" type="text" name="location" class="form-control"
                                    placeholder="Misal: Gedung EA" value="{{ $department->location }}">
                            </div>
                        </div>
                    </div>
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5 mt-3">
                        <div
                            class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                            <i data-lucide="chevron-down" class="w-4 h-4 mr-2"></i> Layanan
                        </div>
                        <div class="mt-5">
                            <div>
                                <label for="post-form-7" class="form-label">Status</label>
                                <select class="form-select form-select-sm mt-2" name="status"
                                    aria-label=".form-select-sm example">
                                    <option value="availlable"
                                        {{ $department->status == 'availlable' ? 'selected' : null }}>Menerima Layanan
                                    </option>
                                    <option value="unavaillable"
                                        {{ $department->status == 'unavaillable' ? 'selected' : null }}>Tidak Menerima
                                        Layanan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="mt-3 ml-auto btn btn-primary shadow-md flex items-center"> Simpan </button>
                </div>
            </div>
        </div>
    </form>
    <!-- END: Post Content -->
@endsection
@section('sencondary_body')
@endsection
