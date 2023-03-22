    <option value="" disabled selected>SIZE</option>
    @foreach ($get_idpo_variation as $vars)
        <option data-qty="{{ $vars->qty }}" value="{{ $vars->size }}">{{ $vars->size }} = {{ $vars->qty }}
        </option>
    @endforeach
