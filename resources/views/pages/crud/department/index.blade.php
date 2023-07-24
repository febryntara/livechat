@extends('layouts.admin')

@section('body')
    <h2 class="intro-y text-lg font-medium mt-10">
        Data Department
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('department.create') }}" class="btn btn-primary shadow-md mr-2">Tambah Department Baru</a>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">NO</th>
                        <th class="whitespace-nowrap">NAMA DEPARTMENT</th>
                        <th class="text-center whitespace-nowrap">LOKASI</th>
                        <th class="text-center whitespace-nowrap">STATUS</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($departments as $department)
                        <tr class="intro-x">
                            <td class="w-40">
                                {{ $number++ }}
                            </td>
                            <td>
                                <a href="{{ route('department.detail', ['department' => $department]) }}"
                                    class="font-medium whitespace-nowrap">{{ $department->name }}</a>
                                {{-- <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">PC &amp; Laptop</div> --}}
                            </td>
                            <td class="text-center">{{ $department->location }}</td>
                            <td class="w-40">
                                <div
                                    class="flex items-center justify-center {{ $department->status == 'unavaillable' ? 'text-danger' : null }}">
                                    {{ $department->status == 'unavaillable' ? 'Layanan Non Aktif' : 'Layanan Aktif' }}
                                </div>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3"
                                        href="{{ route('department.update', ['department' => $department]) }}"> <i
                                            data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-danger" href="javascript:;"
                                        onclick="openDeleteDialog({{ $department }})" data-tw-toggle="modal"
                                        data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2"
                                            class="w-4 h-4 mr-1"></i> Delete </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="5">Tidak Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        {{ $departments->links() }}
        <!-- END: Pagination -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <form id="delete-confirmation-modal" method="post" class="modal" tabindex="-1" aria-hidden="true">
        @csrf
        @method('DELETE')
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">
                            Do you really want to delete <span id="delete-confirmation-dynamic-text"></span>
                            <br>
                            This process cannot be undone.
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal"
                            class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <button type="submit" class="btn btn-danger w-24 text-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- END: Delete Confirmation Modal -->
@endsection

@section('script')
    <script>
        function openDeleteDialog(data) {
            $('#delete-confirmation-dynamic-text').html(data.name)
            $('#delete-confirmation-modal').attr('action', "/department/" + data.code + "/hapus")
        }
    </script>
@endsection
