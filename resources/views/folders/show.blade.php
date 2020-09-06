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
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#uploadFileModal" rel="tooltip" title="Загрузить">
                                            <i style="font-size: 30px" class="material-icons">cloud_upload</i>
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 files-tree-box">
                                <ul id="myUL">
                                    <li><a href="#" class="create_new_folder" data-toggle="modal" data-target=".bd-example-modal-sm">&#x2b; Create new</a></li>
                                    @foreach($folder->children as $childFolder)
                                        <li><span class="caret"> {{ $childFolder->title }}</span>
                                            <ul class="nested">
                                                <li><a href="#" class="parent_folder" data-parent="{{ $childFolder->id }}" data-toggle="modal" data-target=".bd-example-modal-sm">&#x2b; Create new</a></li>
                                                @foreach($childFolder->children as $child)
                                                    <li>{{ $child->title }}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-10">
                                <hr>
                                <p>Folders</p>
                                <div class="row">
                                    @forelse($folder->children as $childFolder)
                                        <div class="col-md-3 col-6">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="material-icons text-center">folder_open</span>
                                                    {{ $childFolder->title }}
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('folders.show', [$childFolder]) }}">Открить</a>
                                                    <a class="dropdown-item rename" href="#" data-url="{{ route('folders.update', ['folder' => $childFolder->id]) }}" data-title="{{ $childFolder->title }}" data-toggle="modal" data-target=".bd-example-modal-sm">Переименовать</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Удалить</a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-md-2 col-6">
                                            <div class="btn-group">
                                                <button type="button" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn btn-primary" aria-haspopup="true" aria-expanded="false">
                                                    &#x2b; Create new
                                                </button>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                                <hr>
                                <p>Files</p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            @foreach ($files as $item)
                                                <div class="col-md-2">
                                                    <div class="text-center">
                                                        <img style="width: 50px; " src="{{ asset('material/icons/'. $item->file_extension .'.png') }}" alt="">
                                                    </div>
                                                    <p style="line-height: 12px; margin-top: 10px">
                                                        <a href="#" class="view_detail_button" 
                                                            data-file_name="{{ $item->file_name }}"
                                                            data-file_size="{{ $item->file_size }}"
                                                            data-icon="{{ asset('material/icons/'. $item->file_extension .'.png') }}" 
                                                            data-extension="{{  $item->file_extension }}" 
                                                            data-path="{{ asset('/') . $item->file_path .'/'.$item->file_name }}" 
                                                            data-toggle="modal" 
                                                            data-target=".bd-example-modal-lg">
                                                            <small>{{ $item->file_name }}</small>
                                                        </a>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Large modal -->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Посмотреть детали</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="data-content"></div>
                    <hr>
                    <div class="view-detail">
                        <p><b>Имя файла:</b> <span class="file_name_modal"></span></p>
                        <p><b>Тип файла:</b> <span class="file_type_modal"></span></p>
                        <p><b>Размер файла:</b> <span class="file_size_modal"></span></p>

                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Удалить</button>
                <a href="#" type="button" class="btn btn-primary download-button">Скачать файл</a>
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
                    <input type="hidden" id="hidden_parent" name="parent_id" value="{{ $folder->id }}">
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
  
  <!-- Upload Modal -->
    <div class="modal fade" id="uploadFileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered" role="document">
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
                        <div class="form-group">
                            <div class="form-group">
                                <input type="hidden" name="folder_id" value="{{ $folder->id }}">
                            </div>
                            <input type="file" multiple data-fileuploader-theme="default" name="files" class="files" id="upload">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
                        <button type="submit" class="btn btn-primary">Загрузить</button>
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

                    $('.folder_modal').find("#hidden_parent").val('{{ $folder->id }}');
                    $('.folder_modal').attr("action", url);
                    $('.folder_modal').find("#hidden_method").val('put');
                    $('#folder_title').empty().val(title)
                });

                $(".create_new_folder").on("click", function () {
                    $('#folder_title').val('');
                });

                $('.parent_folder').on("click", function () {
                    var parent_id = $(this).attr('data-parent');
                    $('#folder_title').val('');
                    $('.folder_modal').find("#hidden_parent").val(parent_id);
                });

                $(".view_detail_button").on('click', function(){
                    var file_ext = $(this).attr('data-extension');
                    var file_path = $(this).attr('data-path');
                    var file_name = $(this).attr('data-file_name');
                    var file_icon = $(this).attr('data-icon');
                    var file_size = $(this).attr('data-file_size');

                    $('.file_name_modal').text(file_name)
                    $('.file_size_modal').text(Math.floor(file_size / 1024) + ' KB')
                    $('.file_type_modal').html("<span class='text-uppercase'>" + file_ext + "</span> file")

                    $('.data-content').empty();
                    if(file_ext == 'jpg' || file_ext == 'jpeg' || file_ext == 'png'){
                        $('.data-content').html("<img src='" + file_path + "' class='w-100'>");
                    }else if(file_ext == 'mp4' || file_ext == '3gp' || file_ext == 'mov' || file_ext == 'flv' || file_ext == 'avi'){
                        $('.data-content').html('<video style="width: 100%; height: 400px" controls><source src="'+ file_path +'" type="video/mp4"></video>');
                    }else{
                        $('.data-content').html("<img style='width: 50px;' src='" + file_icon + "'>");
                    }
                    $(".download-button").attr('href', file_path).attr('download', file_name);
                });
            });
        </script>
    @endpush
@endsection
