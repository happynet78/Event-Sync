<div class="space-y-8">
    <!-- Color Selected -->
    <div>
        <h2 class="text-sm font-medium text-gray-900">Color</h2>
        <div class="mt-4 flex items-center space-x-3">
            @foreach($colorVariants as $id => $variant)
                <button
                    type="button"
                    wire:click="selectColor('{{ $id }})"
                    class="relative h-8 w-8 rounded-full border border-gray-300 p-0.5
                        @if($selectedColor === $id) ring-2 ring-indigo-500 @endif">
                    <span
                        class="block h-full w-full rounded-full"
                        style="background-color: {{ $variant['color'] }};"></span>
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

    <!-- Children Option  -->
    @if($selectedOptions && $childrenVariants->isNotEmpty())
        <div class="space-y-4">
            @foreach($childrenVariants as $id => $variant)
                <div>
                    <h3 class="text-sm font-medium text-gray-900">{{ $variant['label'] }}</h3>
                    <div class="mt-2 grid grid-cols-4 gap-2 sm:grid-cols-6">
                        @foreach($variant['children'] ?? [] as $childId => $child)
                            <button
                                class="flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase sm:flex-1"
                                :class="{
                                    'border-transparent bg-indigo-600 text-white hover;bg-indigo-700':
                                        '{{ $selectedOptions[$id] ?? '' }}' === '{{ $childId }}',
                                    'border-gray-200 bg-white text-gray-900 hover:bg-gray-50':
                                        '{{ $selectedOptions[$id] ?? '' }}' !== '{{ $childId }}'
                            }">
                                <span>{{ $childId['label'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Nested Variant Selector (e.g. Range Options) -->
    @if($selectedColor && isset($product->variants[$selectedColor]['children']))
        <div>
            @php
                // Optionally, infer a group label from the first child's type.
                $childGroup = $product->variants[$selectedColor]['children'];
                $groupType = count($childGroup)
                    ? (reset($childGroup['type'] ?? 'Options'))
                    : 'Options';
            @endphp
            <h3 class="text-sm font-medium text gray-900">{{ $groupType }}</h3>

            <!-- Include the recursive partial.
                 The first level uses the selected color's children.
                 The "parent key" for this level is the selected color ID. -->
            @include('livewire.components.variant-tree', [
                'variants' => $product->variants[$selectedColor]['children'],
                'parentKey' => $selectedColor
            ])
        </div>
    @endif

    <!-- (Optional) Add to Basket button -->
    @if($selectedColor)
        <form class="mt-6">
            <div class="mt-10 flex">
                <button type="submit"
                        {{ $selectedColor ? '' : 'disabled' }}
                        class="flex { $selectedColor ? 'cursor-not-allowed' : '' } max-w-xs flex-1 items-center justify-center rounded-md border border-transparent bg-indigo-600 px-5 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50 sm:w-full">
                    Add to Basket
                </button>
            </div>
        </form>
    @endif

    <!-- Price display -->
    @if($this->product->price)
        <div class="mt-4 text-2xl font-bold text-gray-900">
            {{ Number::currency($this->product->price / 100) }}
        </div>
    @endif
</div>
