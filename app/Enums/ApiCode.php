<?php

declare(strict_types=1);

namespace App\Enums;

class ApiCode
{
    /**
     * @Message("OK")
     * 對成功的 GET、PUT、PATCH 或 DELETE 操作進行回應。也可以用於不創建新資源的 POST 操作上
     */
    public const HTTP_OK = 200;

    /**
     * @Message("Created")
     * 對創建新資源的 POST 操作進行回應。應該攜帶指向新資源地址的 Location 頭
     */
    public const CREATED = 201;

    /**
     * @Message("Accepted")
     * 伺服器接受了請求，但是還未處理，回應中應該包含相應的指示資訊，告訴客戶端該去哪裡查詢關於本次請求的資訊
     */
    public const ACCEPTED = 202;

    /**
     * @Message("No Content")
     * 對不會返回回應體的成功請求進行回應（比如 DELETE 請求）
     */
    public const NO_CONTENT = 203;

    /**
     * @Message("Moved Permanently")
     * 被請求的資源已永久移動到新位置
     */
    public const MOVED_PERMANENTLY = 301;

    /**
     * @Message("Found")
     * 請求的資源現在臨時從不同的 URI 回應請求
     */
    public const FOUNT = 302;

    /**
     * @Message("See Other")
     * 對應當前請求的回應可以在另一個 URI 上被找到，客戶端應該使用 GET 方法進行請求。比如在創建已經被創建的資源時，可以返回 303
     */
    public const SEE_OTHER = 303;

    /**
     * @Message("Not Modified")
     * HTTP 快取標頭生效的時候用
     */
    public const NOT_MODIFIED = 304;

    /**
     * @Message("Temporary Redirect")
     * 對應當前請求的回應可以在另一個 URI 上被找到，客戶端應該保持原有的請求方法進行請求
     */
    public const TEMPORARY_REDIRECT = 307;

    /**
     * @Message("Bad Request")
     * 請求異常，比如請求中的 body 無法解析
     */
    public const BAD_REQUEST = 400;

    /**
     * @Message("Unauthorized")
     * 沒有進行認證或者認證非法
     */
    public const UNAUTHORIZED = 401;

    /**
     * @Message("Forbidden")
     * 伺服器已經理解請求，但是拒絕執行它
     */
    public const FORBIDDEN = 403;

    /**
     * @Message("Not Found")
     * 請求一個不存在的資源
     */
    public const NOT_FOUND = 404;

    /**
     * @Message("Method Not Allowed")
     * 所請求的 HTTP 方法不允許當前認證使用者訪問
     */
    public const METHOD_NOT_ALLOWED = 405;

    /**
     * @Message("Gone")
     * 表示當前請求的資源不再可用。當呼叫舊版本 API 的時候很有用
     */
    public const GONE = 410;

    /**
     * @Message("Unsupported Media Type")
     * 如果請求中的內容類型是錯誤的
     */
    public const UNSUPPORTED_MEDIA_TYPE = 415;

    /**
     * @Message("Unprocessable Entity")
     * 用來表示校驗錯誤
     */
    public const UNPROCESSABLE_ENTITY = 422;

    /**
     * @Message("Too Many Requests")
     * 由於請求頻次達到上限而被拒絕訪問
     */
    public const TOO_MANY_REQUESTS = 429;

    /**
     * @Message("Internal Server Error")
     * 伺服器遇到了一個未曾預料的狀況，導致了它無法完成對請求的處理
     */
    public const SERVER_ERROR = 500;

    /**
     * @Message("Not Implemented")
     * 伺服器不支援當前請求所需要的某個功能
     */
    public const NOT_IMPLEMENTED = 501;

    /**
     * @Message("Bad Gateway")
     * 作為閘道或者代理工作的伺服器嘗試執行請求時，從上游伺服器接收到無效的回應
     */
    public const BAD_GATEWAY = 502;

    /**
     * @Message("Service Unavailable")
     * 由於臨時的伺服器維護或者過載，伺服器當前無法處理請求。這個狀況是臨時的，並且將在一段時間以後恢復。如果能夠預計延遲時間，那麼回應中可以包含一個 Retry-After
     * 頭用以標明這個延遲時間（內容可以為數字，單位為秒；或者是一個 HTTP 協議指定的時間格式）。如果沒有給出這個 Retry-After 資訊，那麼客戶端應當以處理 500 回應的方式處理它
     */
    public const SERVICE_UNAVAILABLE = 503;

    /**
     * @Message("Gateway Timeout")
     * 伺服器以閘道器或代理訪問時，並沒有上游伺服器即時收到完成請求所需的回應。
     */
    public const GATEWAY_TIMEOUT = 504;

    /**
     * @Message("HTTP Version Not Supported")
     * 服務器不支持請求中使用的 HTTP 版本。
     */
    public const HTTP_VERSION_NOT_SUPPORTED = 505;

    /**
     * @Message("Variant Also Negotiates")
     * 內部服務器配置錯誤，其中所選變體本身配置為參與內容協商，因此不是正確的協商端點。
     */
    public const VARIANT_ALSO_NEGOTIATES = 506;

    /**
     * @Message("Insufficient Storage")
     * 無法執行某個方法，因為服務器無法存儲成功完成請求所需的表示。
     */
    public const INSUFFICIENT_STORAGE = 507;

    /**
     * @Message("Loop Detected")
     * 服務器終止了操作，因為在處理“Depth: infinity”的請求時遇到無限循環。此狀態表明整個操作失敗。
     */
    public const LOOP_DETECTED = 508;

    /**
     * @Message("Not Extended")
     */
    public const NOT_EXTENDED = 510;

    /**
     * @Message("Network Authentication Required")
     */
    public const NETWORK_AUTHENTICATION_REQUIRED = 511;

    /**
     * @Message("Network Connect Timeout Error")
     * 客戶端需要進行身份驗證才能獲得網絡訪問權限。
     * 此狀態不是由源服務器生成的，而是通過攔截控製網絡訪問的代理生成的。
     * 網絡運營商有時在授予訪問權限之前需要進行一些身份驗證、接受條款或其他用戶交互。
     */
    public const NETWORK_CONNECT_TIMEOUT_ERROR = 599;
}
