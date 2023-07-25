@extends('layouts.admin')
@section('body')
    <form action="{{ route('cs.store') }}" method="POST" class="intro-y box p-5 mt-3">
        @method('POST')
        @csrf
        <div>
            <label for="crud-form-1" class="form-label flex justify-between">
                <span>CS Name</span>
                @error('name')
                    <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
            </label>
            <input id="crud-form-1" type="text" name="name" value="{{ old('name') }}" class="form-control w-full"
                placeholder="Masukan Nama">
        </div>
        <div class="mt-3">
            <label for="crud-form-2-tomselected" class="form-label flex justify-between">
                <span>Department</span>
                @error('department_id')
                    <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
            </label>
            <select data-placeholder="Pilih Department" name="department_id" class="tom-select w-full tomselected"
                id="crud-form-2" tabindex="-1" hidden="hidden">
                @forelse ($departments as $item)
                    <option value="{{ $item->id }}" {{ old('department_id') == $item->id ? 'selected' : null }}>
                        {{ $item->name }}</option>
                @empty
                    <option value="">Tambahkan Data Department terlebih dahulu!</option>
                @endforelse
            </select>
        </div>
        <div class="mt-3">
            <label for="crud-form-3" class="form-label flex justify-between">
                <span>Email</span>
                @error('email')
                    <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
            </label>
            <div class="input-group">
                <input id="crud-form-3" type="email" name="email" value="{{ old('email') }}" class="form-control"
                    placeholder="Masukan Email" aria-describedby="input-group-1">
            </div>
        </div>
        <div class="mt-3">
            <label for="crud-form-4" class="form-label flex justify-between">
                <span>Password</span>
                @error('password')
                    <span class="text-danger text-sm">{{ $message }}</span>
                @enderror
            </label>
            <div class="input-group">
                <input id="crud-form-4" type="password" name="password" class="form-control" placeholder="Masukan Password"
                    aria-describedby="input-group-2">
            </div>
        </div>
        <div class="text-right mt-5">
            <button type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
            <button type="submit" class="btn btn-primary text-primary w-24">Save</button>
        </div>
    </form>
@endsection
