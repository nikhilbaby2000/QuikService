<?php

$color = 'red';
if ($trust >= 4) {
    $color = 'green';
} elseif ($trust >= 3) {
    $color = '#4F5D95';
} elseif ($trust >= 2) {
    $color = 'orange';
}

?>
<li class="pinned-repo-item p-3 mb-3 border border-gray-dark rounded-1 public source">
    <span class="pinned-repo-item-content">
        <span class="d-block">
            <a href="/" class="text-bold">
                <span class="repo js-repo" title="RouteDebugger">{{ $name }}</span>
            </a>
        </span>

        <p class="pinned-repo-desc text-gray text-small d-block mt-2 mb-3">
        </p>

        <p class="mb-0 f6 text-gray">
            <span class="repo-language-color pinned-repo-meta" style="background-color: {{ $color }};"></span>
            Trust
            <a href="/" class="pinned-repo-meta muted-link">
            <svg aria-label="star" class="octicon octicon-star" viewBox="0 0 14 16" version="1.1" width="14" height="16" role="img">
                <path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74L14 6z"></path>
            </svg>
            {{ $trust }}
            </a>
        </p>
    </span>
</li>