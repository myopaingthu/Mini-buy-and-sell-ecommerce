<div class="list-group">
  
    @foreach ($categories as $category)
        
    
    <a href="{{ route('categories.show', $category->id) }}" 
      class="list-group-item list-group-item-action list-group-item-dark {{ (request()->is('categories/'.$category->id)) ? 'active' : '' }}" >
      {{$category->name}}<span class="badge badge-secondary float-right">{{$category->products_count}}</span> 
    </a>
    @endforeach
  
</div>