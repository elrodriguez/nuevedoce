<div>
    <div id="panel-6" class="panel">
        <div class="panel-hdr">
            <h2>Documentos Emitidos </h2>
        </div>
        <div class="panel-container show">
            <div class="panel-content p-0 mb-g">
                <div class="alert alert-success alert-dismissible fade show border-faded border-left-0 border-right-0 border-top-0 rounded-0 m-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                    Desde  <strong><?php echo e(\Carbon\Carbon::parse($date_start)->format('d/m/Y')); ?> </strong> Hasta <strong><?php echo e(\Carbon\Carbon::parse($date_end)->format('d/m/Y')); ?></strong>
                </div>
            </div>
            <div class="panel-content">
                <div class="row  mb-g">
                    <div class="col-md-6 d-flex align-items-center">
                        <div id="flotPie" class="w-100" style="height:250px"></div>
                    </div>
                    <div class="col-md-6 col-lg-5 mr-lg-auto">
                        
                        <?php if(count($data_pie)>0): ?>
                            <?php $__currentLoopData = $data_pie; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex mt-2 mb-1 fs-xs text-primary">
                                    <?php echo e($item['label']); ?>

                                </div>
                                <div class="progress progress-xs mb-3">
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo e($item['data']); ?>%;background:<?php echo e($item['color']); ?>" aria-valuenow="<?php echo e($item['data']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script defer>
        document.addEventListener('livewire:load', function () {
            let dataSetPie = <?php
    if (is_object($data_pie) || is_array($data_pie)) {
        echo "JSON.parse(atob('".base64_encode(json_encode($data_pie))."'))";
    } elseif (is_string($data_pie)) {
        echo "'".str_replace("'", "\'", $data_pie)."'";
    } else {
        echo json_encode($data_pie);
    }
?>;
            $.plot($("#flotPie"), dataSetPie,{
                    series:
                    {
                        pie:
                        {
                            innerRadius: 0.5,
                            show: true,
                            radius: 1,
                            label:
                            {
                                show: false,
                                radius: 2 / 3,
                                threshold: 0.1,
                                background: {
                                    opacity: 0.5,
                                    color: '#000'
                                }
                            }
                        }
                    },
                    legend:
                    {
                        show: false
                    }
            });
        });
    </script>
</div>
<?php /**PATH C:\laragon\www\nuevedoce\Modules/Sales\Resources/views/livewire/dashboard/total-document.blade.php ENDPATH**/ ?>