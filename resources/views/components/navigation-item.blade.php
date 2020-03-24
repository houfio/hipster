<li class="nav-item{{ Request::is($path) ? ' active' : '' }}">
  <a class="nav-link" href="{{ url($path) }}" {{ $attributes }}>
    {{ $slot  }}
  </a>
</li>
