<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssignRolePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:reload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Renew new role and permission for new menu to superadmin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $role = Role::updateOrCreate(
            ["name"      => "superadmin"],
            ["is_locked" => 1]
        );

        $role->save();
        if ($role) {
            $user = User::where(['username' => 'superadmin'])->first();
            $user->syncRoles($role);

            $permissions = [];
            foreach (config('menus') as $menu) {
                foreach ($menu['action'] as $action) {
                    $permission = $action . '-' . $menu['name'];

                    if (Permission::where('name', $permission)->count() == 0) {
                        Permission::create(['name' => $permission]);
                    }

                    if (in_array('main', $menu['usages'])) {
                        $permissions[] = $permission;
                    }
                }
            }
            $role->syncPermissions($permissions);
            $this->info('All permissions has been assigned to Super Administrator');
        } else {
            $this->info('Role not found!');
        }
    }
}
