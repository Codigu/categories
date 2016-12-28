<ul>
@foreach($categories as $category)
    <li>
        <a href="{{ url('category/'.$category->id.'/posts') }}">{{ $category->name }}</a>
    </li>
@endforeach
</ul>