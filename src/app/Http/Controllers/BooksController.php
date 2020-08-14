<?php


namespace App\Http\Controllers;


use App\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BooksController extends AuthController
{
    public function getBooksForUser(Request $request): JsonResponse
    {
        $user = auth()->user();

        return new JsonResponse(
            Book::where('user_id', $user->id)->get()
        );
    }

    public function createBook(Request $request)
    {
        $user = auth()->user();

        $book = new Book();
        $book->user_id = $user->id;
        $book->name = $request->name;
        $book->number_of_pages = $request->number_of_pages;
        $book->annotation = $request->annotation;
        $book->author_id = $request->author_id;

        // not sure if this is right
        if ($request->hasFile('cover_image')) {
            $book->cover_image = base64_encode($request->file('cover_image'));
        }

        $book->save();

        return new JsonResponse($book);
    }

    public function updateBook(Request $request, int $id): JsonResponse
    {
        // TODO
    }

    public function deleteBook(Request $request, int $id): JsonResponse
    {
        // TODO
    }
}
