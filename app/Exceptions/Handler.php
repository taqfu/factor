<?php

namespace App\Exceptions;
use Auth;
use Exception;
use Mail;
use Request;
use URL;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
      if (Auth::guest()){
          $user = "--GUEST--";
      } else if (Auth::user()){
          $user = Auth::user()->username;
      }
      Mail::send('emails.exception', ['all_requests'=>Request::all(), 'error' => $e, 'user'=>$user, "ip"=>Request::ip(), "url"=>Request::url(), "prev"=>URL::previous() ], function ($m) {
          $m->to('taqfu0@gmail.com', 'Root Basis Bug Reporting')->subject('Error');
      });
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        return parent::render($request, $e);
    }
}
