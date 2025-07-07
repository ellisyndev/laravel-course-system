<?php

namespace Database\Seeders;

use App\Models\College;
use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            '文學院' => ['中文系', '外文系', '歷史系', '哲學系'],
            '理學院' => ['數學系', '物理系', '化學系', '地球科學系'],
            '工學院' => ['土木系', '機械系', '化工系', '材料系'],
            '電資學院' => ['電機系', '資訊工程系', '通訊工程系'],
            '管理學院' => ['企管系', '會計系', '財金系', '國際企業系'],
            '社會科學院' => ['社會系', '心理系', '政治系', '經濟系'],
            '法律學院' => ['法律系'],
            '醫學院' => ['醫學系', '護理系', '公共衛生系'],
            '教育學院' => ['教育系', '特教系', '體育系'],
            '國際事務學院' => ['國際事務系', '外交系'],
        ];

        foreach ($departments as $collegeName => $deptList) {
            $college = College::where('name', $collegeName)->first();
            if (! $college) {
                continue;
            }

            foreach ($deptList as $deptName) {
                Department::firstOrCreate([
                    'college_id' => $college->id,
                    'name' => $deptName,
                ]);
            }
        }
    }
}
