<div class="space-y-8">
    <!-- Color Selected -->
    <div>
        <h2 class="text-sm font-medium text-gray-900">Color</h2>
        <div class="mt-4 flex items-center space-x-3">
            @foreach($colorVariants as $id => $variant)
                <button type="button" wire:click="selectColor('{{ $id }}')"
                    class="relative h-8 w-8 rounded-full border border-gray-300 p-0.5"
                    :class="{ 'ring-2 ring-indigo-500': '{{ $selectedColor }}' === '{{ $id }}'">
                    <span class="block h-full w-full rounted-full" style="background-color: {{ variant['color'] }}"></span>
                    <span class="sr-only">{{ $variant['label'] }}</span>
                </button>
            @endforeach
        </div>
        @if($selectedColor)
            <p class="mt-2 text-sm text-gray-500">
                Selected: {{ $colorVariants[$selectedColor]['label'] }}
            </p>
        @endif
    </div>

    <div class="space-y-8">
        @if($selectedColor && $childrenVariants->isNotEmpty())
            <div class="space-y-4">
                @foreach($childrenVariants as $id => $variant)
                    <div>
                        <h3 class="text-sm font-medium text-gray-900">{{ $variant['label'] }}</h3>
                        <div class="mt2 grid grid-cols-4 gap-2 sm:grid-cols-6">
                            @foreach($variant['children'] ?? [] as $childId => $child)
                                <button type="button"
                                    wire:click="$set('selectedOptions.{{$id}}', '{{ $childId }}')"
                                    class="flex items-center justify-center rouned-md py-3 px-4 text-sm font-medium uppercase sm:flex"
                                    :class="{
                                        'border-transparent bg-indigo-600 text-white hover:bg-indigo-700': '{{ $selectedOptions[$id] ?? '' }}' === '{{ $childId }}',
                                        'border-gray-200 bg-white text-gray-900 hover:bg-gray-50': '{{ $selectedOptions[$id] ?? '' }}' !== '{{ $childId }}'
                                    }">
                                    <span>{{ $child['label'] }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
