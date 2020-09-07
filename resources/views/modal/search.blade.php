<form action="{{ route('search.result') }}" method="get">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Поиск</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Закрить">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <input type="hidden" name="folder_id" value="{{ $folder->id }}">
        <div class="form-group mb-4">
            <label for="title">File title <span class="text-success"><i>*</i></span></label>
            <input type="text" title="Ixtiyoriy" id="title" name="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="form-group mb-4">
            <label for="document_author">Author <span class="text-success"><i>*</i></span></label>
            <input type="text" id="document_author" title="Ixtiyoriy" name="document_author" class="form-control" value="{{ old('document_author') }}">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category_id">Category <span class="text-success"><i>*</i></span></label>
                    <select class="form-control" title="Ixtiyoriy" name="category_id" id="category_id">
                        <option value="">Kategoriyani tanlang</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="form-group">
                    <label for="type_id">Type <span class="text-success"><i>*</i></span></label>
                    <select class="form-control" name="type_id" title="Ixtiyoriy" id="type_id">
                        <option value="">Hujjat tipni tanlang</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="document_number">Document number <span class="text-success"><i>*</i></span></label>
                    <input type="text" id="document_number" title="Ixtiyoriy" name="document_number" class="form-control" value="{{ old('document_number') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="document_date">Document date <span class="text-success"><i>*</i></span></label>
                    <input type="date" id="document_date" title="Ixtiyoriy" name="document_date" class="form-control" value="{{ old('document_date') }}">
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label for="document_description">Description <span class="text-success"><i>*</i></span></label>
            <textarea id="document_description" name="document_description" title="Ixtiyoriy" class="form-control">{{ old('document_description') }}</textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
        <button type="submit" class="btn btn-primary">Поиск</button>
    </div>
</form>
