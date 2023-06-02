@extends('layouts.admin')
@section('body')
    <div class="flex" id="chat-list">
        @foreach ($rooms as $item)
            <a href="" class="mt-3 mx-2 block btn btn-primary shadow-md w-max"
                data-customer-code="{{ $item->customer->code }}">
                <div>{{ $item->customer->name }}</div>
                <hr class="border border-white">
                <div class="text-xs">{{ $item->created_at->diffForHumans() }}</div>
            </a>
        @endforeach
    </div>
@endsection
