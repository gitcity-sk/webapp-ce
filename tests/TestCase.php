<?php

namespace Tests;

use App\Permission;
use App\User;
use GitElephant\GitBinary;
use GitElephant\Repository;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $testingLicense = 'qb9nN2OGf2KnyOjgyNi/6G+pLMnLW3lsmuVwO9L4HWczL4liNthVoZ7a97+23j3u4l0qGD0H2NDSXXg+Ge6EpStyfeG1Vu9t0ykg7DuMDMAJ/elsmPK4CAhU8PQH2I9dU5V83K+3Yh3GZ5+fc5wBRCwI+o5W/j0H40SCrOO9Fohwc6tO/93PbxdJgJaLLTO657C9jAKG+1Aq1aQHTdrRvRMTkcfaKd2c373Rsj8io+wo9bbKMbBbe4dDCCmv6voG/r7rSwoTBK+iRNgcGciCVKv2rsyjKnnG5ihJ8wWps9xyyca2d2gEHHDh16aSBU404Q92AoFfDfrShmRaEE3Ou+BoFq79cDl3utoBsO6Xp2En7XT9GgtaQOgqg25BD22dq98ln7vzkNMd55LoCPIQa9bvSgC6AEYzfo9UY/bJqqjbYySxodS9wTnYrZWs6PcjdGWA+8pchswqyWQXQon4aVcxwVPNXbnBMVU7RfkXHcER0deE4edyusSiV59keH0wgLXs136VSVwVlKBlzq5Y2ec+dQWc1O9YWsWE9WUFVKmpAPHAzmZj8GphwNhwqaoPkm6kN9yNb0pvn9dUFCoamV2vSSrnFMWNvPvNBdRZc1VWHNH5qrws5G8N0VdU7tKNordY7z0LvEZLRjqq85N1Pq/QJbulypqnIfWOS9kX+9I=';

    protected function createUserWithPermissionTo($permissionName, $overrides = [])
    {
        $permission = factory(Permission::class)->create([
            'name' => $permissionName
        ]);

        $user = factory(User::class)->create($overrides);

        Gate::define($permission->name, function ($user) {
            return true;
        });

        return $user;
    }

    protected function getTestingLicense()
    {
        return $this->testingLicense;
    }

    protected function createEmptyBareRepository(string $userName, string $repositoryName)
    {
        $path = 'git/' . str_slug($userName) . DIRECTORY_SEPARATOR . str_slug($repositoryName) . '.git';
        if (Storage::makeDirectory($path)) {
            $repo = new Repository(storage_path('app/' . $path), new GitBinary(config('webapp.git.binary')));
            $repo->init(true);

            return $repo;
        }

        return false;
    }
}
