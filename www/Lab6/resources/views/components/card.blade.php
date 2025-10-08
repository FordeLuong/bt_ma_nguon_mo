<div style="border:1px solid #e5e7eb; padding:12px; border-radius:12px; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
  <h3 style="margin-top:0">@isset($title){{ $title }}@endisset</h3>
  <div>
    {{ $slot }}
  </div>
</div>
