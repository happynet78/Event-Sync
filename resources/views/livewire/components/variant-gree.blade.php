@props(['variants', 'parentKey'])

@if(count($variants) > 0)
    <!-- REnder the options in a responsive grid -->
    <div class="mt-2 grid grid-cols-4 gap-2 sm:grid-cols-6">
        @foreach($variants as $variantId => $variant)
            <button
                type="button"
                wire:click="$set('selectedOptions.{{ $parentKey }}', '{{ $variantId }}')"
                class="flex items-center justify-center rounded-md border py-3 px-4 font-medium uppercase sm:flex-1
                @if(($selectOptions[$parentKey] ?? '') === $variantId)
                    border-transparent bg-indigo-600 text-white hover:bg-indigo-700
                @else
                    border-gray-200 bg-white text-gray-900 hover:bg-gray-50
                @endif"
            >
                <span>{{ $variant['label'] }}</span>
            </button>
        @endforeach
    </div>

    @php
        // Retrieve the selected option's ID at the current level
        $selectedVariantId = $selectOptions[$parentKey] ?? null;
    @endphp

    <!-- If the selected option has further children, recursively render them -->
    @if($selectedVariantId && isset($variants[$selectedVariantId]['children']) && is_array($variants[$selectedVariantId]['children']))
        @php
            $nestedVariants = $variants[$selectedVariantId]['children']
        @endphp
        <!-- If there are any nested options, display them -->
        @if(count($nestedVariants) > 0)
            <div class="mt-4 ml-4">
                @php
                    // Optionally, infer a label from the nested option type.
                    $groupType = count($nestedVariants) ? (reset($nestedVariants)['type'] ?? 'Options') : 'Options';
                @endphp
                <div class="text-sm font-medium text-gray-900">Select {{ $groupType }}</div>

                @include('livewire.components.variant-type', [
                    'variants' => $nestedVariants,
                    '$parentKey' => $selectedVariantId
                ])
            </div>
        @endif
    @endif
@endif
