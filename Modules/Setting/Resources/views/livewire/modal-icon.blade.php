<div >
    <div class="modal fade" id="modalIconSystem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Iconos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- input group search box -->
                    <div class="input-group input-group-lg mb-3">
                        <input type="text" class="form-control shadow-inset-2" id="filter-icon" aria-label="type 2 or more letters">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fal fa-search"></i></span>
                        </div>
                    </div>
                    <!-- end input group search box -->
                    <div style="position: relative; overflow: hidden; width: auto; height: 300px;">
                        <div style="overflow: auto; width: auto; height: 300px;">
                            <!-- icon list -->
                            <div class="card pt-3 pr-3 pb-0 pl-3">
                                <div id="icon-list" class="row"></div>
                            </div>
                            <!-- end icon list -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('livewire:load', function () {
            /*webfont prefix*/
            var prefix = "fal"; //fal fas far fab ni etc
            var prefix_extend = "fa" //fa-icon

            /*JSON file that will be loaded*/
            var filename = "{{ url('themes/smart-admin/media/data/fa-icon-list') }}"; //available JSON files [ng-icon-base, ng-icon-list, ng-text-colors, fa-brand-list, fa-icon-list]

            /*execute code*/
            $.getJSON(filename + ".json").then(function(data)
            {

                /*...worked*/
                var formatedDOMElms = [];

                /*compile DOM elements*/
                jQuery.each(data, function(index, item)
                {
                    formatedDOMElms.push('<div class="col-4 col-sm-3 col-md-3 col-lg-2 col-xl-1 d-flex justify-content-center align-items-center mb-g">\
                                            <a href="#" class="rounded bg-white p-0 m-0 d-flex flex-column w-100 h-100 js-showcase-icon shadow-hover-2" >\
                                                <div class="rounded-top color-fusion-300 w-100 bg-primary-300">\
                                                    <div class="rounded-top d-flex align-items-center justify-content-center w-100 pt-3 pb-3 pr-2 pl-2 fa-3x hover-bg">\
                                                        <i class="' + prefix + ' ' + prefix_extend + item + '"></i>\
                                                    </div>\
                                                </div>\
                                                <div class="rounded-bottom p-1 w-100 d-flex justify-content-center align-items-center text-center">\
                                                    <span class="d-block text-truncate text-muted">' + item.substring(1) + '</span>\
                                                </div>\
                                            </a>\
                                        </div>');
                });

                /* append to HTML dom*/
                $('#icon-list').append(formatedDOMElms.join(" "));

                /*initialize filter*/
                initApp.listFilter($('#icon-list'), $('#filter-icon'));

                /*client event for each icon*/
                $('.js-showcase-icon').click(function()
                {
                    var iconClass = $(this).find('i').attr('class');
                    @this.emit('iconAdded', iconClass);
                    $('#modalIconSystem').modal('hide');
                });


                /*add number of icons*/
                $('#filter-icon').attr('placeholder', "Search " + data.length + " icons for")

            }).fail(function()
            {
                console.log("failed")
            });
        });
    </script>
</div>
