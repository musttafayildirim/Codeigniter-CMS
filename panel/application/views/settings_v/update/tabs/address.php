<div role="tabpanel" class="tab-pane fade" id="tab-7">
    <h4 class="m-b-md">Adres Bilgisi</h4>
    <div class="form-group">
        <textarea name="address" class="m-0" data-plugin="summernote" data-options="{height: 250}">
            <?php echo isset($form_error) ? set_value("address") : $item->address;?>
        </textarea>
    </div>
</div><!-- .tab-pane  -->