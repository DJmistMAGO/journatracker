
    {{-- Top Articles --}}
    <div class="card border-0 shadow-sm mb-4">
		<div class="card-body">
			<h5 class="fw-bold mb-3" style="color: var(--theme-color)">Top Articles</h5>
			<ul class="list-styled mb-0">
				@foreach($items->take(5) as $article)
					<li>
						<a href="{{ route('article.read', [$article->type, $article->id]) }}"
						   class="text-black"
						   style="text-decoration: none; transition: all 0.3s;"
						   onmouseover="this.style.textDecoration='underline';"
						   onmouseout="this.style.textDecoration='none';">
							{{ $article->title }}
						</a>
					</li>
				@endforeach
				@if($items->isEmpty())
					<li><small class="text-muted">No articles available.</small></li>
				@endif
			</ul>
		</div>
	</div>


    {{-- Popular Tags --}}
    @php
        $tags = collect($items)->flatMap(function($item) {
            if (!empty($item->tags)) {
                // JSON tags
                return is_array($item->tags) ? $item->tags : json_decode($item->tags, true);
                // If using comma-separated string: return explode(',', $item->tags);
            }
            return [];
        })->unique()->take(10);
    @endphp

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3" style="color: var(--theme-color)">Popular Tags</h5>
            @forelse($tags as $tag)
                <span class="badge bg-secondary me-1">{{ $tag }}</span>
            @empty
                <small class="text-muted">No tags yet</small>
            @endforelse
        </div>
    </div>

    {{-- Incident Report Form --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3" style="color: var(--theme-color)">Incident Report</h5>
            <form action="{{ route('incident-report.store-report') }}" method="POST" enctype="multipart/form-data" onsubmit="prepareTags()">
                @csrf
                @include('_partials.errors')
                @include('_partials.success')

                <div class="mb-2">
                    <label class="form-label">Name of Reporter</label>
                    <input type="text" class="form-control" name="student_name" placeholder="Name of Reporter" />
                </div>

                <div class="mb-2">
                    <label class="form-label">Upload Your Student I.D.</label>
                    <input class="form-control" type="file" name="student_id_image">
                </div>

                <div class="mb-2">
                    <label class="form-label">Incident Description</label>
                    <textarea class="form-control h-px-75" name="incident_description" placeholder="Type here..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Proof of the Incident</label>
                    <input class="form-control" type="file" name="image_proof">
                </div>

                <button type="submit" class="btn btn-theme w-100">Submit Report</button>
            </form>
        </div>
    </div>

    {{-- Share Buttons --}}
    <div class="card border-0 shadow-sm mb-4 text-center p-3">
        <div class="card-body">
            <h5 class="fw-bold mb-3" style="color: var(--theme-color)">Share This</h5>
            <div class="d-flex justify-content-center gap-2">
                <a href="#" class="btn btn-outline-theme btn-icon btn-sm rounded-circle p-2"
                   onmouseover="this.style.backgroundColor='var(--theme-color)'; this.style.color='#fff';"
                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--theme-color)';">
                    <i class="mdi mdi-facebook"></i>
                </a>
                <a href="#" class="btn btn-outline-theme btn-icon btn-sm rounded-circle p-2"
                   onmouseover="this.style.backgroundColor='var(--theme-color)'; this.style.color='#fff';"
                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--theme-color)';">
                    <i class="mdi mdi-twitter"></i>
                </a>
                <a href="#" class="btn btn-outline-theme btn-icon btn-sm rounded-circle p-2"
                   onmouseover="this.style.backgroundColor='var(--theme-color)'; this.style.color='#fff';"
                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--theme-color)';">
                    <i class="mdi mdi-linkedin"></i>
                </a>
            </div>
        </div>
    </div>

