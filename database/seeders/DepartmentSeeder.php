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
            '文學院' => [
                ['name' => '中文系', 'code' => 'CHI'],
                ['name' => '外文系', 'code' => 'ENG'],
                ['name' => '歷史系', 'code' => 'HIS'],
                ['name' => '哲學系', 'code' => 'PHI'],
            ],
            '理學院' => [
                ['name' => '數學系', 'code' => 'MTH'],
                ['name' => '物理系', 'code' => 'PHY'],
                ['name' => '化學系', 'code' => 'CHM'],
                ['name' => '地球科學系', 'code' => 'ESC'],
            ],
            '工學院' => [
                ['name' => '土木系', 'code' => 'CIV'],
                ['name' => '機械系', 'code' => 'MEC'],
                ['name' => '化工系', 'code' => 'CHE'],
                ['name' => '材料系', 'code' => 'MAT'],
            ],
            '電資學院' => [
                ['name' => '電機系', 'code' => 'EEE'],
                ['name' => '資訊工程系', 'code' => 'CS'],
                ['name' => '通訊工程系', 'code' => 'COM'],
            ],
            '管理學院' => [
                ['name' => '企管系', 'code' => 'BA'],
                ['name' => '會計系', 'code' => 'ACC'],
                ['name' => '財金系', 'code' => 'FIN'],
                ['name' => '國際企業系', 'code' => 'IB'],
            ],
            '社會科學院' => [
                ['name' => '社會系', 'code' => 'SOC'],
                ['name' => '心理系', 'code' => 'PSY'],
                ['name' => '政治系', 'code' => 'POL'],
                ['name' => '經濟系', 'code' => 'ECO'],
            ],
            '法律學院' => [
                ['name' => '法律系', 'code' => 'LAW'],
            ],
            '醫學院' => [
                ['name' => '醫學系', 'code' => 'MED'],
                ['name' => '護理系', 'code' => 'NUR'],
                ['name' => '公共衛生系', 'code' => 'PH'],
            ],
            '教育學院' => [
                ['name' => '教育系', 'code' => 'EDU'],
                ['name' => '特教系', 'code' => 'SPC'],
                ['name' => '體育系', 'code' => 'PE'],
            ],
            '國際事務學院' => [
                ['name' => '國際事務系', 'code' => 'INT'],
                ['name' => '外交系', 'code' => 'DIP'],
            ],
        ];

        foreach ($departments as $collegeName => $deptList) {
            $college = College::where('name', $collegeName)->first();
            if (! $college) {
                continue;
            }

            foreach ($deptList as $dept) {
                Department::firstOrCreate(
                    [
                        'college_id' => $college->id,
                        'name' => $dept['name'],
                    ],
                    [
                        'code' => $dept['code'],
                    ]
                );
            }
        }

        $independentDepartments = [
            ['name' => '通識中心', 'code' => 'GEN'],
            ['name' => '語言中心', 'code' => 'LAN'],
            ['name' => '體育室', 'code' => 'PES'],
        ];

        foreach ($independentDepartments as $dept) {
            Department::firstOrCreate(
                ['name' => $dept['name'], 'college_id' => null],
                ['code' => $dept['code']]
            );
        }
    }
}
