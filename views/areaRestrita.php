<?php \Classes\ClassLayout::setHeadRestrito("user");?>
<?php \Classes\ClassLayout::setHeader('Área Restrita','Exclusivos para membros');?>

<h2>Ferramentas Gerencias</h2>
<a href="<?php echo DIRPAGE.'controllers/controllerLogout'; ?>">Sair</a>

<?php \Classes\ClassLayout::setFooter();?>