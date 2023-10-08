@foreach ($ajax_keterangan as $d)
        <input type='text' size="10" name='keterangan[]' id='keterangan' value="{{ $d->keterangan }}" >
@endforeach