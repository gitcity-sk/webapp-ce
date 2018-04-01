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

    protected $testingLicense = 'cATOd7B5PI3gVYEcnt5hiRupfvyA8itojDp6xuaakxfFP1jMRroc0yGwC9iw7UocbyIWqxPc26kzUJneKPUIRlU/0zXgouA9bI6dr9SC8PZqGtk/KLebC4MvAqX/vBNwqCO8jM26MjPEH+ykgngfXEIgIe2FA0oTDkKIWyG4+UnDUG7eQwq1F8EKYyIfLxND+P6BOp7Egi8O97gh9GP0HScOsWj8Cw29M+yoZPiWw3Arn0IOLb3NLC02Wl6fVy7BJ5EH7QQ4ki++M/gbHiRe2KNedt71mAJXmp0GFcTdNcOuVHaUdmulv1bwdz01kpJbnoKL1Ewh09kHANJ69KsWh7NF6ZPxWA9eMMg02/eN/tiJyutpmuxCk7qQ/X4fdxQ/J10DqEikefoZboonDEynMs+gy+ntruZ3eBn3F0HGk1At2lSDuKRdN1uFkEjRduwr7QTVzJaalz+DmYubwhP4wzFIINJ326ydlx3XdiANpmW3Tp50mJkJvhIOCUwbBtkSA91CRFpupUEhyx0p/BSQyF/wlcViTXysZyVpJuhdvIp2bMSZwOCAhozr/LZTUap3Uobgc9uSy16Mdmu7LYW/QHrhrEmtS8YVWUu5k8JnOc3pxgo9whkIKxV+o7zRXbi9F9gGhpQS7sYN+7c1uOe3m2dm4eSaEklI/12jBDzfKAY=';

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
