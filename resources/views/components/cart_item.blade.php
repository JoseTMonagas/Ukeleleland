@if ($item->model instanceof \App\Asset)
    <div class="container">
        <div class="row @if(!($loop->last)) border-bottom @endif p-2">
            <div class="col">
                <img src="{{ $item->model->getImg() }}" class="img-fluid" style="max-height:12rem" alt=""/>
            </div>
            <div class="col">
                <h5 class="text-primary text-center border-bottom">{{ $item->model->title }}</h5>
                <p class="text-muted text-center">{{ $item->model->displayPrice }}</p>
                <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-outline-danger border-0"><i class="fas fa-backspace"></i></button>
                </form>
            </div>
        </div>
    </div>
@else
    <div class="container">
        <div class="row @if(!($loop->last)) border-bottom @endif p-2">
            <div class="col">
                <img src="{{ $item->model->displayImg }}"style="max-height:12rem" class="img-fluid" alt=""/>
            </div>
            <div class="col">
                <h5 class="text-primary text-center border-bottom">{{$item->model->name}}</h5>
                <p class="text-muted text-center">{{ $item->model->displayPrice }}</p>
                <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-outline-danger border-0"><i class="fas fa-backspace"></i></button>
                </form>
            </div>
        </div>
    </div>
@endif
