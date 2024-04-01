<div class="card my-5">
    <div class="card-header">
        {{ $project->title }}
    </div>
    <div class="card-body">
        <div class="row">
            @if ($project->image)
                <div class="col-3">
                    <img src="{{ $project->printImage() }}" alt="{{ $project->title }}">
                </div>
            @endif
        </div>

        <div class="col">
            <h5 class="card-title my-3">{{ $project->title }}</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">{{ $project->created_at }}</h6>
            <td>
                @if ($project->type)
                    <span class="badge"
                        style="background-color: {{ $project->type->color }}">{{ $project->type->label }}</span>
                @else
                    Tipologia: N/A
                @endif
            </td>
            <div>
                @forelse($project->technologies as $tech)
                    <span class="badge rounded-pill text-bg-{{ $tech->color }}">{{ $tech->label }}</span>
                @empty
                    Tecnologia: N/A
                @endforelse
            </div>
            <p class="card-text">{{ $project->content }}</p>
        </div>

        {{-- <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a> --}}
    </div>
</div>
