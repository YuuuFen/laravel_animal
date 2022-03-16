<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function render($request, Throwable $exception)
    {
        //如果使用者請求伺服器回傳 JSON 格式
        if ($request->expectsJson()) {
            //檢查 $exception 這個被攔截的例外是不是 ModelNotFoundException 類別
            //instanceof: 型態運算子
            if ($exception instanceof ModelNotFoundException) {
                //攔截到例外，回傳狀態碼並附上錯誤資訊為 json 格式
                return response()->json(
                    [
                        'error' => '找不到資源'
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }
        }
        //執行父類別 render 的程式
        return parent::render($request, $exception);
    }
}
