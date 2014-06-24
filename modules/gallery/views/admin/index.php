<div region="center" border="false">
<div style="padding:20px">
<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('gallery_image_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
<form action="" method="post" id="gallery_image-search-form">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr><td><label><?php echo lang('gallery_id')?></label>:</td>
<td><input type="text" name="search[gallery_id]" id="search_gallery_id"  class="easyui-numberbox"/></td>
<td><label><?php echo lang('added_on')?></label>:</td>
<td><input type="text" name="date[added_on][from]" id="search_added_on_from"  class="easyui-datebox"/> ~ <input type="text" name="date[added_on][to]" id="search_added_on_to"  class="easyui-datebox"/></td>
</tr>
<tr>
</tr>
  <tr>
    <td colspan="4">
    <a href="javascript:void(0)" class="easyui-linkbutton" id="search" data-options="iconCls:'icon-search'"><?php  echo lang('search')?></a>  
    <a href="javascript:void(0)" class="easyui-linkbutton" id="clear" data-options="iconCls:'icon-clear'"><?php  echo lang('clear')?></a>
    </td>
    </tr>
</table>

</form>
</div>
<br/>
<table id="gallery_image-table" data-options="pagination:true,title:'<?php  echo lang('gallery_image')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
    <thead>
    <th data-options="field:'checkbox',checkbox:true"></th>
    <th data-options="field:'gallery_image_id',sortable:true" width="30"><?php echo lang('gallery_image_id')?></th>
<th data-options="field:'gallery_image',sortable:true" width="50"><?php echo lang('gallery_image')?></th>
<th data-options="field:'gallery_id',sortable:true" width="50"><?php echo lang('gallery_id')?></th>
<th data-options="field:'added_on',sortable:true" width="50"><?php echo lang('added_on')?></th>

    <th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
    </thead>
</table>

<div id="toolbar" style="padding:5px;height:auto">
    <p>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_gallery_image')?>"><?php  echo lang('create')?></a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_gallery_image')?>"><?php  echo lang('remove_selected')?></a>
    </p>

</div> 

<!--for create and edit gallery_image form-->
<div id="dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-gallery_image" method="post" >
    <table>
		<tr>
		              <td width="34%" ><label><?php echo lang('gallery_image')?>:</label></td>
					  <td width="66%"><label id="upload_image_name" style="display:none"></label>
                      <input name="gallery_image" id="gallery_image" type="text" style="display:none"/>
                      <input type="file" id="upload_image" name="userfile" style="display:block"/>
                      <a href="#" id="change-image" title="Delete" style="display:none"><img src="<?=base_url()?>assets/icons/delete.png" border="0"/></a></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('gallery_id')?>:</label></td>
					  <td width="66%"><input name="gallery_id" id="gallery_id" class="easyui-numberbox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('added_on')?>:</label></td>
					  <td width="66%"><input name="added_on" id="added_on" class="easyui-datetimebox" required="true"></td>
		       </tr><input type="hidden" name="gallery_image_id" id="gallery_image_id"/>
    </table>
    </form>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onClick="save()"><?php  echo  lang('general_save')?></a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:$('#dlg').window('close')"><?php  echo  lang('general_cancel')?></a>
	</div>    
</div>
<!--div ends-->
   
</div>
</div>
<script language="javascript" type="text/javascript">
	$(function(){
		$('#clear').click(function(){
			$('#gallery_image-search-form').form('clear');
			$('#gallery_image-table').datagrid({
				queryParams:null
				});

		});

		$('#search').click(function(){
			$('#gallery_image-table').datagrid({
				queryParams:{data:$('#gallery_image-search-form').serialize()}
				});
		});		
		$('#gallery_image-table').datagrid({
			url:'<?php  echo site_url('gallery_image/admin/gallery_image/json')?>',
			height:'auto',
			width:'auto',
			onDblClickRow:function(index,row)
			{
				edit(index);
			}
		});
	});
	
	function getActions(value,row,index)
	{
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_gallery_image')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removegallery_image('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_gallery_image')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
		return e+d;		
	}
	
	function formatStatus(value)
	{
		if(value==1)
		{
			return 'Yes';
		}
		return 'No';
	}

	function create(){
		//Create code here
		$('#form-gallery_image').form('clear');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_gallery_image')?>');
		//uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#gallery_image-table').datagrid('getRows')[index];
		if (row){
			$('#form-gallery_image').form('load',row);
			//uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_gallery_image')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	
		
	function removegallery_image(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#gallery_image-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('gallery_image/admin/gallery_image/delete_json')?>', {id:[row.gallery_image_id]}, function(){
					$('#gallery_image-table').datagrid('deleteRow', index);
					$('#gallery_image-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#gallery_image-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].gallery_image_id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('gallery_image/admin/gallery_image/delete_json')?>',{id:selected},function(data){
						$('#gallery_image-table').datagrid('reload');
					});
				}
				
			});
			
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');	
		}
		
	}
	
	function save()
	{
		$('#form-gallery_image').form('submit',{
			url: '<?php  echo site_url('gallery_image/admin/gallery_image/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-gallery_image').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#gallery_image-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close
		
		});		
		
	}
	
	function uploadReady()
	{
		uploader=$('#upload_image');
		new AjaxUpload(uploader, {
			action: '<?php  echo site_url('gallery_image/admin/gallery_image/upload_image')?>',
			name: 'userfile',
			responseType: "json",
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					$.messager.show({title: '<?php  echo lang('error')?>',msg: 'Only JPG, PNG or GIF files are allowed'});
					return false;
				}
				//status.text('Uploading...');
			},
			onComplete: function(file, response){
				if(response.error==null){
					var filename = response.file_name;
					$('#upload_image').hide();
					$('#gallery_image').val(filename);
					$('#upload_image_name').html(filename);
					$('#upload_image_name').show();
					$('#change-image').show();
				}
                else
                {
					$.messager.show({title: '<?php  echo lang('error')?>',msg: response.error});                
                }
			}		
		});		
	}
</script>