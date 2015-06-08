<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
      <?php } ?>
    </div>
    <?php if (isset($error_warning)) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>

    <div class="box">
        <div class="heading">
            <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        <div class="content">

          <form role="form" action="<?php echo $action; ?>" method="post">
          <p><?php echo $text_acf; ?></p>
          <table>
            <tr>
              <td><?php echo $texte_dns; ?></td>
              <td><input size="60" name="trustedcompanydns" value="<?php if (isset($trustedcompanydns)) { echo $trustedcompanydns; } ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $texte_add_email; ?></td>
              <td><input size="60" name="trustedcompanyinboundemail" value="<?php if (isset($trustedcompanyinboundemail)) { echo $trustedcompanyinboundemail; } ?>" /></td>
            </tr>
          </table>
          </form>

        </div>
    </div>

</div> 

<?php echo $footer; ?>