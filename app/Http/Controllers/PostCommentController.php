<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use function redirect;
use function response;

class PostCommentController extends Controller
{
    /**
     * @param Request $request
     * @param Post    $post
     * @return JsonResponse|RedirectResponse
     *
     * @throws ValidationException
     */
    public function store(Request $request, Post $post)
    {
        $user = $request->user();
        abort_if(!$user, 401);

        $this->validate(
            $request,
            ['body' => 'required|string'],
            ['required' => 'A comment usually has something in it xD']
        );

        // TODO: add better logic for black listing users.
        if (Str::endsWith($user->email, 'mailinator.com')) {
            return redirect()->route('post.show', ['post' => $post]);
        }

        $post->createComment([
            'body' => $request->input('body'),
            'comment_id' => $request->input('comment_id'),
            'user_id' => $user->id,
        ]);

        return $request->expectsJson() ?
            response()->json(['success' => 'Successfully saved comment']) :
            redirect()->route('post.show', ['post' => $post]);
    }
}
