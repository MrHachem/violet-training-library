<?php

namespace App\Services;

use App\Models\Author;
use App\Repositories\AuthorRepository;
use App\Services\Helpers\FileService;
use Illuminate\Http\UploadedFile;

class AuthorService
{
    public function __construct(private readonly FileService $fileService, private readonly AuthorRepository $repo){ }

    public function create(array $data, ?UploadedFile $personal_picture): Author
    {
        if($personal_picture){
            $personal_picture_path = $this->fileService->storePublicImage($personal_picture, 'authors', 500);
            $data['personal_picture'] = $personal_picture_path;
        }

        return $this->repo->create($data);
    }

    public function update(Author $author, array $data, ?UploadedFile $personal_picture): bool
    {
        if ($personal_picture) {
            if ($author->personal_picture) {
                $this->fileService->deleteFile('public',$author->personal_picture);
            }

            $personal_picture_path = $this->fileService->storePublicImage($personal_picture, 'authors', 500);
            $data['personal_picture'] = $personal_picture_path;
        }

        return $this->repo->update($author, $data);
    }

    public function delete(Author $author): bool
    {
        if ($author->personal_picture) {
            $this->fileService->deleteFile('public',$author->personal_picture);
        }

        return $author->delete();
    }
}