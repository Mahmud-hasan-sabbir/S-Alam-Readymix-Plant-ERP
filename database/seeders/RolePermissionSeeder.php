<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Helpers\Helper;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee_code = Helper::Generator(new User, 'employee_code', 5, 'ROHS'); /* Generate id */
        $supper_admin = User::create([
            'name'=>'ROHS-ERP',
            'email'=>'admin@gmail.com',
            'contact_number'=>'01909302126',
            'employee_code'=>$employee_code,
            'password'=>bcrypt('password'),
            'status' => '1',
            'is_admin' => '0',
            'profile_photo_path'=>'fix/admin.jpg',
            'email_verified_at' => '2024-01-01',
            'mast_work_station_id' => '1',
        ]);
        /*__________________________________________________________ */
        /*__________________________________________________________ */
        $supper_admin_role = Role::create(['name' => 'Supper-Admin']);
        $admin_role = Role::create(['name' => 'Admin']);
        $member_role = Role::create(['name' => 'Member']);

        $permissions = [
            /*_____Menu Access_____*/
            ['name' => 'Setting access'],
            ['name' => 'Pages access'],

            //-----Gallery Access
            ['name' => 'Gallery access'],
            ['name' => 'Gallery create'],
            ['name' => 'Gallery edit'],
            ['name' => 'Gallery delete'],

            //-----Member Access
            ['name' => 'Member access'],
            ['name' => 'Approve Member'],
            ['name' => 'Member create'],
            ['name' => 'Member edit'],
            ['name' => 'Member delete'],

            //-----User Access
            ['name' => 'User access'],
            ['name' => 'User create'],
            ['name' => 'User edit'],
            ['name' => 'User delete'],

            //-----Role Access
            ['name' => 'Role access'],
            ['name' => 'Role create'],
            ['name' => 'Role edit'],
            ['name' => 'Role delete'],
        ];

        foreach ($permissions as $item) {
            Permission::create($item);
        }

        $supper_admin->assignRole($supper_admin_role);

        $supper_admin_role->givePermissionTo(Permission::all());
        $member_role->givePermissionTo('Gallery access');

    }
}
