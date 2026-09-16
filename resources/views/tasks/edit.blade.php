@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('task_lists.show', $taskList) }}" class="text-blue-600 hover:text-blue-800">&larr; Kembali ke {{ $taskList->name }}</a>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Tugas</h3>
            
            <form action="{{ route('tasks.update', [$taskList, $task]) }}" method="POST" class="mt-5">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Tugas</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3 border" required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4 flex items-center">
                    <input type="checkbox" name="is_completed" id="is_completed" value="1" {{ old('is_completed', $task->is_completed) ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_completed" class="ml-2 block text-sm text-gray-900">Tandai sudah selesai</label>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('task_lists.show', $taskList) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Batal</a>
                    <button type="submit" class="bg-blue-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
