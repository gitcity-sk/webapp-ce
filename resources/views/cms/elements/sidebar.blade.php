<ul class="sidebar-top-level-items">

    <li class="{{ Request::is('*/-/cms') ? 'active' : '' }}">
        <a href="/-/cms/{{ $project->id }}" class="nav-link">
            <span class="mr-2">
            <svg class="svg-inline--fa fa-columns fa-w-16" aria-hidden="true" data-prefix="far" data-icon="columns" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM232 432H54a6 6 0 0 1-6-6V112h184v320zm226 0H280V112h184v314a6 6 0 0 1-6 6z"></path></svg>
            </span>
            Pages
        </a>
    </li>

</ul>
