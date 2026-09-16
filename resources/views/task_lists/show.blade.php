@extends('layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-900">{{ $taskList->name }}</h1>
    <a href="{{ route('task_lists.index') }}" class="text-blue-600 hover:text-blue-800">&larr; Kembali ke Daftar</a>
</div>

<div class="bg-white shadow sm:rounded-lg mb-8">
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Tambah tugas baru</h3>
        <form action="{{ route('tasks.store', $taskList) }}" method="POST" class="flex gap-4">
            @csrf
            <div class="flex-1">
                <input type="text" name="title" placeholder="Apa yang perlu dikerjakan?" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-2 px-3 border" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 font-medium">Tambah Tugas</button>
        </form>
    </div>
</div>

<div class="bg-white shadow sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Tugas</h3>
    </div>
    <ul class="divide-y divide-gray-200">
        @forelse ($taskList->tasks as $task)
        <li class="px-4 py-4 sm:px-6 flex items-center justify-between">
            <div class="flex items-center flex-1">
                <form action="{{ route('tasks.update', [$taskList, $task]) }}" method="POST" class="mr-3">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="title" value="{{ $task->title }}">
                    <input type="checkbox" name="is_completed" value="1" onChange="this.form.submit()" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer" {{ $task->is_completed ? 'checked' : '' }}>
                </form>
                <span class="{{ $task->is_completed ? 'line-through text-gray-400' : 'text-gray-900' }}">{{ $task->title }}</span>
            </div>
            
            <div class="flex space-x-3 ml-4">
                <a href="{{ route('tasks.edit', [$taskList, $task]) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">Edit</a>
                <form action="{{ route('tasks.destroy', [$taskList, $task]) }}" method="POST" onsubmit="return confirm('Hapus tugas ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Hapus</button>
                </form>
            </div>
        </li>
        @empty
        <li class="px-4 py-8 text-center text-gray-500">
            Belum ada tugas. Tambah di atas!
        </li>
        @endforelse
    </ul>
</div>
@endsection
