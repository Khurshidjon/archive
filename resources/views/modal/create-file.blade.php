<form action="{{ route('files.store') }}" method="post" enctype="multipart/form-data">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Закрить">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf
        <div class="form-group">
            <input type="hidden" name="folder_id" value="{{ $folder->id }}">
            <div class="uploader-form-box">
                <label for="uploader" id="uploader-label">
                    <input type="file" name="file_name" class="uploader-file" id="uploader">
                    <div class="uploader-form-left">
                        <span>Iltimos, yuklash uchun faylni tanlang</span>
                    </div>
                    <div class="uploader-form-right">
                        <span>Fayl tanlash</span>
                    </div>
                </label>
            </div>
            <ul class="uploader-text-box list-group">
                <li class="list-group-item">
                    <p id="uploader-text"></p>
                </li>
            </ul>
        </div>
        <div class="form-group mb-4">
            <label for="title">File title <span class="text-danger"><i>*</i></span></label>
            <input type="text" title="Majburiy" id="title" name="title" class="form-control" value="{{ old('title') }}">
            @if ($errors->has('title'))
                <div id="title-error" class="error text-danger pl-3" for="title" style="display: block;">
                    <strong>{{ $errors->first('title') }}</strong>
                </div>
            @endif
        </div>
        <div class="form-group mb-4">
            <label for="document_author">Author <span class="text-success"><i>*</i></span></label>
            <input type="text" id="document_author" title="Ixtiyoriy" name="document_author" class="form-control" value="{{ old('document_author') }}">
            @if ($errors->has('title'))
                <div id="title-error" class="error text-danger pl-3" for="title" style="display: block;">
                    <strong>{{ $errors->first('title') }}</strong>
                </div>
            @endif
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
                    @if ($errors->has('title'))
                        <div id="title-error" class="error text-danger pl-3" for="title" style="display: block;">
                            <strong>{{ $errors->first('title') }}</strong>
                        </div>
                    @endif
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
                    @if ($errors->has('title'))
                        <div id="title-error" class="error text-danger pl-3" for="title" style="display: block;">
                            <strong>{{ $errors->first('title') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="document_number">Document number <span class="text-success"><i>*</i></span></label>
                    <input type="text" id="document_number" title="Ixtiyoriy" name="document_number" class="form-control" value="{{ old('document_number') }}">
                    @if ($errors->has('title'))
                        <div id="title-error" class="error text-danger pl-3" for="title" style="display: block;">
                            <strong>{{ $errors->first('title') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="document_date">Document date <span class="text-success"><i>*</i></span></label>
                    <input type="date" id="document_date" title="Ixtiyoriy" name="document_date" class="form-control" value="{{ old('document_date') }}">
                    @if ($errors->has('title'))
                        <div id="title-error" class="error text-danger pl-3" for="title" style="display: block;">
                            <strong>{{ $errors->first('title') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-12 mt-4">
                <div class="form-group">
                    <select name="language_id" data-placeholder="Begin typing a name to filter..." multiple class="chosen-select">
                        <option value="">Маълумот тилини танланг</option>
                        @foreach($languages as $language)
                            <option value="{{ $language->id }}">{{ $language->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label for="document_description">Description <span class="text-success"><i>*</i></span></label>
            <textarea id="document_description" name="document_description" title="Ixtiyoriy" class="form-control">{{ old('document_description') }}</textarea>
            @if ($errors->has('title'))
                <div id="title-error" class="error text-danger pl-3" for="title" style="display: block;">
                    <strong>{{ $errors->first('title') }}</strong>
                </div>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
        <button type="submit" class="btn btn-primary">Загрузить</button>
    </div>
</form>
