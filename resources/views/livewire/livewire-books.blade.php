<div class="container" style="margin-top: 5px;">
    <form>
        <div class="input-group">
            <input class="form-control" type="text" wire:model="searchTerm" name="search" placeholder="ابحث عن اسم الكتاب او الكاتب" style="width: 300px;">
            <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                    <i class="glyphicon glyphicon-search" name="btn-submit">ابحث</i>
                </button>
            </div>
        </div>
    </form><br>
    <ul class="list-group">
        @if ($books)
            @foreach ($books as $book)
            <li class="list-group-item"><a href="{{$book->id}}">{{$book->title}}</a></li>
            @endforeach
        @endif
    </ul>
</div>
