@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-900">Daftar Tugas / Proyek</h1>
    <a href="{{ route('task_lists.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Bikin Daftar Baru
    </a>
</div>

<div class="bg-white shadow overflow-hidden sm:rounded-md">
    <ul class="divide-y divide-gray-200">
        @forelse ($taskLists as $list)
        <li>
            <div class="px-4 py-4 flex items-center justify-between sm:px-6">
                <div class="flex-1 min-w-0">
                    <a href="{{ route('task_lists.show', $list) }}" class="text-lg font-medium text-blue-600 hover:text-blue-800 truncate">
                        {{ $list->name }}
                    </a>
                    <p class="text-sm text-gray-500">Dibuat {{ $list->created_at->diffForHumans() }}</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('task_lists.edit', $list) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    <form action="{{ route('task_lists.destroy', $list) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus daftar ini? Semua tugas di dalamnya juga akan dihapus.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                    </form>
                </div>
            </div>
        </li>
        @empty
        <li>
            <div class="px-4 py-8 text-center text-gray-500">
                Belum ada daftar tugas. Bikin satu untuk memulai!
            </div>
        </li>
        @endforelse
    </ul>
</div>
@endsection
