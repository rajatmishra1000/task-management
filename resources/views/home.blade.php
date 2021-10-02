<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">

                <div style="margin-top: 10vw;">
                    <h2 class="text-center">Task Management Application</h2>
                    <p class="text-center">
                        <i>A very simple application to manage projects and tasks.</i>
                    </p>
        
                    <div class="mt-5 d-flex justify-content-center">
                        <a href="{{ route('projects.create') }}" class="btn btn-dark m-1">
                            Create New Project
                        </a>
                        <a href="{{ route('tasks.create') }}" class="btn btn-dark opacity-75 m-1">
                            Create New Task
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
