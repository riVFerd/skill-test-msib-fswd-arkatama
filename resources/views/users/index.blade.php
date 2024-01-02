@extends('layouts.app')

@section('styles')
    <style>
        table, th, td {
            border: 1px solid black;
            padding: 0.5rem
        }
    </style>
@endsection

@section('content')
    <main class="w-full flex flex-col justify-center items-center gap-4">
        <h1 class="text-3xl">List User</h1>
        <table class="table-auto text-left">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Usia</th>
                    <th>Kota</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['age'] }}</td>
                        <td>{{ $user['city'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="/users" method="post" class="flex flex-col items-center gap-4">
            @csrf
            <label>
                <span class="text-2xl">Input data diri: </span>
                <input type="text" name="input" class="px-4 py-2 rounded-xl min-w-[20vw]" placeholder="NAMA[spasi]USIA[spasi]KOTA" required>
            </label>
            <button type="submit" class="px-4 py-2 rounded-xl bg-blue-500 text-white">Submit</button>
        </form>
    </main>
@endsection
