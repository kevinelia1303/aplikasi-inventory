@foreach ($ajax_barang as $d)
        <input type='text' size="5" value="{{ $d->JUMLAH }}" name='jumlah[]' id='jumlah" +baris+"' required>
@endforeach