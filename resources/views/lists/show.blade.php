<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $list->name }}</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: #f5f7fa;
            color: #2d3748;
        }

        h1 {
            margin-bottom: 10px;
        }

        h2 {
            margin-top: 30px;
        }

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            background: #d4edda;
            color: #155724;
        }

        .form-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            border: 1px solid #ddd;
        }

        input,
        select {
            padding: 10px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="text"] {
            width: 40%;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            background: #3182ce;
        }

        button:hover {
            opacity: 0.85;
        }

        .btn-edit {
            background: #805ad5;
        }

        .btn-delete {
            background: #e53e3e;
        }

        .btn-success {
            background: #38a169;
        }

        .task {
            background: white;
            padding: 18px;
            margin-bottom: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .task.done {
            opacity: 0.6;
        }

        .task.done .task-title {
            text-decoration: line-through;
        }

        .task-title {
            font-size: 18px;
            font-weight: bold;
        }

        .task-info {
            margin-top: 8px;
            margin-bottom: 12px;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            margin-right: 5px;
            border-radius: 10px;
            background: #edf2f7;
            font-size: 13px;
        }

        .priority-rendah {
            background: #c6f6d5;
        }

        .priority-sedang {
            background: #feebc8;
        }

        .priority-tinggi {
            background: #fed7d7;
        }

        .task-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .edit-form {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
        }

    </style>

</head>

<body>

    <h1>{{ $list->name }}</h1>

    @if(session('success'))

        <div class="alert">
            {{ session('success') }}
        </div>

    @endif


    <!-- ===================================== -->
    <!-- TAMBAH TUGAS -->
    <!-- ===================================== -->

    <h2>Tambah Tugas</h2>

    <div class="form-box">

        <form action="{{ route('tasks.store', $list->id) }}" method="POST">

            @csrf

            <input
                type="text"
                name="title"
                placeholder="Nama tugas"
                required
            >

            <select name="priority" required>

                <option value="">Prioritas</option>

                <option value="rendah">
                    Rendah
                </option>

                <option value="sedang">
                    Sedang
                </option>

                <option value="tinggi">
                    Tinggi
                </option>

            </select>

            <input
                type="datetime-local"
                name="deadline"
            >

            <button type="submit">
                + Tambah Tugas
            </button>

        </form>

    </div>


    <!-- ===================================== -->
    <!-- PROGRESS -->
    <!-- ===================================== -->

    <h2>Progress</h2>

    <p>
        <strong>
            {{ $completedTasks }} / {{ $totalTasks }}
        </strong>
        tugas selesai
    </p>


    <!-- ===================================== -->
    <!-- DAFTAR TUGAS -->
    <!-- ===================================== -->

    <h2>Daftar Tugas</h2>

    @forelse($tasks as $task)

        <div class="task {{ $task->is_completed ? 'done' : '' }}">

            <div class="task-title">

                {{ $task->title }}

            </div>


            <div class="task-info">

                <span class="badge priority-{{ $task->priority }}">

                    Prioritas:
                    {{ ucfirst($task->priority) }}

                </span>


                <span class="badge">

                    Deadline:

                    @if($task->deadline)

                        {{ $task->deadline->format('d-m-Y H:i') }}

                    @else

                        Tidak ada

                    @endif

                </span>


                <span class="badge">

                    Status:

                    {{ $task->is_completed ? 'Selesai' : 'Belum selesai' }}

                </span>

            </div>


            <!-- ================================= -->
            <!-- TOMBOL -->
            <!-- ================================= -->

            <div class="task-actions">


                <!-- Selesai / Belum selesai -->

                <form
                    action="{{ route('tasks.toggle', $task->id) }}"
                    method="POST"
                >

                    @csrf

                    @method('PATCH')

                    <button
                        type="submit"
                        class="btn-success"
                    >

                        {{ $task->is_completed ? '↩ Belum Selesai' : '✓ Selesai' }}

                    </button>

                </form>


                <!-- Hapus -->

                <form
                    action="{{ route('tasks.destroy', $task->id) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus tugas ini?')"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn-delete"
                    >

                        Hapus

                    </button>

                </form>

            </div>


            <!-- ================================= -->
            <!-- FORM EDIT -->
            <!-- ================================= -->

            <div class="edit-form">

                <form
                    action="{{ route('tasks.update', $task->id) }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    <input
                        type="text"
                        name="title"
                        value="{{ $task->title }}"
                        required
                    >


                    <select
                        name="priority"
                        required
                    >

                        <option
                            value="rendah"
                            {{ $task->priority == 'rendah' ? 'selected' : '' }}
                        >
                            Rendah
                        </option>

                        <option
                            value="sedang"
                            {{ $task->priority == 'sedang' ? 'selected' : '' }}
                        >
                            Sedang
                        </option>

                        <option
                            value="tinggi"
                            {{ $task->priority == 'tinggi' ? 'selected' : '' }}
                        >
                            Tinggi
                        </option>

                    </select>


                    <input
                        type="datetime-local"
                        name="deadline"
                        value="{{ $task->deadline ? $task->deadline->format('Y-m-d\TH:i') : '' }}"
                    >


                    <button
                        type="submit"
                        class="btn-edit"
                    >

                        Simpan Perubahan

                    </button>

                </form>

            </div>

        </div>

    @empty

        <div class="form-box">

            Belum ada tugas.

        </div>

    @endforelse


</body>

</html>