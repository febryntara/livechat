@extends('layouts.admin')
@section('body')
    <div class="intro-y box p-5 mt-3">
        <div>
            <label for="crud-form-1" class="form-label">CS Name</label>
            <input id="crud-form-1" type="text" readonly name="name" class="form-control w-full" placeholder="Masukan Nama"
                value="{{ $cs->name }}">
        </div>
        <div class="mt-3">
            <label for="crud-form-2-tomselected" class="form-label" id="crud-form-2-ts-label">Department</label>
            <select data-placeholder="Pilih Department" readonly name="department_id" class="tom-select w-full tomselected"
                id="crud-form-2" tabindex="-1" hidden="hidden">
                @forelse ($departments as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $cs->department_id ? 'selected' : null }}>
                        {{ $item->name }}</option>
                @empty
                    <option value="">Tambahkan Data Department terlebih dahulu!</option>
                @endforelse
            </select>
        </div>
        <div class="mt-3">
            <label for="crud-form-3" class="form-label">Email</label>
            <div class="input-group">
                <input id="crud-form-3" type="email" readonly name="email" class="form-control"
                    placeholder="Masukan Email" aria-describedby="input-group-1" value="{{ $cs->email }}">
            </div>
        </div>
        <div class="mt-3">
            <label for="crud-form-4" class="form-label">Password Baru</label>
            <div class="input-group">
                <input id="crud-form-4" type="password" readonly name="password" class="form-control"
                    placeholder="Kosongkan Jika Tidak Ingin Ganti" aria-describedby="input-group-2">
            </div>
        </div>
    </div>
@endsection
