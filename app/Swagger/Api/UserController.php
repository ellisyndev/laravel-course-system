<?php

namespace App\Swagger\Api;

/**
 * @OA\Tag(
 *     name="Article",
 *     description="文章"
 * )
 */
class UserController
{
    /**
     * @OA\Get(
     *     path="/users",
     *     tags={"User"},
     *     summary="取得學生列表",
     *     description="取得列表（學生教師）",
     *     operationId="getUsers",
     *     security={
     *         {"bearerToken": {}}
     *     },
     *
     *     @OA\Parameter(
     *         name="sorting", in="query", description="排序欄位(預設id)", required=false,
     *
     *         @OA\Schema(type="string", example="id"),
     *     ),
     *
     *     @OA\Parameter(
     *         name="direction", in="query", description="排序方向(預設desc)", required=false,
     *
     *         @OA\Schema(type="string", example="desc", enum={"asc", "desc"}),
     *     ),
     *
     *     @OA\Parameter(
     *         name="page", in="query", description="頁碼(預設1)", required=false,
     *
     *         @OA\Schema(type="string", example="1"),
     *     ),
     *
     *     @OA\Parameter(
     *         name="limit", in="query", description="筆數(預設15)", required=false,
     *
     *         @OA\Schema(type="string", example="15"),
     *     ),
     *
     *     @OA\Parameter(
     *          name="roles", in="query", description="角色", required=false,
     *
     *          @OA\Schema(type="array",
     *
     *               @OA\Items(type="string", enum={"student", "teacher", "staff"}, example="student"),
     *           ),
     *     ),
     *
     *     @OA\Parameter(
     *         name="q", in="query", description="關鍵字搜尋", required=false,
     *
     *         @OA\Schema(type="string", example=""),
     *     ),
     *
     *     @OA\Response(
     *           response=200,
     *           description="Success",
     *
     *           @OA\JsonContent(
     *
     *                @OA\Property( property="code", type="integer", description="狀態代碼", example=200),
     *                @OA\Property( property="message", type="string", description="結果描述", example="操作成功"),
     *                @OA\Property(
     *                     property="data",
     *                     type="array",
     *
     *                     @OA\Items(type="object",
     *
     *                           @OA\Property(property="id", type="integer", example=1, description="id"),
     *                           @OA\Property(property="created_at", type="string", format="date-time", example="2021-07-07 12:00:00", description="建立時間"),
     *                           @OA\Property(property="updated_at", type="string", format="date-time", example="2021-07-07 12:00:00", description="更新時間"),
     *                     ),
     *                ),
     *                @OA\Property( property="meta", type="object", ref="#/components/schemas/Meta"),
     *                @OA\Property( property="links", type="object", ref="#/components/schemas/Links"),
     *           )
     *       ),
     *
     *       @OA\Response(response="401", ref="#/components/responses/401"),
     *       @OA\Response(response="422", ref="#/components/responses/422"),
     * )
     */
    public function index()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/members",
     *     tags={"Member"},
     *     summary="新增會員",
     *     description="新增會員",
     *     operationId="createMember",
     *     security={
     *         {"bearerToken": {}}
     *     },
     *
     *     @OA\RequestBody(
     *         description="Input data format",
     *
     *         @OA\MediaType(mediaType="application/json",
     *
     *             @OA\Schema(
     *                  type="object",
     *                  required={"name", "email", "password"},
     *
     *                  @OA\Property(property="name", type="string", description="會員名稱", example="王小明"),
     *                  @OA\Property(property="email", type="string", format="email", description="會員信箱", example="member@test.com"),
     *                  @OA\Property(property="password", type="string", description="登入密碼（需包含英數）", example="password123"),
     *                  @OA\Property(property="phone", type="string", description="手機號碼", example="0911222333"),
     *                  @OA\Property(property="birthday", type="string", format="date", description="生日", example="1990-01-01"),
     *                  @OA\Property(property="gender", type="string", description="性別", enum={"male", "female", "other"}, example="male"),
     *                  @OA\Property(property="marriage", type="string", description="婚姻狀況", enum={"single", "married", "divorced", "widowed"}, example="single"),
     *                  @OA\Property(property="education", type="string", description="教育程度", enum={"primary_graduate", "junior_graduate", "senior_graduate", "bachelor_graduate", "master_graduate", "doctor_graduate"}, example="bachelor_graduate"),
     *                  @OA\Property(property="avatar", type="integer", description="大頭貼檔案 ID", example=1),
     *                  @OA\Property(property="is_verify_mail", type="boolean", description="是否驗證信箱", example=true),
     *                  @OA\Property(
     *                      property="roles",
     *                      type="array",
     *                      description="角色 ID 陣列",
     *
     *                      @OA\Items(type="integer"),
     *                      example={1, 2}
     *                  ),
     *
     *                  @OA\Property(
     *                      property="address",
     *                      type="array",
     *                      description="地址陣列（可多筆）",
     *
     *                      @OA\Items(
     *                          type="object",
     *                          required={"country_code", "city", "district", "address_detail"},
     *
     *                          @OA\Property(property="country_code", type="string", description="國碼", example="TW"),
     *                          @OA\Property(property="zip_code", type="string", description="郵遞區號", example="407"),
     *                          @OA\Property(property="city", type="string", description="城市", example="台中市"),
     *                          @OA\Property(property="district", type="string", description="區域", example="西屯區"),
     *                          @OA\Property(property="address_detail", type="string", description="詳細地址", example="河南路二段262號")
     *                      )
     *                  )
     *              )
     *         )
     *     ),
     *
     *    @OA\Response(
     *           response=200,
     *           description="Success",
     *
     *           @OA\JsonContent(
     *
     *                @OA\Property( property="code", type="integer", description="狀態代碼", example=200),
     *                @OA\Property( property="message", type="string", description="結果描述", example="操作成功"),
     *                @OA\Property(
     *                     property="data",
     *                     type="array",
     *
     *                     @OA\Items(type="object",
     *
     *                           @OA\Property(property="id", type="integer", example=1, description="id"),
     *                           @OA\Property(property="created_at", type="string", format="date-time", example="2021-07-07 12:00:00", description="建立時間"),
     *                           @OA\Property(property="updated_at", type="string", format="date-time", example="2021-07-07 12:00:00", description="更新時間"),
     *                     ),
     *                ),
     *           )
     *       ),
     *
     *       @OA\Response(response="401", ref="#/components/responses/401"),
     *       @OA\Response(response="422", ref="#/components/responses/422"),
     * )
     */
    public function store()
    {
        //
    }

    /**
     * @OA\Put(
     *     path="/members/{:id}",
     *     tags={"Member"},
     *     summary="修改會員資訊",
     *     description="修改會員資訊",
     *     operationId="editMember",
     *     security={
     *         {"bearerToken": {}}
     *     },
     *
     *     @OA\Parameter(name=":id", in="path", description="ID", required=true,
     *
     *         @OA\Schema(type="string", example="1")
     *     ),
     *
     *     @OA\RequestBody(
     *          description="Input data format",
     *
     *          @OA\MediaType(mediaType="application/json",
     *
     *              @OA\Schema(type="object", required={},
     *
     *                  @OA\Property( property="title", type="string", description="標題", example="Title"),
     *                  @OA\Property( property="description", type="string", description="描述", example="Description"),
     *                  @OA\Property( property="content", type="string", description="內容", example="Content"),
     *                  @OA\Property( property="category_id", type="integer", description="分類ID", example=1),
     *                  @OA\Property( property="status", type="string", description="狀態", example="published", enum={"published", "draft"}),
     *                  @OA\Property( property="author_id", type="integer", description="作者ID", example=1),
     *                  @OA\Property( property="started_at", type="string", format="date-time", description="開始時間", example="2021-07-07 12:00:00"),
     *                  @OA\Property( property="ended_at", type="string", format="date-time", description="結束時間", example="2021-07-07 12:00:00"),
     *                  @OA\Property( property="sort", type="integer", description="排序", example=1),
     *                  @OA\Property( property="is_top", type="boolean", description="是否置頂", example=true),
     *                  @OA\Property( property="seo_title", type="string", description="SEO標題", example="SEO Title"),
     *                  @OA\Property( property="seo_description", type="string", description="SEO描述", example="SEO Description"),
     *                  @OA\Property( property="seo_keywords", type="string", description="SEO關鍵字", example="SEO Keywords"),
     *                  @OA\Property( property="seo_slug", type="string", description="SEO網址", example="seo-slug"),
     *                  @OA\Property( property="file_id", type="string", description="圖片ID", example="1"),
     *                  @OA\Property(property="tags", type="array", description="會員標籤",
     *
     *                       @OA\Items(type="string"), example={"tag1", "tag2"}),
     *              )
     *          )
     *      ),
     *
     *     @OA\Response(
     *           response=200,
     *           description="Success",
     *
     *           @OA\JsonContent(
     *
     *                @OA\Property( property="code", type="integer", description="狀態代碼", example=200),
     *                @OA\Property( property="message", type="string", description="結果描述", example="操作成功"),
     *                @OA\Property(
     *                     property="data",
     *                     type="array",
     *
     *                     @OA\Items(type="object",
     *
     *                           @OA\Property(property="id", type="integer", example=1, description="id"),
     *                           @OA\Property(property="created_at", type="string", format="date-time", example="2021-07-07 12:00:00", description="建立時間"),
     *                           @OA\Property(property="updated_at", type="string", format="date-time", example="2021-07-07 12:00:00", description="更新時間"),
     *                     ),
     *                ),
     *           )
     *       ),
     *
     *       @OA\Response(response="401", ref="#/components/responses/401"),
     *       @OA\Response(response="422", ref="#/components/responses/422"),
     * )
     */
    public function update()
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/members/{:id}",
     *     tags={"Member"},
     *     summary="取得會員資訊",
     *     description="取得會員資訊",
     *     operationId="getMember",
     *     security={
     *         {"bearerToken": {}}
     *     },
     *
     *     @OA\Parameter(name=":id", in="path", description="ID", required=true,
     *
     *         @OA\Schema(type="string", example="1")
     *     ),
     *
     *     @OA\Response(
     *           response=200,
     *           description="Success",
     *
     *           @OA\JsonContent(
     *
     *                @OA\Property( property="code", type="integer", description="狀態代碼", example=200),
     *                @OA\Property( property="message", type="string", description="結果描述", example="操作成功"),
     *                @OA\Property(
     *                     property="data",
     *                     type="array",
     *
     *                     @OA\Items(type="object",
     *
     *                           @OA\Property(property="id", type="integer", example=1, description="id"),
     *                           @OA\Property(property="created_at", type="string", format="date-time", example="2021-07-07 12:00:00", description="建立時間"),
     *                           @OA\Property(property="updated_at", type="string", format="date-time", example="2021-07-07 12:00:00", description="更新時間"),
     *                     ),
     *                ),
     *           )
     *       ),
     *
     *       @OA\Response(response="401", ref="#/components/responses/401"),
     *       @OA\Response(response="422", ref="#/components/responses/422"),
     * )
     */
    public function show()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/members/batch_delete",
     *     tags={"Member"},
     *     summary="批次刪除會員",
     *     description="批次刪除會員",
     *     operationId="batchDeleteMember",
     *     security={
     *          {"bearerToken": {}}
     *      },
     *
     *     @OA\RequestBody(
     *          description="Input data format",
     *
     *          @OA\MediaType(mediaType="application/json",
     *
     *              @OA\Schema(type="object", required={},
     *
     *                  @OA\Property(property="ids", type="array", description="會員ID",
     *
     *                       @OA\Items(type="string"), example={1, 2}),
     *              )
     *          )
     *      ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful Operation",
     *
     *         @OA\JsonContent(type="object",
     *
     *             @OA\Property( property="message", type="string", example="OK"),
     *         ),
     *     ),
     *
     *     @OA\Response( response=422, ref="#/components/responses/422")
     * )
     */
    public function batchDelete()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/members/batch_sort",
     *     tags={"Member"},
     *     summary="會員排序",
     *     description="會員排序",
     *     operationId="updateMemberOrder",
     *     security={
     *          {"bearerToken": {}}
     *      },
     *
     *     @OA\RequestBody(
     *           description="Input data format",
     *
     *           @OA\MediaType(mediaType="application/json",
     *
     *               @OA\Schema(
     * type="object",
     * required={"members"},
     *
     * @OA\Property(
     * property="members",
     * type="array",
     * description="會員列表",
     *
     * @OA\Items(
     * type="object",
     *
     * @OA\Property(property="id", type="integer", description="會員ID", example=1),
     * @OA\Property(property="sort", type="integer", description="排序", example=1)
     * )
     * )
     * )
     *           )
     *       ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful Operation",
     *
     *         @OA\JsonContent(type="object",
     *
     *             @OA\Property( property="message", type="string", example="OK"),
     *         ),
     *     ),
     *
     *     @OA\Response( response=422, ref="#/components/responses/422")
     * )
     */
    public function updateOrder()
    {
        //
    }
}
