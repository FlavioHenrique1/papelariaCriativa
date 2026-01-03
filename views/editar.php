<?php \Classes\ClassLayout::setHeader('Área Restrita','Exclusivos para membros');?>

<?php 
$obj=new \Classes\ClassEvents();
$events=$obj->getEvents($_GET['id']);
$date=new \DateTime($events[0]['start']);
?>
    <form action="<?= DIRCONT.'controllerEvents'?>" method="post" name="formAdd" id="formAdd">
        <input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>"><br>
        Data: <input type="date" name="date" id="date" value="<?php echo $date->format("Y-m-d") ?>"><br>
        Hora: <input type="time" name="time" id="time" value="<?= $date->format("H:i") ?>"><br>
        Paciente: <input type="text" name="title" id="title" value="<?= $events[0]['title']?>"><br>
        Queixa: <input type="text" name="description" id="description" value="<?= $events[0]['description']?>"><br>
        <input type="submit" value="Confirmar consulta">
    </form>
<?php \Classes\ClassLayout::setFooter();?>