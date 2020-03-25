<option value="{{ $value }}" @if($current === $value) selected @endif>
  {{ $slot }}
</option>
