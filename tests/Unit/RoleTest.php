<?php

namespace Tests\Unit;

use App\Models\Permission;
use App\Models\Role;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    /** @test */
    public function it_can_be_assigned_to_permission_as_object()
    {
        $permission = Permission::create(['code' => 'test_permission1']);
        $role = Role::create(['code' => 'test_role']);

        $role->allowTo($permission);
        $this->assertTrue($role->permissions->contains($permission));
    }

    /** @test */
    public function it_can_be_assigned_to_permission_as_string()
    {
        $permission = Permission::create(['code' => 'test_permission']);
        $role = Role::create(['code' => 'test_role']);

        $role->allowTo('test_permission');
        $this->assertTrue($role->permissions->contains($permission));
    }
}
