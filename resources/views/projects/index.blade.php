<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">

                <div class="mt-5">
                    
                    <div class="d-flex justify-content-between">
                        <h2 class="text-center">Projects List</h2>
                        <a href="{{ route('projects.create') }}" class="btn btn-dark m-1">
                            Create New Project
                        </a>
                    </div>

                    <x-session />
        
                    <div class="table-responsive">
                        <table class="table mt-4">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Project Name</th>
                                    <th>Pending Tasks</th>
                                    <th>Created At</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $project->id }}</td>
                                        <td>{{ $project->project_name }}</td>
                                        <td>
                                            @if ($project->tasks->where('status', 0)->count() === 0)
                                                <small class="text-success">No Pending Task</small>
                                            @else
                                                <small>{{ $project->tasks->where('status', 0)->count() }}</small>
                                            @endif
                                        </td>
                                        <td>{{ $project->created_at->format('d/m/Y h:m:s') }}</td>
                                        <td>
                                            <a href="{{ route('projects.edit', $project->id) }}"
                                                class="btn btn-sm btn-dark text-white opacity-75">
                                                Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
        
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure you want to delete?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $projects->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
