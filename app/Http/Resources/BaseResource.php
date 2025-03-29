<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            ...$this->resourceToArray($request),
        ];
    }

    /**
     * Transform the resource into an array.
     * Override this method in child classes to define specific resource attributes.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    abstract protected function resourceToArray(Request $request): array;
}
