@props(['type' => 'info', 'dismissible' => true, 'icon' => null])
<div {{ $attributes->merge([
    'class' => "border-l-4 p-4 {$this->backgroundClass()
        }"
]) }} role="alert">
    <div class="flex items-center">
        @if($icon !== false)
            <i class="{{ $this->iconClass() }} mr-3 text-lg"></i>
        @endif
        <div class="flex-1">
            {{ $slot }}
        </div>
        @if($dismissible)
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg focu
            s:ring-2 p-1.5 inline-flex items-center justify-center h-8 w-8 hover:bg-gray-100
            " data-dismiss="alert" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <i class="fas fa-times"></i>
                    </button>
        @endif
    </div>
</div>