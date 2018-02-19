<ul class="sidebar-top-level-items">
    <li class="{{ Request::is('projects/' . $project->id) ? 'active' : '' }}">
        <a href="/projects/{{ $project->id }}" class="nav-link">
            <span class="mr-2">
                <svg class="svg-inline--fa fa-home fa-w-18" aria-hidden="true" data-prefix="far" data-icon="home" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M557.1 240.7L512 203.8V104c0-4.4-3.6-8-8-8h-32c-4.4 0-8 3.6-8 8v60.5L313.4 41.1c-14.7-12.1-36-12.1-50.7 0L18.9 240.7c-3.4 2.8-3.9 7.8-1.1 11.3l20.3 24.8c2.8 3.4 7.8 3.9 11.3 1.1l14.7-12V464c0 8.8 7.2 16 16 16h168c4.4 0 8-3.6 8-8V344h64v128c0 4.4 3.6 8 8 8h168c8.8 0 16-7.2 16-16V265.8l14.7 12c3.4 2.8 8.5 2.3 11.3-1.1l20.3-24.8c2.6-3.4 2.1-8.4-1.3-11.2zM464 432h-96V304c0-4.4-3.6-8-8-8H216c-4.4 0-8 3.6-8 8v128h-96V226.5l170.9-140c2.9-2.4 7.2-2.4 10.1 0l170.9 140V432z"></path></svg><!-- <i class="far fa-home"></i> -->
            </span>
            Home
        </a>
    </li>


    <li class="{{ Request::is('projects/' . $project->id) ? 'active' : '' }}">
        <a href="/projects/{{ $project->id }}" class="nav-link">
            <span class="mr-2">
            <svg class="svg-inline--fa fa-file fa-w-12" aria-hidden="true" data-prefix="far" data-icon="file" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48z"></path></svg>
            </span>
            Files
        </a>
    </li>

    <li class="{{ Request::is('*commits') ? 'active' : '' }}">
        <a href="/projects/{{ $project->id }}/commits" class="nav-link">
            <span class="mr-2">
            <svg class="svg-inline--fa fa-code-commit fa-w-20" aria-hidden="true" data-prefix="far" data-icon="code-commit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M128 256c0 10.8.9 21.5 2.6 32H12c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h118.6c-1.7 10.5-2.6 21.2-2.6 32zm500-32H509.4c1.8 10.5 2.6 21.2 2.6 32s-.9 21.5-2.6 32H628c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12zm-308-80c-29.9 0-58 11.7-79.2 32.8C219.6 198 208 226.1 208 256s11.6 58 32.8 79.2C262 356.3 290.1 368 320 368s58-11.7 79.2-32.8C420.4 314 432 285.9 432 256s-11.6-58-32.8-79.2C378 155.7 349.9 144 320 144m0-48c88.4 0 160 71.6 160 160s-71.6 160-160 160-160-71.6-160-160S231.6 96 320 96z"></path></svg>
            </span>
            Commits
        </a>
    </li>

    <li class="{{ Request::is('*branches') ? 'active' : '' }}">
        <a href="/projects/{{ $project->id }}/branches" class="nav-link">
            <span class="mr-2">
            <svg class="svg-inline--fa fa-code-branch fa-w-12" aria-hidden="true" data-prefix="far" data-icon="code-branch" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M384 144c0-44.2-35.8-80-80-80s-80 35.8-80 80c0 36.4 24.3 67.1 57.5 76.8-.6 16.1-4.2 28.5-11 36.9-15.4 19.2-49.3 22.4-85.2 25.7-28.2 2.6-57.4 5.4-81.3 16.9v-144c32.5-10.2 56-40.5 56-76.3 0-44.2-35.8-80-80-80S0 35.8 0 80c0 35.8 23.5 66.1 56 76.3v199.3C23.5 365.9 0 396.2 0 432c0 44.2 35.8 80 80 80s80-35.8 80-80c0-34-21.2-63.1-51.2-74.6 3.1-5.2 7.8-9.8 14.9-13.4 16.2-8.2 40.4-10.4 66.1-12.8 42.2-3.9 90-8.4 118.2-43.5 14-17.4 21.1-39.8 21.6-67.9 31.6-10.7 54.4-40.6 54.4-75.8zM80 48c17.6 0 32 14.4 32 32s-14.4 32-32 32-32-14.4-32-32 14.4-32 32-32zm0 416c-17.6 0-32-14.4-32-32s14.4-32 32-32 32 14.4 32 32-14.4 32-32 32zm224-288c-17.6 0-32-14.4-32-32s14.4-32 32-32 32 14.4 32 32-14.4 32-32 32z"></path></svg>
            </span>
            Branches
        </a>
    </li>

    <li class="{{ Request::is('*tags') ? 'active' : '' }}">
        <a href="/projects/{{ $project->id }}/tags" class="nav-link">
            <span class="mr-2">
            <svg class="svg-inline--fa fa-tags fa-w-20" aria-hidden="true" data-prefix="far" data-icon="tags" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M625.941 293.823L421.823 497.941c-18.746 18.746-49.138 18.745-67.882 0l-.36-.36L592 259.882 331.397 0h48.721a48 48 0 0 1 33.941 14.059l211.882 211.882c18.745 18.745 18.745 49.137 0 67.882zm-128 0L293.823 497.941C284.451 507.314 272.166 512 259.882 512c-12.284 0-24.569-4.686-33.941-14.059L14.059 286.059A48 48 0 0 1 0 252.118V48C0 21.49 21.49 0 48 0h204.118a47.998 47.998 0 0 1 33.941 14.059l211.882 211.882c18.745 18.745 18.745 49.137 0 67.882zM464 259.882L252.118 48H48v204.118l211.886 211.878L464 259.882zM144 96c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48z"></path></svg>
            </span>
            Tags
        </a>
    </li>

    <li class="{{ Request::is('*issues') ? 'active' : '' }}">
        <a href="/projects/{{ $project->id }}/issues" class="nav-link">
            <span class="mr-2">
            <svg class="svg-inline--fa fa-bug fa-w-18" aria-hidden="true" data-prefix="far" data-icon="bug" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M536 264h-64v-94.059l40.971-40.971c9.372-9.373 9.372-24.569 0-33.941-9.373-9.372-24.568-9.372-33.941 0L438.059 136H425C425 60.87 364.091 0 289 0c-75.13 0-136 60.909-136 136h-15.059l-40.97-40.971c-9.373-9.372-24.568-9.372-33.941 0-9.373 9.373-9.373 24.569 0 33.941L104 169.941V264H40c-13.255 0-24 10.745-24 24s10.745 24 24 24h64v24c0 29.275 7.91 56.733 21.694 80.365L71.029 471.03c-9.373 9.373-9.373 24.568 0 33.941 9.371 9.372 24.568 9.373 33.941 0l51.029-51.029C184.482 480.046 222.411 496 264 496h48c41.589 0 79.518-15.954 108.001-42.058l51.029 51.029c9.372 9.372 24.568 9.373 33.941 0 9.372-9.373 9.372-24.568 0-33.941l-54.665-54.665C464.09 392.734 472 365.275 472 336v-24h64c13.255 0 24-10.745 24-24s-10.745-24-24-24zM289 48c48.601 0 88 39.399 88 88H201c0-48.601 39.399-88 88-88zm23 400V260c0-6.627-5.373-12-12-12h-24c-6.627 0-12 5.373-12 12v188c-61.757 0-112-50.243-112-112V184h272v152c0 61.757-50.243 112-112 112z"></path></svg>
            </span>
            Issues
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

    <li class="{{ Request::is('*pages') ? 'active' : '' }}">
        <a href="/projects/{{ $project->id }}/spaces" class="nav-link">
            <span class="mr-2">
            <svg class="svg-inline--fa fa-dot-circle fa-w-16" aria-hidden="true" data-prefix="far" data-icon="dot-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 56c110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200-110.532 0-200-89.451-200-200 0-110.532 89.451-200 200-200m0-48C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 168c-44.183 0-80 35.817-80 80s35.817 80 80 80 80-35.817 80-80-35.817-80-80-80z"></path></svg>
            </span>
            Spaces <span class="badge badge-danger ml-1">Beta</span>
        </a>
    </li>
</ul>
