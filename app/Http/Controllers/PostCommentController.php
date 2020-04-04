<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use function redirect;
use function response;

class PostCommentController extends Controller
{
    /**
     * @return JsonResponse|RedirectResponse
     *
     * @throws ValidationException
     */
    public function store(Request $request, string $slug)
    {
        /** @var Post $post */
        $post = Post::slug($slug)->firstOrFail();

        $this->validate(
            $request,
            ['body' => 'required|string'],
            ['required' => 'A comment usually has something in it xD']
        );

        $post->createComment([
            'body' => $request->input('body'),
            'comment_id' => $request->input('comment_id'),
            'user_id' => $request->user()->id,
        ]);

        return $request->expectsJson() ?
            response()->json(['success' => 'Successfully saved comment']) :
            redirect()->route('post.show', ['post' => $post->slug]);
    }
}
