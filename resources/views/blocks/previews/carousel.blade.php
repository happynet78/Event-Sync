<div>
    @foreach($images as $image)
        <img src="/storage/{{ $image['image'] }}" class="w-32" alt="">
    @endforeach
</div>
