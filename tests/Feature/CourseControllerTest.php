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
     * @return void
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
     * @return void
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
                'current_page',
                'data' => [
                    '*' => [
                        'id',
                        'code',
                        'name',
                        'description',
                        'content',
                        'teacher_id',
                        'college_id',
                        'department_id',
                        'level_code',
                        'classroom_id',
                        'start_time',
                        'end_time',
                        'credit',
                        'is_required',
                        'semester_code',
                        'max_students',
                        'remarks',
                        'created_at',
                        'updated_at',
                    ]
                ],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total',
            ]);
    }

    /**
     * 測試可以篩選課程
     * @return void
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
            ->assertJsonPath('total', 2);
    }
}
