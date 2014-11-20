





<div class="table-responsive" style="position: absolute; top: 200px; left: 300px;">
<table class="table" style="=width:500px;">
<legend>Surveys</legend>
<thead>
<tr>
</div>
<div style="width:500px;"><th style="width:500px;"><b>Survey Title</b></th></div>
<div style="width:700px;"><th style="width:1000px;"><b>Survey Purpose</b></th></div>
<div style="width:300px;"><th style="width:500px;"><b>Survey Source</b></th></div>
<th><b></b></th>

<th>&nbsp;
</th>
<th>&nbsp;
</th>

</tr>
</thead>

<?php foreach($rec->result() as $row): ?>
<tr class="sucess">

<td><?php echo $row->sur_title;
?></td>
<td><?php echo $row->sur_purpose;
?></td>
<td><?php echo $row->sur_source;
?></td>




</tr>
<?php endforeach;
?>


</table>
</div>