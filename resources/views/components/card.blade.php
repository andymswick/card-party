@props(['card', 'index', 'editMode'])

@if(isset($index))
@if($editMode)
<button type="button" wire:click="select({{ $index }})" {{ $attributes->merge(['class' => 'card']) }}>
    @if($card['value'] === 'joker' && $card['suit'] === 'heart')
    <x-cards.value :value="$card['value']" class="w-8 h-8 text-red-600 mb-1" />
    @elseif($card['value'] === 'joker' && $card['suit'] === 'spade')
    <x-cards.value :value="$card['value']" class="w-8 h-8 text-gray-800 mb-1" />
    @elseif($card['suit'] === 'diamond' || $card['suit'] === 'heart')
    <x-cards.value :value="$card['value']" class="w-8 h-8 text-red-600 mb-1" />
    <x-cards.suit :suit="$card['suit']" class="w-8 h-8 text-red-600" />
    @else
    <x-cards.value :value="$card['value']" class="w-8 h-8 text-gray-800 mb-1" />
    <x-cards.suit :suit="$card['suit']" class="w-8 h-8 text-gray-800" />
    @endif
</button>
@else
<button type="button" wire:click="discard({{ $index }})" {{ $attributes->merge(['class' => 'card']) }}>
    @if($card['value'] === 'joker' && $card['suit'] === 'heart')
    <x-cards.value :value="$card['value']" class="w-8 h-8 text-red-600 mb-1" />
    @elseif($card['value'] === 'joker' && $card['suit'] === 'spade')
    <x-cards.value :value="$card['value']" class="w-8 h-8 text-gray-800 mb-1" />
    @elseif($card['suit'] === 'diamond' || $card['suit'] === 'heart')
    <x-cards.value :value="$card['value']" class="w-8 h-8 text-red-600 mb-1" />
    <x-cards.suit :suit="$card['suit']" class="w-8 h-8 text-red-600" />
    @else
    <x-cards.value :value="$card['value']" class="w-8 h-8 text-gray-800 mb-1" />
    <x-cards.suit :suit="$card['suit']" class="w-8 h-8 text-gray-800" />
    @endif
</button>
@endif
@else
<button type="button" {{ $attributes->merge(['class' => 'card']) }}>
    @if($card['value'] === 'joker' && $card['suit'] === 'heart')
    <x-cards.value :value="$card['value']" class="w-8 h-8 text-red-600 mb-1" />
    @elseif($card['value'] === 'joker' && $card['suit'] === 'spade')
    <x-cards.value :value="$card['value']" class="w-8 h-8 text-gray-800 mb-1" />
    @elseif($card['suit'] === 'diamond' || $card['suit'] === 'heart')
    <x-cards.value :value="$card['value']" class="w-8 h-8 text-red-600 mb-1" />
    <x-cards.suit :suit="$card['suit']" class="w-8 h-8 text-red-600" />
    @else
    <x-cards.value :value="$card['value']" class="w-8 h-8 text-gray-800 mb-1" />
    <x-cards.suit :suit="$card['suit']" class="w-8 h-8 text-gray-800" />
    @endif
</button>
@endif