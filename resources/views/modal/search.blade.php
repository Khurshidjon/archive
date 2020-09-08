<form action="{{ route('search.result') }}" class="mt-1" method="get">
    <div class="row" style="border: 1px solid lightgrey">
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Маълумот даражасини танланг</label>
                <select name="category_id" class="form-control select2" id="">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id==$category_selected?'selected':'' }}>{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Маълумот турини танланг</label>
                <select name="type_id" class="form-control select2" id="">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ $type==$type_selected?'selected':'' }}>{{ $type->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" style="margin-top: 30px" placeholder="Муаллиф" value="{{ $author }}" id="" name="document_author" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Маълумот тилини танланг</label>
                <select name="language_id" class="form-control select2" id="">
                    @foreach($languages as $language)
                        <option value="{{ $language->id }}" {{ $language->id==$language_selected?'selected':'' }}>{{ $language->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" style="margin-top: 30px" placeholder="Номланиши" id="" name="title" value="{{ $title }}" class="form-control">
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="mt-4 float-right btn btn-primary btn-sm"><span class="material-icons">search</span> Қидириш</button>
        </div>
    </div>
</form>
