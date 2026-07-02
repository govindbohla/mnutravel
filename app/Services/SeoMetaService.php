<?php

namespace App\Services;

use App\Models\Page;
use App\Models\Service;
use App\Models\TourPackage;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SeoMetaService
{
    /**
     * Maps the short URL type used by the SEO Manager to its model class.
     */
    public const TYPES = [
        'page' => Page::class,
        'vehicle' => Vehicle::class,
        'service' => Service::class,
        'tour-package' => TourPackage::class,
    ];

    public function allSeoables(): Collection
    {
        return collect(self::TYPES)->flatMap(function (string $modelClass, string $type) {
            return $modelClass::query()->with('seoMeta')->get()->map(fn (Model $model) => [
                'type' => $type,
                'type_label' => str($type)->headline(),
                'id' => $model->id,
                'label' => $model->name ?? $model->title,
                'has_seo' => (bool) $model->seoMeta,
            ]);
        })->values();
    }

    public function findModel(string $type, int $id): Model
    {
        $modelClass = self::TYPES[$type] ?? abort(404);

        return $modelClass::query()->with('seoMeta')->findOrFail($id);
    }

    public function update(Model $model, array $data): void
    {
        $model->seoMeta()->updateOrCreate([], $data);
    }
}
