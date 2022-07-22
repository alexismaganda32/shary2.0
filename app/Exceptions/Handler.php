<?php

namespace App\Exceptions;

use Exception;
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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        /*
        ** Error para las excepciones
        ** DESCOMENTAR PARA PRODUCCIÓN
        */
        
        /*if ($exception instanceof \Illuminate\Database\QueryException) {
            if($request->ajax()){
                return response(['errors' =>
                    ['DB' => [0 =>'Vaya, parece que algo ha ido mal. (QueryException).']]
                ], 422);
            }

            return response()->view('errors.exceptions', [
                'code' => 500,
                'messageError' => 'Vaya, parece que algo ha ido mal.',
                'error' => 'QueryException',
                'message' => 'Póngase en contacto con el administrador si el problema persiste.',
            ]);
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
            if($request->ajax()){
                return response(['errors' =>
                    ['DB' => [0 =>'Método no permitido. No se permite el método especificado. (MethodNotAllowedHttpException).']]
                ], 422);
            }

            return response()->view('errors.exceptions', [
                'code' => 405,
                'messageError' => 'Método no permitido. No se permite el método especificado.',
                'error' => 'MethodNotAllowedHttpException',
                'message' => 'Póngase en contacto con el administrador si el problema persiste.',
            ]);
        }

        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            if($request->ajax()){
                return response(['errors' => ['DB' => 
                    [0 =>'Recurso no encontrado. (ModelNotFoundException)']]
                ], 422);
            }

            return response()->view('errors.exceptions', [
                'code' => 404,
                'messageError' => 'Recurso no encontrado.',
                'error' => 'ModelNotFoundException',
                'message' => 'Póngase en contacto con el administrador si el problema persiste.',
            ]);
        }*/

        return parent::render($request, $exception);
    }
}
