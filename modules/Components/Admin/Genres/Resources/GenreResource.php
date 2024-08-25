<?php

namespace Modules\Components\Admin\Genres\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GenreResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'logo' => config('general.default_files_path_url') . $this->logo,
            'parent' => [
                'id' => $this->parent_id ?? null,
                'title' => $this->resource->parent->title ?? null,
            ],
        ];
    }
}
