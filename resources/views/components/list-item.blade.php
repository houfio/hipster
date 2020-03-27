<li class="list-group-item d-flex justify-content-between align-items-center">
  {{ $slot }}
  @if($actions ?? true)
    <div class="btn-group">
      {{ isset($extra) ? $extra : '' }}
      @if(isset($delete))
        <x-form-button :id="'delete-form-' . $id" type="light" :duskSelector="($duskSelector ?? '') . '_delete'">
          {{ $deleteLabel ?? 'Delete' }}
        </x-form-button>
      @endif
      @if(isset($edit))
        <a href="{{ $edit }}" dusk="{{ $duskSelector ?? '' }}" class="btn btn-primary">
          {{ $editLabel ?? 'Edit' }}
        </a>
      @endif
    </div>
    @if(isset($delete))
      <form id="delete-form-{{ $id }}" method="post" action="{{ $delete }}" class="d-none">
        @csrf
        @method('delete')
      </form>
    @endif
  @endif
</li>
