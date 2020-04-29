<div role="tabpanel" class="tab-pane fade active in" id="tab-1">
    <div class="row">
        <div class="form-group col-md-12">
            <h4 class="m-b-md">Şirket Adı</h4>
            <input type="text" class="form-control"  placeholder="Şirket Adı" name="company_name" value="<?php echo isset($form_error) ? set_value("company_name") : $item->company_name;?>">
            <?php if(isset($form_error)){ ?>
                <small class="pull-right input-form-error"><?php echo form_error( "company_name");?></small>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <h4 class="m-b-md">Telefon 1</h4>
            <input type="tel" class="form-control"  placeholder="(000)-000-000-00" name="phone_1" value="<?php echo isset($form_error) ? set_value("phone_1") : $item->phone_1;?>">
            <?php if(isset($form_error)){ ?>
                <small class="pull-right input-form-error"><?php echo form_error( "phone_1");?></small>
            <?php } ?>
        </div>
        <div class="form-group col-md-6">
            <h4 class="m-b-md">Telefon 2</h4>
            <input type="tel" class="form-control"  placeholder="Diğer telefon numaranızı giriniz." name="phone_2" value="<?php echo isset($form_error) ? set_value("phone_2") : $item->phone_2;?>">
            <?php if(isset($form_error)){ ?>
                <small class="pull-right input-form-error"><?php echo form_error( "phone_2");?></small>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <h4 class="m-b-md">Faks 1</h4>
            <input type="tel" class="form-control"  placeholder="Faks numaranızı giriniz." name="fax_1" value="<?php echo isset($form_error) ? set_value("fax_1") : $item->fax_1;?>">
            <?php if(isset($form_error)){ ?>
                <small class="pull-right input-form-error"><?php echo form_error( "fax_1");?></small>
            <?php } ?>
        </div>
        <div class="form-group col-md-6">
            <h4 class="m-b-md">Faks 2</h4>
            <input type="tel" class="form-control"  placeholder="Diğer faks numaranızı giriniz." name="fax_2" value="<?php echo isset($form_error) ? set_value("fax_2") : $item->fax_2;?>">
            <?php if(isset($form_error)){ ?>
                <small class="pull-right input-form-error"><?php echo form_error( "fax_2");?></small>
            <?php } ?>
        </div>
    </div>
</div><!-- .tab-pane  -->