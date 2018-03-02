<ul class="sidebar-top-level-items">
    <li class="{{ Request::is('groups/' . $group->id) ? 'active' : '' }}">
        <a href="/groups/{{ $group->id }}" class="nav-link">
            <span class="mr-2">
            <svg class="svg-inline--fa fa-file fa-w-12" aria-hidden="true" data-prefix="far" data-icon="file" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48z"></path></svg>
            </span>
            @lang('messages.projects')
        </a>
    </li>

    <li class="{{ Request::is('*milestones') ? 'active' : '' }}">
        <a href="/groups/{{ $group->id }}/milestones" class="nav-link">
            <span class="mr-2">
            <svg class="svg-inline--fa fa-map-signs fa-w-16" aria-hidden="true" data-prefix="far" data-icon="map-signs" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M424 192a24 24 0 0 0 16.971-7.029l56-56c9.372-9.373 9.372-24.569 0-33.941l-56-56A23.997 23.997 0 0 0 424 32H280V12c0-6.627-5.373-12-12-12h-24c-6.627 0-12 5.373-12 12v20H56c-13.255 0-24 10.745-24 24v112c0 13.255 10.745 24 24 24h176v32H88a24 24 0 0 0-16.971 7.029l-56 56c-9.372 9.373-9.372 24.568 0 33.941l56 56A23.997 23.997 0 0 0 88 384h144v116c0 6.627 5.373 12 12 12h24c6.627 0 12-5.373 12-12V384h176c13.255 0 24-10.745 24-24V248c0-13.255-10.745-24-24-24H280v-32h144zm8 80v64H97.941l-32-32 32-32H432zM80 144V80h334.059l32 32-32 32H80z"></path></svg>
            </span>
            Milestones
        </a>
    </li>
</ul>
