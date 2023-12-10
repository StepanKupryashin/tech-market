<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->stockResponse($e, 'Неправильный метод',$request,405);
        }
        if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
            return $this->stockResponse($e, 'Не найдено',$request,404);
        }

        return parent::render($request, $e);
    }


    public function stockResponse($e,$message,$request,$status = 500)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'input' => $request->all(),
        ], $status);
    }
}
