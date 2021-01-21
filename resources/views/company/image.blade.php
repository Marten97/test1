@if ($logo)
    <img src="{{ Storage::url($logo) }}" height="75" width="75" alt="" />
@else
    <img src="https://www.riobeauty.co.uk/images/product_logo_not_found.gif" alt="" height="75" width="75">
@endif
