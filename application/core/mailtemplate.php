<?php ob_start(); ?>
<table>
    <tbody>
    <tr><?= $this->view['head']; ?></tr>
    <tr><?= $this->view['content']; ?></tr>
    <tr><?= $this->view['footer']; ?></tr>
    </tbody>
</table>
<?php $this->mail_body = ob_get_clean();
?>