<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::get('/', 'HomeController@index')->name('home');

// Post
Route::get('blog', 'PostController@index')->name('post.index');
Route::get('post/{post:slug}', 'PostController@show')->name('post.show');
Route::post('post/{post:slug}', 'PostFavouriteController@store')
    ->name('post.favourite.store')
    ->middleware('auth');

// Comment
Route::post('post/{post:slug}/comment', 'PostCommentController@store')
    ->name('post.comment.store')
    ->middleware(['auth', ProtectAgainstSpam::class]);

Route::post('comment/{comment}', 'CommentFavouriteController@store')
    ->name('comment.favourite.store')
    ->middleware('auth');

// Tip
Route::get('tip', 'TipController@index')->name('tip.index');
Route::get('tip/{tip:slug}', 'TipController@show')->name('tip.show');
Route::post('tip/{tip:slug}', 'TipFavouriteController@store')
    ->name('tip.favourite.store')
    ->middleware('auth');

Route::get('video', 'VideoController@index')->name('video.index');
Route::get('video/{video}', 'VideoController@show')->name('video.show');
Route::post('video/{video}', 'VideoFavouriteController@store')
    ->name('video.favourite.store')
    ->middleware('auth');

// Subscription
Route::post('subscription', 'SubscriptionController@store')
    ->name('subscription.store');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('register.store');

// Verification
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

// Socialite (Github)
Route::get('auth/github', 'Auth\LoginController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::feeds();

Route::prefix('/webhooks')->group(function () {
    Route::prefix('/slack')->group(function () {
        Route::match(['get', 'post'], '/test', function (Request $request) {
            /** @var string $content */
            $content = $request->getContent(false);
            $sig = 'v0=' . hash_hmac(
                'sha256',
                sprintf("v0:%s:%s", $request->headers->get('x-slack-request-timestamp'), $content),
                config('slack.signing_key')
            );

            $slackSignature = $request->headers->get('x-slack-signature');

            // Abort if request cannot be verified
            abort_if(!$slackSignature || !hash_equals($sig, $slackSignature), 404);

            return response()->json([
                "replace_original" => "true",
                "response_type" => "in_channel",
                "blocks" => [
                    [
                        "type" => "section",
                        "text" => [
                            "type" => "mrkdwn",
                            "text" => "*It's 80 degrees right now.*"
                        ]
                    ],
                    [
                        "type" => "section",
                        "text" => [
                            "type" => "mrkdwn",
                            "text" => "Partly cloudy today and tomorrow"
                        ]
                    ]
                ]
            ]);
        });
    });
});
