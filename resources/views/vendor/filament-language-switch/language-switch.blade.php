@php
    use Illuminate\Support\Str;

    // Config and Current State Variables
    $currentLocale = app()->getLocale();
    $locales = config('filament-language-switch.locales');
    $showFlags = config('filament-language-switch.flag');
    $currentFlag = $locales[$currentLocale]['flag_code'];
    $useNativeNames = config('filament-language-switch.native');
    $directionIsRtl = __('filament::layout.direction') === 'rtl';

    // Trigger Button
    $localeIsLong = Str::of($currentLocale)->length() > 2;
    $triggerText = $localeIsLong
        ? Str::of($currentLocale)->substr(0, 2)->upper()
        : Str::of($currentLocale)->upper();

    $triggerClasses = $directionIsRtl ? ['mr-4'] : ['ml-4'];
@endphp

<x-filament::dropdown placement="bottom-end">
    <style>
        .filament-dropdown-list-item-label {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
    </style>
    <x-slot name="trigger" @class($triggerClasses)>
        <div
            class="flex items-center justify-center px-3 gap-2 h-10 font-semibold text-white bg-center bg-cover rounded-md language-switch-trigger bg-primary-500 dark:bg-gray-700">
            @if ($showFlags)
                <x-dynamic-component :component="'flag-1x1-' . $currentFlag"
                    class="flex-shrink-0 w-5 h-5 group-hover:text-white group-focus:text-white text-primary-500"
                    style="border-radius: 0.25rem" />
                {{ $triggerText }}
            @else
                {{ $triggerText }}
            @endif
        </div>
    </x-slot>
    <x-filament::dropdown.list class="">
        @foreach ($locales as $key => $locale)
            @if ($currentLocale !== $key)
                @php
                    $flagCode = !blank($locale['flag_code']) ? $locale['flag_code'] : 'un';
                    $localeDisplayName = $useNativeNames ? $locale['native'] : $locale['name'];

                    $initialsArray = Str::of($locale['name'])->snake()->upper()->explode('_');
                    $localeInitials = Str::of($locale['name'])->wordCount() > 1
                        ? $initialsArray->map(fn($string) => Str::substr($string, 0, 1))->take(2)->implode('')
                        : $initialsArray->map(fn($string) => Str::substr($string, 0, 2))->take(2)->implode('');

                    $localeNameHeadline = Str::of($localeDisplayName)->headline();
                @endphp

                <x-filament::dropdown.list.item wire:click="changeLocale('{{ $key }}')" tag="button">
                    @if ($showFlags)
                        <span>
                            <x-dynamic-component :component="'flag-1x1-' . $flagCode"
                                class="flex-shrink-0 w-5 h-5 mr-4 rtl:ml-4 group-hover:text-white group-focus:text-white text-primary-500"
                                style="border-radius: 0.25rem" />
                        </span>
                    @else
                        <span
                            class="w-6 h-6 flex items-center justify-center mr-4 flex-shrink-0 rtl:ml-4 bg-primary-500/10 text-primary-600 font-semibold rounded-full p-1 text-xs">
                            {{ $localeInitials }}
                        </span>
                    @endif
                    <span class="hover:bg-transparent">
                        {{ $localeNameHeadline }}
                    </span>
                </x-filament::dropdown.list.item>
            @endif
        @endforeach

    </x-filament::dropdown.list>
</x-filament::dropdown>