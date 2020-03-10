<div role="tabpanel" class="tab-pane fade" id="tab-2">
    <h4 class="m-b-md">Hakkımızda</h4>
    <div class="form-group">
        <textarea name="about" class="m-0" data-plugin="summernote" data-options="{height: 250}">
            <?php echo isset($form_error) ? set_value("about") : $item->about_us;?>
        </textarea>
    </div>
</div><!-- .tab-pane  -->
