@extends('layouts.app', ['activePage' => 'files', 'titlePage' => __('Files')])

@section('content')
    <style>
        ul, #myUL {
            list-style-type: none;
        }

        #myUL {
            margin: 0;
            padding: 0;
        }

        .caret {
            cursor: pointer;
            -webkit-user-select: none; /* Safari 3.1+ */
            -moz-user-select: none; /* Firefox 2+ */
            -ms-user-select: none; /* IE 10+ */
            user-select: none;
        }

        .caret::before {
            content: "\25B6";
            color: #ffc700;
            display: inline-block;
            margin-right: 6px;
        }

        .caret-down::before {
            -ms-transform: rotate(90deg); /* IE 9 */
            -webkit-transform: rotate(90deg); /* Safari */'
        transform: rotate(90deg);
        }

        .nested {
            display: none;
        }

        .active {
            display: block;
        }

        .material-icons.classic{
            color: #ffc700;
            font-size: 70px;
            margin-left: 60px;
        }

        @media (max-width: 1500px){
            .material-icons.classic{
                margin-left: 20px;
            }
            .files-tree-box{
                border-bottom: 1px solid #ffc700;
            }
            #myUL{
                padding: 10px;
                text-align: center;
            }
        }
        @media (min-width: 1500px){
            .files-tree-box{
                border-right: 1px solid #ffc700;
            }
        }
    </style>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Material Dashboard Heading</h4>
                    <p class="card-category">Created using Roboto Font Family</p>
                </div>
                <div class="card-body">
                    <div id="typography">
                        <div class="card-title">
                           <div class="row">
                               <div class="col-6">
                                   <h2><i style="color: #ffc700;" class="material-icons">folder_open</i> <b>Archive</b></h2>
                               </div>
                               <div class="col-6">
                                   <h2 class="text-right">
                                       <a href="{{ route('files.index') }}" class="btn btn-primary" rel="tooltip" title="Загрузить">
                                           <i style="font-size: 30px" class="material-icons">cloud_upload</i>
                                       </a>
                                   </h2>
                               </div>
                           </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 files-tree-box">
                                <ul id="myUL">
                                    <li><a href="#" data-toggle="modal" data-target=".bd-example-modal-sm">&#x2b; Create new</a></li>
                                    @foreach($folders as $folder)
                                        <li><span class="caret"> {{ $folder->title }}</span>
                                            <ul class="nested">
                                                <li><a href="#" class="parent_folder" data-parent="{{ $folder->id }}" data-toggle="modal" data-target=".bd-example-modal-sm">&#x2b; Create new</a></li>
                                                @foreach($folder->children as $file)
                                                    <li>{{ $file->title }}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-10">
                                <p>File upload</p>
                                <hr>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('files.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-group">
                                            <select name="folder_id" class="form-control" id="">
                                                <option value="">Select folder</option>
                                                @foreach ($collection_folders as $item)
                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="upload" rel="tooltip" title="Загрузить">
                                            <span style="font-size: 40px" class="material-icons">cloud_upload</span>
                                            <p>Добавить файл</p>
                                        </label>
                                        <input type="file" multiple name="files[]" id="upload">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Загрузить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Small modal -->

    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('folders.store') }}" class="container folder_modal" method="post">
                    @csrf
                    <input type="hidden" id="hidden_method" name="_method" value="post">
                    <input type="hidden" id="hidden_parent" name="parent_id" value="">
                    <div class="form-group">
                        <input id="folder_title" type="text" name="title" class="form-control" placeholder="Folder name">
                    </div>
                    <div class="float-right">
                        <button class="btn btn-success btn-sm" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <script>
            var toggler = document.getElementsByClassName("caret");
            var i;

            for (i = 0; i < toggler.length; i++) {
                toggler[i].addEventListener("click", function() {
                    this.parentElement.querySelector(".nested").classList.toggle("active");
                    this.classList.toggle("caret-down");
                });
            }
        </script>

        @push('js')
            <script>
                $(function () {
                    $('.rename').on("click", function () {
                        var url = $(this).attr('data-url')
                        var title = $(this).attr('data-title')
                        $('.folder_modal').attr("action", url);
                        $('.folder_modal').find("#hidden_method").val('put');
                        $('#folder_title').empty().val(title)
                    });
                    $('.parent_folder').on("click", function () {
                        var parent_id = $(this).attr('data-parent');
                        $('#folder_title').val('');
                        $('.folder_modal').find("#hidden_parent").val(parent_id);
                    });
                });
            </script>
        @endpush
@endsection
