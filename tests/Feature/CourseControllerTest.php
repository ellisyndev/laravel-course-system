<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // 先建立學院與系所資料
        $this->seed([
            \Database\Seeders\CollegeSeeder::class,
            \Database\Seeders\DepartmentSeeder::class,
        ]);
    }

    /**
     * 測試未登入不可取得課程列表
     */
    public function test_guest_cannot_access_courses(): void
    {
        $response = $this->getJson('/api/courses');

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.',
            ]);
    }

    /**
     * 測試可以取得課程列表
     */
    public function test_user_can_get_course_list(): void
    {
        $user = User::factory()->create(['role' => 'student']);
        Course::factory()->count(3)->create();

        $response = $this->actingAs($user)->getJson('/api/courses');

        $response->assertOk()
            ->assertJsonPath('status', 200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    '*' => [
                        'id',
                        'code',
                        'name',
                        'description',
                        'is_required',
                        'credit',
                        'remarks',
                        'max_students',
                        'teacher_name',
                        'teacher_email',
                        'start_time',
                        'end_time',
                        'college_name',
                        'department_name',
                        'classroom_name',
                        'level_code',
                        'semester_code',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'links',
                    'path',
                    'per_page',
                    'to',
                    'total',
                ],
            ])
            ->assertJsonPath('meta.total', 3);
    }

    /**
     * 測試可以篩選課程
     */
    public function test_user_can_filter_by_teacher_id(): void
    {
        $user = User::factory()->create(['role' => 'student']);
        $teacherA = User::factory()->create(['role' => 'teacher']);
        $teacherB = User::factory()->create(['role' => 'teacher']);

        Course::factory()->count(2)->create(['teacher_id' => $teacherA->id]);
        Course::factory()->count(1)->create(['teacher_id' => $teacherB->id]);

        $response = $this->actingAs($user)->getJson("/api/courses?teacher_id={$teacherA->id}");

        $response->assertOk()
            ->assertJsonPath('meta.total', 2);
    }
}
