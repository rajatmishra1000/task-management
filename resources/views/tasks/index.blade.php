<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">

                <div class="mt-5">

                    <section class="d-flex justify-content-between">
                        <h2 class="text-center">Tasks List</h2>
                        <a href="{{ route('tasks.create') }}" class="btn btn-dark m-1">
                            Create New Task
                        </a>
                    </section>

                    <section class="mt-3">
                        <form class="row row-cols-lg-auto g-2 align-items-center">
                            <div class="col-12">
                                <select name="filter" id="filter" class="form-select">
                                    <option value="0" selected>Filter Task By Project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-dark">Filter</button>
                            </div>

                            <div class="col-12 ml-5 justify-content-end">
                                <a href="{{ route('tasks.index') }}" class="btn bg-white shadow shadow-sm">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </section>

                    <article class="mt-2">
                        <small class="text-danger"><i>Note: Priority of tasks can be changed by simply dragging rows to a different position.</i></small>
                    </article>

                    <x-session />

                    <section class="mt-3">
                        <div class="table-responsive">
                            <table class="table mt-3" id="tasks-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Task Name</th>
                                        <th>Project Name</th>
                                        <th>Priority</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody class="row_position" data-id="{{ $totalTasks }}" id="row_position">
                                    @forelse ($tasks as $task)
                                        <tr id="{{ $task->id }}">
                                            <td>{{ $task->id }}</td>
                                            <td>{{ $task->task_name }}</td>
                                            <td>{{ $task->project->project_name }}</td>
                                            <td>{{ $task->priority }}</td>
                                            <td>{{ $task->created_at->format('d/m/Y h:m:s') }}</td>
                                            <td>
                                                @isset($task)
                                                    @if ($task->status == false)
                                                        <form action="{{ route('tasks.status', $task->id) }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf

                                                            <button
                                                                class="btn btn-sm bg-white text-danger shadow shadow-sm">
                                                                Pending
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button class="btn btn-sm bg-white text-success shadow shadow-sm">
                                                            Completed
                                                        </button>
                                                    @endif
                                                @endisset
                                            </td>
                                            <td>
                                                <a href="{{ route('tasks.edit', $task->id) }}"
                                                    class="btn btn-sm btn-dark text-white opacity-75">
                                                    Edit
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf

                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th colspan="8" class="text-center">
                                                Task Not Found.
                                            </th>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <section class="d-flex justify-content-center mt-4">
                        {{ $tasks->appends(Request::all())->links() }}
                    </section>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(".row_position").sortable({
            delay: 150,
            stop: function() {
                var selectedData = new Array();
                $('.row_position>tr').each(function() {
                    selectedData.push($(this).attr("id"));
                });
                updateOrder(selectedData);
            }
        });

        function updateOrder(data) {
            const row = document.getElementById('row_position')
            const totalTaks = row.getAttribute('data-id');

            if (totalTaks == data.length) {
                axios.post('/tasks/priority', {
                        data: data,
                    })
                    .then(response => console.log(response))
                    .catch(errors => console.error(errors))

                location.reload();
            }

        }
    </script>
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    @endpush
</x-app-layout>
