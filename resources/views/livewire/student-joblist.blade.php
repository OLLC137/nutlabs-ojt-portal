<div>
    @if (session('status'))
        <div id="flash-message" class="alert alert-success" style="transition: opacity 0.5s">
            {{ session('status') }}
            <script>
                setTimeout(function() {
                    document.getElementById('flash-message').style.opacity = 0;
                    setTimeout(function() {
                        document.getElementById('flash-message').remove();
                    }, 500);
                }, 3000);
            </script>
        </div>
    @endif
    <div class="row align-items-end px-3">
        <div class="col-lg-2 px-1 my-lg-0 my-2">
            Search
            <div class="input-group">
                <input type="text" class="form-control" wire:model="search" wire:keydown.enter="doSearch"
                    placeholder="Enter Keywords">
            </div>
        </div>
        <div class="col-lg-2 px-1 my-lg-0 my-2">
            Categories
            <select style="height: 45px;" class="form-select" wire:model="category" placeholder="Any Classifications">
                <option value="">Any Classification</option>
                @foreach ($categories as $id => $cat_name)
                    <option value="{{ $cat_name }}">{{ $cat_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2 px-1 my-lg-0 my-2">
            Program
            <input type="text" class="form-control" wire:model="program" wire:keydown.enter="doSearch"
                placeholder="Enter Program Name">
        </div>
        <div class="col-lg-2 px-1 my-lg-0 my-2">
            Location
            <input type="text" class="form-control" wire:model="location" wire:keydown.enter="doSearch"
                placeholder="Enter Suburb, City, or Reigon">
        </div>
        <div class="col-lg-2 px-1 my-lg-0 my-2">
            <x-template.button color="primary" wire:click="doSearch">
                <i class="mdi mdi-magnify"></i>
            </x-template.button>
            <x-template.icon wire:click="$set('search', ''); $set('program', ''); $set('location', '')"
                class="text-danger" role="button">close</x-template.icon>
        </div>

    </div>
    <div class="card my-2">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Job List</th>
                        <th>Job Category</th>
                        <th>Company Name</th>
                        <th>Job Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobListings as $job)
                        <tr role="button" wire:click="selectJob({{ $job->id }})">
                            <td>{{ $job->job_list }}</td>
                            <td>{{ $job->job_category }}</td>
                            <td>{{ $job->co_name }}</td>
                            @if ($job->job_status)
                                <td><label class="badge badge-success">OPEN</label></td>
                            @else
                                <td><label class="badge badge-primary">CLOSED</label></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $jobListings->links() }}
</div>
