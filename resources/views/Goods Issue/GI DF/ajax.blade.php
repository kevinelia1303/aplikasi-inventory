@foreach ($ajax_barang as $d)
        <input type='text' size="45" name='id_barang[]' id='id_barang' value="{{ $d->id_barang }}" readonly required >
@endforeach