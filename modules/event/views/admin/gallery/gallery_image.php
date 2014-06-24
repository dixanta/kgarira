<a href="#" onclick="deleteSelected()" class="easyui-linkbutton l-btn" iconcls="icon-remove"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel">Delete Selected</span></span></a>
<form method="post" id="image-view-form">
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
  <?php
  	$i=1;
  	foreach($images->result_array() as $row):
	if(($i%5)==0):
  ?>
  	</tr>
    <tr>
   <?php else:?>
    <td><img src="<?=base_url()?>uploads/gallery/<?=$gallery_id?>/thumbs/<?=$row['gallery_image']?>"/><br/>
    <input type="checkbox" name="image_id[]" value="<?=$row['gallery_image_id']?>"/>
    <a href="#" class="make-cover" rel="<?=$row['gallery_image_id']?>">Make Cover</a>
    <a href="#" class="delete" rel="<?=$row['gallery_image_id']?>"><img src="<?=base_url()?>assets/icons/delete.png" border="0"/></a>
    </td>
   <?php
   endif;
   $i++;
   endforeach;
   ?>
  </tr>
</table>
<input type="hidden" name="gallery_id" value="<?=$gallery_id?>"/>
</form>


<script>
function deleteSelected()
{
	$.messager.confirm('question','Are you sure to delete?',function(r){
		if(r)
		{
			$.post('<?=site_url('event/admin/gallery/delete_images')?>',$('#image-view-form').serialize(),function(data){
				getImages('<?=$gallery_id?>');
				/*if(data.success)
				{
					$.messager.alert('Success',data.msg);
					$('#gallery-table').datagrid('reload');
				}
				else
				{
					$.messager.alert('Failure',data.msg);
				}*/
			},'json');			
		}
	});
}
$(function(){
$('#delete-selected').linkbutton();	
$('.make-cover').click(function(){
	var image_id=$(this).attr('rel');
	
	$.post('<?=site_url('event/admin/gallery/makecover')?>',{gallery_id:<?=$gallery_id?>,image_id:image_id},function(data){
		if(data.success)
		{
			$.messager.alert('Success',data.msg);
			$('#gallery-table').datagrid('reload');
		}
		else
		{
			$.messager.alert('Failure',data.msg);
		}
	},'json');
});

$('.delete').click(function(){
	var image_id=$(this).attr('rel');
	$.messager.confirm('question','Are you sure to delete?',function(r){
		if(r)
		{
			$.post('<?=site_url('event/admin/gallery/delete_images')?>',{gallery_id:<?=$gallery_id?>,image_id:[image_id]},function(data){
				getImages('<?=$gallery_id?>');
				/*if(data.success)
				{
					$.messager.alert('Success',data.msg);
					$('#gallery-table').datagrid('reload');
				}
				else
				{
					$.messager.alert('Failure',data.msg);
				}*/
			},'json');			
		}
	});
});

});
</script>