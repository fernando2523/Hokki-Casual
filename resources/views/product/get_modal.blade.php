<option value="" disabled selected>Pilih Harga Modal</option>
@foreach ($get_modal as $data)
    <option value="{{ $data->m_price }}">@currency($data->m_price) ({{ $data->tanggal }})</option>
@endforeach
