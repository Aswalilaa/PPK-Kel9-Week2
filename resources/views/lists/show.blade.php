<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $list->name }}</title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            max-width: 640px;
            margin: 40px auto;
            padding: 0 20px;
            color: #2d3748;
            line-height: 1.6;
            background-color: #f7fafc;
        }

        h1, h2 {
            color: #1a202c;
            margin-bottom: 0.5rem;
        }

        h1 {
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 12px;
            margin-bottom: 24px;
        }

        h2 {
            margin-top: 28px;
            font-size: 1.25rem;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #fff;
            overflow: hidden;
        }

        li {
            padding: 12px 16px;
            border-bottom: 1px solid #edf2f7;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        li:last-child {
            border-bottom: none;
        }

        .alert {
            padding: 10px 14px;
            border-radius: 6px;
            margin-bottom: 16px;
            font-size: 0.95rem;
        }
        .alert-success { background: #def7ec; color: #03543f; }
        .alert-error { background: #fde8e8; color: #9b1c1c; }

        .form-row {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }

        input[type="email"] {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            font-size: 0.95rem;
        }

        button {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            background: #3182ce;
            color: #fff;
            font-weight: 500;
            cursor: pointer;
        }

        button:hover {
            background: #2b6cb0;
        }

        .btn-remove {
            background: #e53e3e;
            padding: 4px 10px;
            font-size: 0.85rem;
        }

        .btn-remove:hover {
            background: #c53030;
        }

        .badge {
            font-size: 0.8rem;
            padding: 2px 8px;
            border-radius: 9999px;
            background: #edf2f7;
            color: #4a5568;
        }

        .done {
            text-decoration: line-through;
            color: #a0aec0;
        }
    </style>
</head>
<body>

    <h1>{{ $list->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <h2>Members</h2>
    <ul>
        @forelse($list->members as $member)
            <li>
                <span>
                    {{ $member->name }} 
                    <span class="badge">{{ $member->pivot->role }}</span>
                </span>
                <form action="{{ route('lists.members.remove', [$list->id, $member->id]) }}" method="POST" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-remove">Remove</button>
                </form>
            </li>
        @empty
            <li style="color: #a0aec0;">No members yet</li>
        @endforelse
    </ul>

    <h2>Add Member</h2>
    <form class="form-row" action="{{ route('lists.members.add', $list->id) }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="user email" required>
        <button type="submit">Add</button>
    </form>

    <h2>Progress</h2>
    <p><strong>{{ $completedTasks }} / {{ $totalTasks }}</strong> tasks completed</p>

    <ul>
        @forelse($tasks as $task)
            <li class="{{ $task->is_completed ? 'done' : '' }}">
                <span>{{ $task->title }}</span>
                <span class="badge">
                    {{ $task->is_completed ? 'done' : 'pending' }} &bull; {{ $task->owner->email ?? 'unassigned' }}
                </span>
            </li>
        @empty
            <li style="color: #a0aec0;">No tasks found</li>
        @endforelse
    </ul>

</body>
</html>