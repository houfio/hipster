<button
  class="btn btn-{{ $type }}"
  onclick="event.preventDefault(); document.getElementById('{{ $id }}').submit()"
  {{ $attributes }}
>
  {{ $slot }}
</button>
