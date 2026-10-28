<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\Payslip;
use App\Models\Position;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // - Login account one user per role 

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@hr.com',
            'role' => 'admin'
        ]);

         $hr = User::factory()->create([
            'name' => 'HR User',
            'email' => 'hr@hr.com',
            'role' => 'hr'
        ]);

        $manager = User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@hr.com',
            'role' => 'manager'
        ]);

        $employee = User::factory()->create([
            'name' => 'Employee User',
            'email' => 'employee@hr.com',
            'role' => 'employee'
        ]);

        //leave types now
        $annual = LeaveType::create(['name' => 'Annual Leave', 'default_days_per_year' => 15, 'is_paid' => true]);
        $sick = LeaveType::create(['name' => 'Sick Leave', 'default_days_per_year' => 10, 'is_paid' => true]);
        $unpaid = LeaveType::create(['name' => 'Unpaid Leave', 'default_days_per_year' => 0, 'is_paid' => false]);

        $leaveTypes = [$annual, $sick, $unpaid];
    
        //department and positions
        $positions = collect();
        $departments = collect();

        foreach($departments as $deptName => $titles) {

            $department = Department::create(
                [
                    'name' => $deptName,
                    'code' => strtoupper(substr(str_replace(' ', '', $deptName), 0, 3))
                ]
                );
            $departments->push($department);
            // create positions for each department
            foreach($titles as $title) {
                $positions->push(
                    $department->positions()->create(['title' => $title, 'description'=> "{$title} in {$deptName}"])
                );
            }
        }
    
    }
    
}
