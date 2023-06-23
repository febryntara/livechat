@extends('layouts.admin')
@section('body')
    <div class="intro-y box p-5 mt-3">
        <div>
            <label for="crud-form-1" class="form-label">Nama</label>
            <input id="crud-form-1" type="text" readonly name="name" class="form-control w-full" placeholder="Masukan Nama"
                value="{{ $customer->name }}">
        </div>
        <div class="mt-3">
            <label for="crud-form-1" class="form-label">Jurusan</label>
            <input id="crud-form-1" type="text" readonly name="name" class="form-control w-full"
                placeholder="Masukan Nama" value="{{ $customer->jurusan }}">
        </div>
        <div class="mt-3">
            <label for="crud-form-3" class="form-label">Email</label>
            <div class="input-group">
                <input id="crud-form-3" type="email" readonly name="email" class="form-control"
                    placeholder="Masukan Email" aria-describedby="input-group-1" value="{{ $customer->email }}">
            </div>
        </div>
        @if ($customer->jurusan != 'umum')
            <div class="mt-3">
                <label for="crud-form-3" class="form-label">Nim</label>
                <div class="input-group">
                    <input id="crud-form-3" type="text" readonly class="form-control" placeholder="Masukan text"
                        aria-describedby="input-group-1" value="{{ $customer->nim }}">
                </div>
            </div>
        @endif
        <div class="mt-3">
            <label for="crud-form-3" class="form-label">Jumlah Penggunaan Layanan</label>
            <div class="input-group">
                <input id="crud-form-3" type="text" readonly class="form-control" placeholder="Masukan text"
                    aria-describedby="input-group-1" value="{{ $customer->visit }} Kali">
            </div>
        </div>
        <div class="mt-3">
            <label for="crud-form-3" class="form-label">Penggunaan Layanan Terakhir</label>
            <div class="input-group">
                <input id="crud-form-3" type="text" readonly class="form-control" placeholder="Masukan text"
                    aria-describedby="input-group-1" value="{{ $customer->last_visited->diffForHumans() }}">
            </div>
        </div>
        <div class="mt-3">
            <label for="crud-form-3" class="form-label">Indeks Kepuasan</label>
            <div class="input-group">
                <input id="crud-form-3" type="text" readonly class="form-control" placeholder="Masukan text"
                    aria-describedby="input-group-1" value="{{ $customer->avg_rating }}  dari 5 bintang">
            </div>
        </div>
    </div>
@endsection
