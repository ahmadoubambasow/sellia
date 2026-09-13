@props([
    'value' => null,
    'label' => 'vs période précédente',
])

@if($value === null)

    <p class="mt-2 text-xs font-medium text-slate-400">
        Nouveau chiffre d'affaires
    </p>

@elseif($value > 0)

    <p class="mt-2 flex items-center gap-1 text-xs font-semibold text-emerald-600">
        <svg
            class="h-4 w-4"
            viewBox="0 0 20 20"
            fill="currentColor"
            aria-hidden="true"
        >
            <path
                fill-rule="evenodd"
                d="M10 3a1 1 0 01.707.293l5 5a1 1 0 01-1.414 1.414L11 6.414V16a1 1 0 11-2 0V6.414L5.707 9.707a1 1 0 01-1.414-1.414l5-5A1 1 0 0110 3z"
                clip-rule="evenodd"
            />
        </svg>

        +{{ number_format($value, 1, ',', ' ') }} %
        <span class="font-normal text-slate-400">
            {{ $label }}
        </span>
    </p>

@elseif($value < 0)

    <p class="mt-2 flex items-center gap-1 text-xs font-semibold text-red-600">
        <svg
            class="h-4 w-4"
            viewBox="0 0 20 20"
            fill="currentColor"
            aria-hidden="true"
        >
            <path
                fill-rule="evenodd"
                d="M10 17a1 1 0 01-.707-.293l-5-5a1 1 0 011.414-1.414L9 13.586V4a1 1 0 112 0v9.586l3.293-3.293a1 1 0 011.414 1.414l-5 5A1 1 0 0110 17z"
                clip-rule="evenodd"
            />
        </svg>

        {{ number_format($value, 1, ',', ' ') }} %
        <span class="font-normal text-slate-400">
            {{ $label }}
        </span>
    </p>

@else

    <p class="mt-2 text-xs font-semibold text-slate-500">
        0 % {{ $label }}
    </p>

@endif