@foreach ($ajax_lokasi as $d)
        <input type='text' size="3" name='id_lokasi[]' id='id_lokasi' value="{{ $d->ID_LOKASI }}" readonly required >
@endforeach