<button
  class="btn btn-{{ $type }}"
  onclick="event.preventDefault(); document.getElementById('{{ $id }}').submit()"
>
  {{ $slot }}
</button>
