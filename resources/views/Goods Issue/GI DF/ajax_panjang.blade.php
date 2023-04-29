@foreach ($ajax_barang as $d)
        <input type='text' size="5" value="{{ $d->total_Panjang }}" name='jumlah[]' id='jumlah" +baris+"' required>
@endforeach