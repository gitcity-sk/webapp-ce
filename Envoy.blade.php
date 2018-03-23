@servers(['web' => 'gitcity.sk'])

@story('tests')
    script
@endstory

@task('script', ['on' => 'web'])
    ls -la
@endtask
