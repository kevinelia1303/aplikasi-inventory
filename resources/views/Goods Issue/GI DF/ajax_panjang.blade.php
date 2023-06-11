@foreach ($ajax_barang as $d)
        <input type='text' size="5" value="{{ $d->jumlah }}" name='jumlah[]' id='jumlah" +baris+"' required>
@endforeach