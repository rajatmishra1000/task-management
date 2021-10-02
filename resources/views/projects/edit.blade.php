<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">

                <div class="mt-5">
                    <h2 class="text-center mb-4">Edit Project</h2>
        
                    <form action="{{ route('projects.update', $project->id ) }}" method="POST">
                        @method('PUT')
                        @csrf

                        <div class="mb-3">
                            <label for="project_name" class="form-label">
                                Project Name <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="project_name" id="project_name" 
                                class="form-control @error('project_name') is-invalid @enderror"
                                value="{{ $project->project_name }}">

                            @error('project_name')
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
