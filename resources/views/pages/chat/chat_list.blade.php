@extends('layouts.admin')

@section('body')
    <h2 class="intro-y text-lg font-medium mt-10">
        Chat List Selesai
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">NO</th>
                        <th class="whitespace-nowrap">NAMA</th>
                        <th class="text-center whitespace-nowrap">KODE ROOM</th>
                        <th class="text-center whitespace-nowrap">RATING</th>
                        <th class="text-center whitespace-nowrap">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        <tr class="intro-x">
                            <td class="w-40">
                                {{ $number++ }}
                            </td>
                            <td>
                                <a href="javascript:;" class="font-medium whitespace-nowrap">{{ $room->customer->name }}</a>
                                {{-- <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">PC &amp; Laptop</div> --}}
                            </td>
                            <td class="text-center">{{ $room->code }}</td>
                            <td class="text-center flex justify-center">
                                @if (!is_null($room->rating))
                                    @for ($i = 1; $i <= $room->rating->stars; $i++)
                                        <svg aria-hidden="true" class="w-10 h-10 text-yellow-400 star" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <title>First star</title>
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                    @endfor
                                @else
                                    Tidak Ada Rating
                                @endif
                            </td>
                            <td class="w-40 text-center">
                                {{ $room->status }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        {{ $rooms->links() }}
        <!-- END: Pagination -->
    </div>
@endsection
