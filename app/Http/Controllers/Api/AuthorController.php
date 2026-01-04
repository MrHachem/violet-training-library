<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Author\CreateAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends ApiController
{
    public function __construct(private readonly AuthorService $authorService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $per_page = $request->query('per_page');
        // $authors = $authorService->index($per_page);

        $authors = Author::all();
        return $this->success("جميع المؤلفين", [
            'authors' => AuthorResource::collection($authors)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAuthorRequest $request)
    {
        $data = $request->safe()->except('personal_picture');

        $author = $this->authorService->create($data, $request->file('personal_picture'));

        return $this->success("تم إضافة المؤلف", [
            'author' => new AuthorResource($author),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $data = $request->safe()->except('personal_picture');

        $this->authorService->update($author, $data, $request->file('personal_picture'));

        return $this->success("تم تحديث معلومات المؤلف بنجاح",[
            'author' => new AuthorResource($author->fresh())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $this->authorService->delete($author);

        return $this->success("تم حذف المؤلف بنجاح");
    }
}
