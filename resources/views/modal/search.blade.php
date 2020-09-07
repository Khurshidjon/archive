<form action="{{ route('search.result') }}" class="mt-1" method="get">
    <div class="row" style="border: 1px solid lightgrey">
        <div class="col-md-3">
            <div class="form-group">
                <select name="category_id" class="form-control" id="category_id">
                    <option value="">Маълумот даражасини танланг</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <select name="type_id" class="form-control" id="type_id">
                    <option value="">Маълумот турини танланг</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" style="margin-top: 13px" placeholder="Номланиши" id="title" name="title" class="form-control">
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Қидириш</button>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <select name="language_id" class="form-control" id="language_id">
                    <option value="">Маълумот тилини танланг</option>
                    @foreach($languages as $language)
                        <option value="{{ $language->id }}">{{ $language->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</form>
