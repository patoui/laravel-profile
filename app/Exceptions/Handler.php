<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

use function app;
use function redirect;

final class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
        ValidationException::class,
    ];

    /**
     * Render an exception into a response.
     *
     * @param  Request  $request
     * @return Response|\Symfony\Component\HttpFoundation\Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        if (app()->environment() === 'testing') {
            throw $e;
        }

        return parent::render($request, $e);
    }

    /**
     * @param  mixed  $request
     * @return RedirectResponse|JsonResponse
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return new JsonResponse(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
