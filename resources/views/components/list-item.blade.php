<li class="list-group-item d-flex justify-content-between align-items-center">
  {{ $slot }}
  <div class="btn-group">
    <x-form-button :id="'delete-form-' . $id" type="light">Delete</x-form-button>
    <a href="{{ $edit }}" class="btn btn-primary">Edit</a>
  </div>
  <form id="delete-form-{{ $id }}" method="post" action="{{ $delete }}" class="d-none">
    @csrf
    @method('delete')
  </form>
</li>
