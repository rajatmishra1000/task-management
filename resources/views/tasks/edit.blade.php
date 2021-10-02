<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">

                <div class="mt-5">
                    <h2 class="text-center mb-4">Edit Task</h2>
        
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @method('PUT')
                        @csrf

                        <div class="mb-3">
                            <label for="project_id" class="form-label">
                                Select Project<span class="text-danger">*</span>
                            </label>

                            <select name="project_id" id="project_id" class="form-select">
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" {{ $task->project->id === $project->id ? 'selected' : '' }}>
                                        {{ $project->project_name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('project_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="task_name" class="form-label">
                                Task Name <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="task_name" id="task_name" 
                                class="form-control @error('task_name') is-invalid @enderror"
                                value="{{ $task->task_name }}">

                            @error('task_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button class="btn btn-dark">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>



