<div class="card bg-transparent border-0 text-center">
    <div class="card-img">
    @if ($member-> image != '')
    <img loading="lazy" decoding="async" src="{{ asset('storage/'.$member-> image )}}" alt="Scarlet Pena" class="rounded w-100" width="300" height="332">
    @endif
        <ul class="card-social list-inline">
            @if ($member -> link_url != '')
            <li class="list-inline-item">
                <a class="linkedin" target="_blank" href="{{ $member-> link_url }}" wire:navigate>
                    <i class="fab fa-linkedin"></i>
                </a>
            </li>
            @endif
            @if ($member -> in_url != '')
            <li class="list-inline-item">
                <a class="instagran" target="_blank" href="{{ $member-> in_url }}" wire:navigate>
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
            @endif
        </ul>
    </div>
    <div class="card-body">
        <h3>{{ $member-> name }}</h3>
        <p>{{ $member-> designation }}</p>
    </div>
</div>
