<div>
    <x-mary-carousel :slides="array_map(function ($item) {
            return [
                'image' => '/storage/' . $item['image']
            ];
        }, $images)"/>
</div>
