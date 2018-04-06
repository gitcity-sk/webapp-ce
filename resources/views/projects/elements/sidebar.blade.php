<ul class="sidebar-top-level-items">
    <li class="{{ Request::is('projects/' . $project->id) ? 'active' : '' }}">
        <a href="/projects/{{ $project->id }}" class="nav-link">
            <span class="mr-2">
                <svg class="svg-inline--fa fa-home fa-w-18" aria-hidden="true" data-prefix="far" data-icon="home" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M557.1 240.7L512 203.8V104c0-4.4-3.6-8-8-8h-32c-4.4 0-8 3.6-8 8v60.5L313.4 41.1c-14.7-12.1-36-12.1-50.7 0L18.9 240.7c-3.4 2.8-3.9 7.8-1.1 11.3l20.3 24.8c2.8 3.4 7.8 3.9 11.3 1.1l14.7-12V464c0 8.8 7.2 16 16 16h168c4.4 0 8-3.6 8-8V344h64v128c0 4.4 3.6 8 8 8h168c8.8 0 16-7.2 16-16V265.8l14.7 12c3.4 2.8 8.5 2.3 11.3-1.1l20.3-24.8c2.6-3.4 2.1-8.4-1.3-11.2zM464 432h-96V304c0-4.4-3.6-8-8-8H216c-4.4 0-8 3.6-8 8v128h-96V226.5l170.9-140c2.9-2.4 7.2-2.4 10.1 0l170.9 140V432z"></path></svg><!-- <i class="far fa-home"></i> -->
            </span>
            Home
        </a>
    </li>

    <li class="{{ Request::is('*files*', '*commits', '*branches', '*tags') ? 'active' : '' }}">
        <a href="/projects/{{ $project->id }}/files" class="nav-link" aria-expanded="{{ Request::is('*files*', '*commits', '*branches', '*tags') ? 'true' : 'false' }}">
            <span class="mr-2">
            <svg class="svg-inline--fa fa-file fa-w-12" aria-hidden="true" data-prefix="far" data-icon="file" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48z"></path></svg>
            </span>
            Repository
        </a>
        <ul class="collapse list-unstyled sidebar-sub-level-items {{ Request::is('*files*', '*commits', '*branches', '*tags') ? 'show' : '' }} " id="filesSubmenu">
            <li class="{{ Request::is('*files*') ? 'active' : '' }}">
                <a href="/projects/{{ $project->id }}/files" class="nav-link">
                    Files
                </a>
            </li>
            <li class="{{ Request::is('*commits') ? 'active' : '' }}">
                <a href="/projects/{{ $project->id }}/commits" class="nav-link">
                    Commits
                </a>
            </li>

            <li class="{{ Request::is('*branches') ? 'active' : '' }}">
                <a href="/projects/{{ $project->id }}/branches" class="nav-link">
                    Branches
                </a>
            </li>

            <li class="{{ Request::is('*tags') ? 'active' : '' }}">
                <a href="/projects/{{ $project->id }}/tags" class="nav-link">
                    Tags
                </a>
            </li>
        </ul>
    </li>

    <li class="{{ Request::is('*issues*', '*milestones') ? 'active' : '' }}">
        <a href="/projects/{{ $project->id }}/issues" class="nav-link" aria-expanded="{{ Request::is('*issues', '*milestones') ? 'true' : 'false' }}">
            <span class="mr-2">
            <svg class="svg-inline--fa fa-bug fa-w-18" aria-hidden="true" data-prefix="far" data-icon="bug" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M536 264h-64v-94.059l40.971-40.971c9.372-9.373 9.372-24.569 0-33.941-9.373-9.372-24.568-9.372-33.941 0L438.059 136H425C425 60.87 364.091 0 289 0c-75.13 0-136 60.909-136 136h-15.059l-40.97-40.971c-9.373-9.372-24.568-9.372-33.941 0-9.373 9.373-9.373 24.569 0 33.941L104 169.941V264H40c-13.255 0-24 10.745-24 24s10.745 24 24 24h64v24c0 29.275 7.91 56.733 21.694 80.365L71.029 471.03c-9.373 9.373-9.373 24.568 0 33.941 9.371 9.372 24.568 9.373 33.941 0l51.029-51.029C184.482 480.046 222.411 496 264 496h48c41.589 0 79.518-15.954 108.001-42.058l51.029 51.029c9.372 9.372 24.568 9.373 33.941 0 9.372-9.373 9.372-24.568 0-33.941l-54.665-54.665C464.09 392.734 472 365.275 472 336v-24h64c13.255 0 24-10.745 24-24s-10.745-24-24-24zM289 48c48.601 0 88 39.399 88 88H201c0-48.601 39.399-88 88-88zm23 400V260c0-6.627-5.373-12-12-12h-24c-6.627 0-12 5.373-12 12v188c-61.757 0-112-50.243-112-112V184h272v152c0 61.757-50.243 112-112 112z"></path></svg>
            </span>
            Issues <span class="badge badge-pill badge-secondary ml-1">{{ $project->issues->count() }}</span>
        </a>
        <ul class="collapse list-unstyled sidebar-sub-level-items {{ Request::is('*issues*', '*milestones') ? 'show' : '' }} " id="filesSubmenu">

        <li class="{{ Request::is('*issues*') ? 'active' : '' }}">
            <a href="/projects/{{ $project->id }}/issues" class="nav-link">
                List
            </a>
        </li>

        <li class="{{ Request::is('*milestones') ? 'active' : '' }}">
            <a href="/projects/{{ $project->id }}/milestones" class="nav-link">
                Milestones <span class="badge badge-pill badge-secondary ml-1">{{ $project->milestones->count() }}</span>
            </a>
        </li>

        </ul>
    </li>

    <li class="{{ Request::is('*merge-requests') ? 'active' : '' }}">
        <a href="/projects/{{ $project->id }}/merge-requests" class="nav-link">
            <span class="mr-2">
            <svg class="svg-inline--fa fa-code-merge fa-w-12" aria-hidden="true" data-prefix="far" data-icon="code-merge" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M304 192c-38 0-69.8 26.5-77.9 62-23.9-3.5-58-12.9-83.9-37.6-16.6-15.9-27.9-36.5-33.7-61.6C138.6 143.3 160 114.1 160 80c0-44.2-35.8-80-80-80S0 35.8 0 80c0 35.8 23.5 66.1 56 76.3v199.3C23.5 365.9 0 396.2 0 432c0 44.2 35.8 80 80 80s80-35.8 80-80c0-35.8-23.5-66.1-56-76.3V246.1c1.6 1.7 3.3 3.4 5 5 39.3 37.5 90.4 48.6 121.2 51.8 12.1 28.9 40.6 49.2 73.8 49.2 44.2 0 80-35.8 80-80S348.2 192 304 192zM80 48c17.6 0 32 14.4 32 32s-14.4 32-32 32-32-14.4-32-32 14.4-32 32-32zm0 416c-17.6 0-32-14.4-32-32s14.4-32 32-32 32 14.4 32 32-14.4 32-32 32zm224-160c-17.6 0-32-14.4-32-32s14.4-32 32-32 32 14.4 32 32-14.4 32-32 32z"></path></svg>
            </span>
            Merge Requests <span class="badge badge-pill badge-secondary ml-1">{{ $project->mergeRequests->count() }}</span>
        </a>
    </li>

    <li class="{{ Request::is('*/-/cms') ? 'active' : '' }}">
        <a href="/-/cms/{{ $project->id }}" class="nav-link">
            <span class="mr-2">
            <svg class="svg-inline--fa fa-columns fa-w-16" aria-hidden="true" data-prefix="far" data-icon="columns" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM232 432H54a6 6 0 0 1-6-6V112h184v320zm226 0H280V112h184v314a6 6 0 0 1-6 6z"></path></svg>
            </span>
            Pages
        </a>
    </li>

    <li class="{{ Request::is('*spaces') ? 'active' : '' }}">
        <a href="/projects/{{ $project->id }}/spaces" class="nav-link">
            <span class="mr-2">
            <svg class="svg-inline--fa fa-boxes-alt fa-w-20" aria-hidden="true" data-prefix="fal" data-icon="boxes-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M624 224H480V16c0-8.8-7.2-16-16-16H176c-8.8 0-16 7.2-16 16v208H16c-8.8 0-16 7.2-16 16v256c0 8.8 7.2 16 16 16h608c8.8 0 16-7.2 16-16V240c0-8.8-7.2-16-16-16zm-112 32v64h-64v-64h64zM288 32h64v64h-64V32zm-96 0h64v64c0 17.7 14.3 32 32 32h64c17.7 0 32-14.3 32-32V32h64v192H192V32zm-64 224h64v64h-64v-64zm176 224H32V256h64v64c0 17.7 14.3 32 32 32h64c17.7 0 32-14.3 32-32v-64h80v224zm304 0H336V256h80v64c0 17.7 14.3 32 32 32h64c17.7 0 32-14.3 32-32v-64h64v224z"></path></svg>
            </span>
            Spaces <span class="badge badge-danger ml-1">Beta</span>
        </a>
    </li>
</ul>
