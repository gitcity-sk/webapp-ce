<ul class="sidebar-top-level-items">
    <li class="{{ Request::is('projects/' . $project->id) ? 'active' : '' }}"><a href="/projects/{{ $project->id }}" class="nav-link">Home</a></li>
    <li class="{{ Request::is('projects/' . $project->id) ? 'active' : '' }}"><a href="/projects/{{ $project->id }}" class="nav-link">Files</a></li>
    <li class="{{ Request::is('*commits') ? 'active' : '' }}"><a href="/projects/{{ $project->id }}/commits" class="nav-link">Commits</a></li>
    <li class="{{ Request::is('*branches') ? 'active' : '' }}"><a href="/projects/{{ $project->id }}/branches" class="nav-link">Branches</a></li>
    <li class="{{ Request::is('*tags') ? 'active' : '' }}"><a href="/projects/{{ $project->id }}/tags" class="nav-link">Tags</a></li>
    <li class="{{ Request::is('*issues') ? 'active' : '' }}"><a href="/projects/{{ $project->id }}/issues" class="nav-link">Issues</a></li>
</ul>
