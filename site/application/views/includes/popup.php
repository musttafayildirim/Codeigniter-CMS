<?php $popup = get_popup_service($viewFolder); ?>

<?php if ($popup) { ?>

    <div class="modal fade" id="popup_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><?php echo $popup->title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <?php echo $popup->description; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-sm btn-default">Tekrar Gösterme</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#popup_model").modal("show");
        })
    </script>

<?php } ?>
