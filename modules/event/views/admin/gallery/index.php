<div region="center" border="false">
<div style="padding:20px">
<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('gallery_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
<form action="" method="post" id="gallery-search-form">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr><td><label><?php echo lang('event_id')?></label>:</td>
<td><input type="text" name="search[event_id]" id="search_event_id"  class="easyui-numberbox"/></td>
<td><label><?php echo lang('gallery_title')?></label>:</td>
<td><input type="text" name="search[gallery_title]" id="search_gallery_title"  class="easyui-validatebox"/></td>
</tr>
<tr>
<td><label><?php echo lang('country_code')?></label>:</td>
<td><input type="text" name="search[country_code]" id="search_country_code"  class="easyui-numberbox"/></td>
<td><label><?php echo lang('active')?></label>:</td>
<td><input type="radio" name="search[active]" id="search_active1" value="1"/><?php echo lang('general_yes')?>
									<input type="radio" name="search[active]" id="search_active0" value="0"/><?php echo lang('general_no')?></td>
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
<table id="gallery-table" data-options="pagination:true,title:'<?php  echo lang('gallery')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
    <thead>
    <th data-options="field:'checkbox',checkbox:true"></th>
    <th data-options="field:'gallery_id',sortable:true" width="30"><?php echo lang('gallery_id')?></th>
<th data-options="field:'event_name',sortable:true" width="50"><?php echo lang('event_id')?></th>
<th data-options="field:'gallery_title',sortable:true" width="50"><?php echo lang('gallery_title')?></th>
<th data-options="field:'image_name',sortable:false,formatter:formatImage" width="50" width="50"><?php echo lang('gallery_image_id')?></th>
<th data-options="field:'country_name',sortable:true" width="50"><?php echo lang('country_code')?></th>
<th data-options="field:'active',sortable:true,formatter:formatStatus" width="30" align="center"><?php echo lang('active')?></th>

    <th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
    </thead>
</table>

<div id="toolbar" style="padding:5px;height:auto">
    <p>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_gallery')?>"><?php  echo lang('create')?></a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_gallery')?>"><?php  echo lang('remove_selected')?></a>
    </p>

</div> 

<!--for create and edit gallery form-->
<div id="dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-gallery" method="post" >
    <table>
		<tr>
		              <td width="34%" ><label><?php echo lang('event_id')?>:</label></td>
					  <td width="66%"><input name="event_id" id="event_id" class="easyui-numberbox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('gallery_title')?>:</label></td>
					  <td width="66%"><input name="gallery_title" id="gallery_title" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('gallery_image_id')?>:</label></td>
					  <td width="66%"><label id="upload_image_name" style="display:none"></label>
                      <input name="gallery_image_id" id="gallery_image_id" type="text" style="display:none"/>
                      <input type="file" id="upload_image" name="userfile" style="display:block"/>
                      <a href="#" id="change-image" title="Delete" style="display:none"><img src="<?=base_url()?>assets/icons/delete.png" border="0"/></a></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('country_code')?>:</label></td>
					  <td width="66%"><input name="country_code" id="country_code" class="easyui-numberbox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('active')?>:</label></td>
					  <td width="66%"><input type="radio" value="1" name="active" id="active1" /><?php echo lang("general_yes")?> <input type="radio" value="0" name="active" id="active0" /><?php echo lang("general_no")?></td>
		       </tr><input type="hidden" name="gallery_id" id="gallery_id"/>
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
		
		<?php easyui_combobox('search_event_id','EVENT');
			  easyui_combobox('event_id','EVENT');
			  easyui_combobox('search_country_code','COUNTRY');
			  easyui_combobox('country_code','COUNTRY');
		?>
		
		$('#clear').click(function(){
			$('#gallery-search-form').form('clear');
			$('#gallery-table').datagrid({
				queryParams:null
				});

		});

		$('#search').click(function(){
			$('#gallery-table').datagrid({
				queryParams:{data:$('#gallery-search-form').serialize()}
				});
		});		
		$('#gallery-table').datagrid({
			url:'<?php  echo site_url('event/admin/gallery/json')?>',
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
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_gallery')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removegallery('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_gallery')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
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
		$('#form-gallery').form('clear');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_gallery')?>');
		//uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#gallery-table').datagrid('getRows')[index];
		if (row){
			$('#form-gallery').form('load',row);
			//uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_gallery')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	
		
	function removegallery(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#gallery-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('gallery/admin/gallery/delete_json')?>', {id:[row.gallery_id]}, function(){
					$('#gallery-table').datagrid('deleteRow', index);
					$('#gallery-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#gallery-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].gallery_id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('gallery/admin/gallery/delete_json')?>',{id:selected},function(data){
						$('#gallery-table').datagrid('reload');
					});
				}
				
			});
			
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');	
		}
		
	}
	
	function formatImage(value)
	{
		if(value!='')
		{
			return '<img src="<?php echo base_url()?>uploads/event/thumb/' + value + '" height="50" width="50">';
		}
		return '';
	}
	
	function save()
	{
		$('#form-gallery').form('submit',{
			url: '<?php  echo site_url('gallery/admin/gallery/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-gallery').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#gallery-table').datagrid('reload');	// reload the user data
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
			action: '<?php  echo site_url('gallery/admin/gallery/upload_image')?>',
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
					$('#gallery_image_id').val(filename);
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