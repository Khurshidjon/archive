<div class="modal-content">
    <form action="{{ route('files.store') }}" method="post" enctype="multipart/form-data">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Закрить">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @csrf
            <div class="container">
                <div class="form-group">
                    <input type="hidden" name="folder_id" value="{{ $folder->id }}">
                    <div class="uploader-form-box">
                        <label for="uploader" id="uploader-label">
                            <div class="uploader-form-left">
                                <span>Iltimos, yuklash uchun faylni tanlang</span>
                            </div>
                            <div class="uploader-form-right">
                                <span>Fayl tanlash</span>
                            </div>
                            <input type="file" name="file_name" class="uploader-file" id="uploader">
                        </label>
                    </div>
                    <ul class="uploader-text-box list-group">
                        <li class="list-group-item">
                            <p id="uploader-text"></p>
                        </li>
                    </ul>
                    @if ($errors->has('file_name'))
                        <div id="file_name-error" class="error text-danger pl-3" for="file_name" style="display: block; margin-top: -35px">
                            <strong><small>{{ $errors->first('file_name') }}</small></strong>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="title">File title <span class="text-danger"><i>*</i></span></label>
                            <input type="text" title="Majburiy" id="title" name="title" class="form-control" value="{{ old('title') }}">
                            @if ($errors->has('title'))
                                <div id="title-error" class="error text-danger pl-3" for="title" style="display: block;">
                                    <strong><small>{{ $errors->first('title') }}</small></strong>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="document_author">Author <span class="text-success"><i>*</i></span></label>
                            <input type="text" id="document_author" title="Ixtiyoriy" name="document_author" class="form-control" value="{{ old('document_author') }}">
                            @if ($errors->has('document_author'))
                                <div id="document_author-error" class="error text-danger pl-3" for="document_author" style="display: block;">
                                    <strong>{{ $errors->first('document_author') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="category_id">Category <span class="text-success"><i>*</i></span></label>
                            <select class="form-control select2" title="Ixtiyoriy" name="category_id" id="category_id">
                                <option value="">Kategoriyani tanlang</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <div id="category_id-error" class="error text-danger pl-3" for="category_id" style="display: block;">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="type_id">Type <span class="text-success"><i>*</i></span></label>
                            <select class="form-control select2" name="type_id" title="Ixtiyoriy" id="type_id">
                                <option value="">Hujjat tipni tanlang</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->title }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('type_id'))
                                <div id="type_id-error" class="error text-danger pl-3" for="type_id" style="display: block;">
                                    <strong>{{ $errors->first('type_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="document_number">Document number <span class="text-success"><i>*</i></span></label>
                                <input type="text" id="document_number" title="Ixtiyoriy" name="document_number" class="form-control" value="{{ old('document_number') }}">
                                @if ($errors->has('document_number'))
                                    <div id="document_number-error" class="error text-danger pl-3" for="document_number" style="display: block;">
                                        <strong>{{ $errors->first('document_number') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="document_date">Document date <span class="text-success"><i>*</i></span></label>
                                <input data-date-format="dd/mm/yyyy" id="document_date" title="Ixtiyoriy" name="document_date" class="form-control" value="{{ old('document_date') }}">
                                @if ($errors->has('document_date'))
                                    <div id="document_date-error" class="error text-danger pl-3" for="document_date" style="display: block;">
                                        <strong>{{ $errors->first('document_date') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="document_description">Description <span class="text-success"><i>*</i></span></label>
                    <textarea id="document_description" name="document_description" title="Ixtiyoriy" class="form-control">{{ old('document_description') }}</textarea>
                    @if ($errors->has('document_description'))
                        <div id="document_description-error" class="error text-danger pl-3" for="document_description" style="display: block;">
                            <strong>{{ $errors->first('document_description') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="language_id">Маълумот тилини танланг</label>
                            <select name="language_id[]" multiple class="form-control select2" id="language_id">
                                @foreach($languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
            <button type="submit" class="btn btn-primary">Загрузить</button>
        </div>
    </form>

</div>
