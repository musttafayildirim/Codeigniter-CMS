<div role="tabpanel" class="tab-pane fade" id="tab-4">
    <h4 class="m-b-md">Misyonumuz</h4>
    <div class="form-group">
                                            <textarea name="mission" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                                                <?php echo isset($form_error) ? set_value("mission") : $item->mission;?>
                                            </textarea>
    </div>
</div><!-- .tab-pane  -->
