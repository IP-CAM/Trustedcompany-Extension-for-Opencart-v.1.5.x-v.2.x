<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-trustedcompany_acf" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>

      <div class="panel-body">
        <p><?php echo $text_tc_text; ?></p>
        <form action="<?php echo $action; ?>" method="post" id="form-trustedcompany_acf" class="form-horizontal">


          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-trustedcompanydns"><?php echo $text_tc_domain; ?></label>
            <div class="col-sm-10">
              <input size="60" name="trustedcompanydns" class="form-control" value="<?php if (isset(trustedcompanydns)) { echo trustedcompanydns; } ?>" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-trustedcompanyinboundemail"><?php echo $text_tc_email; ?></label>
            <div class="col-sm-10">
              <input size="60" name="trustedcompanyinboundemail" class="form-control" value="<?php if (isset(trustedcompanyinboundemail)) { echo trustedcompanyinboundemail; } ?>" />
            </div>
          </div>


        </form>
      </div>
    </div>
  </div>
</div>



<?php echo $footer; ?>
