$(document).ready(function() {
	
	// enable fileuploader plugin
	$('input[name="files"]').fileuploader({
        // addMore: true,
        skipFileNameCheck: false,
        onRemove: function(item, listEl, parentEl, newInputEl, inputEl) {
            // callback will go here
            // console.log(item)
            return true;
        },
        removeConfirmation: 'Ushbu fayli o\'chirmoqchimisiz?',
        captions: {
            button: function(options) {
                return 'Browse ' + (options.limit == 1 ? 'file' : 'files');
            },
            feedback: function(options) {
                return 'Choose ' + (options.limit == 1 ? 'file' : 'files') + ' to upload';
            },
            feedback2: function(options) {
                return options.length + ' ' + (options.length > 1 ? 'files were' : 'file was') + ' chosen dddd';
            },
            confirm: 'Confirm',
            cancel: 'Cancel',
            name: 'Name',
            type: 'Type',
            size: 'Size',
            dimensions: 'Dimensions',
            duration: 'Duration',
            crop: 'Crop',
            rotate: 'Rotate',
            sort: 'Sort',
            download: 'Download',
            remove: 'Delete',
            drop: 'Drop the files here to Upload',
            paste: '<div class="fileuploader-pending-loader"></div> Pasting a file, click here to cancel.',
            removeConfirmation: 'Ushbu fayli o\'chirmoqchimisiz?',
            errors: {
                filesLimit: function(options) {
                    return 'Only ${limit} ' + (options.limit == 1 ? 'file' : 'files') + ' can be uploaded.'
                },
                filesType: 'Only ${extensions} files are allowed to be uploaded.',
                fileSize: '${name} is too large! Please choose a file up to ${fileMaxSize}MB.',
                filesSizeAll: 'The chosen files are too large! Please select files up to ${maxSize} MB.',
                fileName: 'A file with the same name ${name} is already selected.',
                remoteFile: 'Remote files are not allowed.',
                folderUpload: 'Folders are not allowed.'
            }
        }
    });
	
});