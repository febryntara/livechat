@extends('layouts.admin')

@section('body')
    <h2 class="intro-y text-lg font-medium mt-10">
        Data List Layout
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <button class="btn btn-primary shadow-md mr-2">Tambah CS Baru</button>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">NO</th>
                        <th class="whitespace-nowrap">NAMA CS</th>
                        <th class="text-center whitespace-nowrap">EMAIL</th>
                        <th class="text-center whitespace-nowrap">DEPARTMENT</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cs as $item)
                        <tr class="intro-x">
                            <td class="w-40">
                                {{ $number++ }}
                            </td>
                            <td>
                                <a href="{{ route('cs.detail', ['user' => $item]) }}"
                                    class="font-medium whitespace-nowrap">{{ $item->name }}</a>
                                {{-- <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">PC &amp; Laptop</div> --}}
                            </td>
                            <td class="text-center">{{ $item->email }}</td>
                            <td class="w-40">
                                <div class="flex items-center justify-center">
                                    {{ $item->department->name }}
                                </div>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ route('cs.update', ['user' => $item]) }}">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                    <a class="flex items-center text-danger" href="javascript:;"
                                        onclick="openDeleteDialog({{ $item }})" data-tw-toggle="modal"
                                        data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2"
                                            class="w-4 h-4 mr-1"></i> Delete </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        {{ $cs->links() }}
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
                        <button type="submit" class="btn btn-danger text-danger w-24">Delete</button>
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
            $('#delete-confirmation-modal').attr('action', "/cs/" + data.code + "/hapus")
        }
    </script>
@endsection
