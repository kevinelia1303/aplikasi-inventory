@foreach ($ajax_tanggal as $d)
        <input type='text' size="10" name='Tanggal[]' id='Tanggal' value="{{ $d->Tanggal }}" readonly required >
@endforeach