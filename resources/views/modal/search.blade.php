<form action="{{ route('search.result') }}" class="mt-1" method="get">
    <div class="row" style="border: 1px solid lightgrey">
        <div class="col-md-4">
            <div class="form-group">
                <select name="category_id" class="form-control select2" id="category_id">
                    <option value="">Маълумот даражасини танланг</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id==$category_selected?'selected':'' }}>{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <select name="type_id" class="form-control select2" id="type_id">
                    <option value="">Маълумот турини танланг</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ $type==$type_selected?'selected':'' }}>{{ $type->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" style="margin-top: -7px" placeholder="Муаллиф" value="{{ $author }}" id="document_author" name="document_author" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <select name="language_id" class="form-control select2" id="language_id">
                    <option value="">Маълумот тилини танланг</option>
                    @foreach($languages as $language)
                        <option value="{{ $language->id }}" {{ $language->id==$language_selected?'selected':'' }}>{{ $language->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" style="margin-top: -7px" placeholder="Номланиши" id="title" name="title" value="{{ $title }}" class="form-control">
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="mt-4 float-right btn btn-primary btn-sm"><span class="material-icons">search</span> Қидириш</button>
        </div>
    </div>
</form>
