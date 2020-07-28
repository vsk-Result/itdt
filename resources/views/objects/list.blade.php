@foreach($objects->chunk(4) as $chunk_objects)
    <div class="row">
        @each('objects.partials.object_card', $chunk_objects, 'object')
    </div>
@endforeach