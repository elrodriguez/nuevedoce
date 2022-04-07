<div wire:ignore>
    <form action="<?php echo e(route('inventory_item_upload_file')); ?>" method="POST" class="dropzone needsclick" id="file-upload" enctype="multipart/form-data" style="min-height: 7rem; height: 120%;">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <input type="hidden" name="item_id" value="<?php echo e($item_id); ?>">
        <div class="dz-message needsclick">
            <i class="fal fa-cloud-upload text-muted mb-3"></i> <br>
            <span class="text-uppercase"><?php echo app('translator')->get('inventory::labels.msg_0003'); ?></span>
        </div>
    </form>
    <div id="preview-template" class="hide">
        <div class="dz-preview dz-file-preview">
            <div class="dz-image">
                <img data-dz-thumbnail="" />
            </div>
            <div class="dz-details">
                <div class="dz-size">
                    <span data-dz-size=""></span>
                </div>
                <div class="dz-filename">
                    <span data-dz-name=""></span>
                </div>
            </div>
            <div class="dz-progress">
                <span class="dz-upload" data-dz-uploadprogress=""></span>
            </div>
            <div class="dz-error-message" style="top:-5px;">
            </div>
            <div class="dz-success-mark">
                <span class="fa-stack">
                    <i class="fal fa-circle fa-stack-2x white"></i>
                    <i class="fal fa-check fa-stack-1x fa-inverse" style="color: green;left: 8px;top: 10px;"></i>
                </span>
            </div>
            <div class="dz-error-mark">
                <span class="fa-stack" style="vertical-align: top;">
                  <i class="fal fa-circle fa-stack-2x"></i>
                  <i class="fal fa-times fa-stack-1x" style="color: red;left: 8px;top: 10px;"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex flex-row align-items-center">
        <a href="<?php echo e(route('inventory_item')); ?>" type="button" class="btn btn-secondary waves-effect waves-themed"><?php echo app('translator')->get('inventory::labels.lbl_list'); ?></a>
    </div>
</div>
<script src="<?php echo e(url('themes/smart-admin/js/formplugins/dropzone/dropzone.js')); ?>"></script>
<script>
    Dropzone.autoDiscover = false;
    Dropzone.prototype.defaultOptions.dictDefaultMessage = "Arrastra los archivos aquí para subirlos";
    Dropzone.prototype.defaultOptions.dictFallbackMessage = "Su navegador no admite la carga de archivos mediante la función de arrastrar y soltar.";
    Dropzone.prototype.defaultOptions.dictFallbackText = "Utilice el formulario de respaldo a continuación para cargar sus archivos como en los viejos tiempos.";
    Dropzone.prototype.defaultOptions.dictFileTooBig = "El archivo es demasiado grande. Máx.: 1 MiB.";
    Dropzone.prototype.defaultOptions.dictInvalidFileType = "No puede cargar archivos de este tipo.";
    Dropzone.prototype.defaultOptions.dictResponseError = "El servidor respondió con el código error.";
    Dropzone.prototype.defaultOptions.dictCancelUpload = "Cancelar carga";
    Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "¿Estás seguro de que deseas cancelar esta carga?";
    Dropzone.prototype.defaultOptions.dictRemoveFile = "Eliminar archivo";
    Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "No puede cargar más archivos.";

    document.addEventListener('livewire:load', function () {
        //Carga de Archivos
        // try {
            var myDropzone = new Dropzone('#file-upload', {
                //paramName: "xyzFileUpload",
                previewTemplate: $('#preview-template').html(),
                thumbnailHeight: 120,
                thumbnailWidth: 120,
                maxFilesize: 1, //MB
                maxFiles: 5,
                autoQueue: true,
                addRemoveLinks : true,
                acceptedFiles: "image/*",
                dictRemoveFile: '<i class="fal fa-times" style="color: #b00000;"></i>',
                dictCancelUpload: '<i class="fal fa-ban" style="color: #b00000;"></i>',
                init: function() {
                    thisDropzone = this;
                    $(".dz-preview").remove();
                    var data_aaa = "<?php echo e(json_encode($result)); ?>";
                    data_aaa = data_aaa.replace(/(&quot\;)/g,"\"")
                    var data_bbb = JSON.parse(data_aaa);
                    $.each(data_bbb, function(key, value){
                        var mockFile = {
                            id: value.id,
                            name: value.name,
                            size: value.size,
                            route: value.route,
                            serverFileName: value.server_name,
                            accepted: true
                        };
                        thisDropzone.files.push(mockFile);
                        thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                        thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.route);
                        thisDropzone.emit("complete", mockFile);
                    });
                    $('.dz-preview').css({"width":"120px", "height":"120px"});
                    $('.dz-image img').css({"width":"100%", "height":"100%"});
                },
                success: function (file, response) {
                    if(response.result == "OK"){
                        file.previewElement.classList.add("dz-success");
                        file.serverFileName = response.file_name;
                        initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
                        let box = bootbox.alert({
                            title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.lbl_success')); ?>!</span>",
                            message: "<span><strong><?php echo e(__('inventory::labels.lbl_excellent')); ?>... </strong><?php echo e(__('inventory::labels.msg_0004')); ?></span>",
                            centerVertical: true,
                            className: "modal-alert",
                            closeButton: false,
                            callback: function () {
                                location.reload();
                            }
                        });
                        box.find('.modal-content').css({'background-color': 'rgba(5,112,1,0.5)'});
                    }else{
                        initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
                        let box = bootbox.alert({
                            title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.error')); ?>!</span>",
                            message: "<span><strong><?php echo e(__('inventory::labels.went_wrong')); ?>... </strong> <?php echo e(__('inventory::labels.msg_0005')); ?></span>",
                            centerVertical: true,
                            className: "modal-alert",
                            closeButton: false,
                            callback: function () {
                            }
                        });
                        box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
                    }
                },
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                    $(file.previewElement).find('.dz-error-message').text(response);
                    initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
                    let box = bootbox.alert({
                        title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.error')); ?>!</span>",
                        message: "<span><strong><?php echo e(__('inventory::labels.error')); ?>... </strong>"+response+"</span>",
                        centerVertical: true,
                        className: "modal-alert",
                        closeButton: false,
                        callback: function () {
                        }
                    });
                    box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
                },
                removedfile: function (file, data) {
                    thisDropzone = this;
                    let idfile = file.id;
                    let narchivo = file.serverFileName;
                    let url_file = file.route;
                    //Ruta a eliminar
                    window.livewire.find('<?php echo e($_instance->id); ?>').deleteFile(idfile, narchivo, url_file);
                    var _ref;
                    if (file.previewElement) {
                        if ((_ref = file.previewElement) != null) {
                            _ref.parentNode.removeChild(file.previewElement);
                        }
                    }

                    return this._updateMaxFilesReachedClass();

                }
            });
            //eliminar la instancia de dropzone al salir de esta página en modo ajax
            $(document).one('ajaxloadstart.page', function(e) {
                try {
                    myDropzone.destroy();
                } catch(e) {}
            });

        // } catch(e) {
        //     alert('Dropzone.js no es compatible con navegadores antiguos!!');
        // }
        $("#spaItemCreate").html(':: <?php echo e($name_item); ?>');
    });

    document.addEventListener('set-file-delete', event => {
        let res = event.detail.res;
        if(res == 'OK') {
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_on')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.success')); ?>!</span>",
                message: "<span><strong><?php echo e(__('inventory::labels.excellent')); ?>... </strong><?php echo e(__('inventory::labels.msg_0006')); ?></span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        }else{
            initApp.playSound('<?php echo e(url("themes/smart-admin/media/sound")); ?>', 'voice_off')
            let box = bootbox.alert({
                title: "<i class='fal fa-check-circle text-warning mr-2'></i> <span class='text-warning fw-500'><?php echo e(__('inventory::labels.error')); ?>!</span>",
                message: "<span><strong><?php echo e(__('inventory::labels.went_wrong')); ?>... </strong><?php echo e(__('inventory::labels.msg_0007')); ?></span>",
                centerVertical: true,
                className: "modal-alert",
                closeButton: false
            });
            box.find('.modal-content').css({'background-color': 'rgba(122, 85, 7, 0.5)'});
        }
        
    });
</script>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Inventory\Resources/views/livewire/item/item-file.blade.php ENDPATH**/ ?>