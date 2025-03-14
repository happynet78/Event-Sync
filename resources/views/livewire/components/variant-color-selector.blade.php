<div>
    <h3 class="text-sm font-medium text-gray-900">{{ $variant['label'] }}</h3>
    <div class="mt-">
        <button
            type="button"
            wire:click="$parent.selectVariant('{{ $variantId }}', '{{ $variant['label'] }}')"
            class="relative h-8 w-8 rounded-full border border-gray-300 p-0 5"
            :class="{ 'ring-2 rint-indigo-500': {{ $isSelected ? 'true':'false' }} }">
            <span class="block h-full w-full rouned-full" style="background-color: {{ $variant['color'] }};"></span>
            <span class="sr-only">{{ $variant['label'] }}</span>
        </button>
    </div>
</div>
