<div region="center" border="false">
<div style="padding:20px">
<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('ticket_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
<form action="" method="post" id="ticket-search-form">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr><td><label><?php echo lang('ticket_number')?></label>:</td>
<td><input type="text" name="search[ticket_number]" id="search_ticket_number"  class="easyui-numberbox"/></td>
<td><label><?php echo lang('event_id')?></label>:</td>
<td><input type="text" name="search[event_id]" id="search_event_id"  class=""/></td>
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
<table id="ticket-table" data-options="pagination:true,title:'<?php  echo lang('ticket')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
    <thead>
    <th data-options="field:'checkbox',checkbox:true"></th>
    <th data-options="field:'ticket_id',sortable:true" width="30"><?php echo lang('ticket_id')?></th>
<th data-options="field:'ticket_image',sortable:true,formatter:formatImage" width="50"><?php echo lang('ticket_image')?></th>
<th data-options="field:'ticket_number',sortable:true" width="50"><?php echo lang('ticket_number')?></th>
<th data-options="field:'event_name',sortable:true" width="50"><?php echo lang('event_id')?></th>
<th data-options="field:'created_date',sortable:true" width="50"><?php echo lang('created_date')?></th>

    <th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
    </thead>
</table>

<div id="toolbar" style="padding:5px;height:auto">
    <p>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_ticket')?>"><?php  echo lang('create')?></a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_ticket')?>"><?php  echo lang('remove_selected')?></a>
    </p>

</div> 

<!--for create and edit ticket form-->
<div id="dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-ticket" method="post" >
    <table>
		<tr>
		              <td width="34%" ><label><?php echo lang('ticket_image')?>:</label></td>
					  <td width="66%"><label id="upload_image_name" style="display:none"></label>
                      <input name="ticket_image" id="ticket_image" type="text" style="display:none"/>
                      <input type="file" id="upload_image" name="userfile" style="display:block"/>
                      <a href="#" id="change-image" title="Delete" style="display:none"><img src="<?=base_url()?>assets/icons/delete.png" border="0"/></a></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('ticket_number')?>:</label></td>
					  <td width="66%"><input name="ticket_number" id="ticket_number" class="easyui-numberbox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('event_id')?>:</label></td>
					  <td width="66%"><input name="event_id" id="event_id" class="easyui-combobox" required="true"></td>
		       </tr><input type="hidden" name="ticket_id" id="ticket_id"/>
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
		 ?>
		$('#clear').click(function(){
			$('#ticket-search-form').form('clear');
			$('#ticket-table').datagrid({
				queryParams:null
				});

		});

		$('#search').click(function(){
			$('#ticket-table').datagrid({
				queryParams:{data:$('#ticket-search-form').serialize()}
				});
		});		
		$('#ticket-table').datagrid({
			url:'<?php  echo site_url('ticket/admin/ticket/json')?>',
			height:'auto',
			width:'auto',
			onDblClickRow:function(index,row)
			{
				edit(index);
			}
		});

	
	$('#change-image').on('click',function(){
			$.messager.confirm('Confirm','Are you sure to delete ?',function(r){
				if (r){
					$.post('<?php echo site_url('artist/admin/artist/upload_delete')?>',{filename:$('#artist_image').val()},function(data){
					$('#upload_image_name').html('').hide();
					$('#change-image').hide();
					$('#upload_image').show();	
					});
				}
			});
		});
	});
	
	function getActions(value,row,index)
	{
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_ticket')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removeticket('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_ticket')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
		return e+d;		
	}
	
		function formatImage(value)
	{
		if(value!='')
		{
			return '<img src="<?php echo base_url()?>uploads/ticket/thumb/' + value + '" height="50" width="50">';
		}
		return '';
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
		$('#form-ticket').form('clear');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_ticket')?>');
		$('#upload_image_name').html('').hide();
		$('#change-image').hide();
		$('#upload_image').show();
		uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#ticket-table').datagrid('getRows')[index];
		if (row){
			$('#form-ticket').form('load',row);
			
			if(row.artist_image!='')
			{
				$('#upload_image_name').html(row.ticket_image).show();
				$('#change-image').show();
				$('#upload_image').hide();
			}
			uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_ticket')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	
	
		
	function removeticket(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#ticket-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('ticket/admin/ticket/delete_json')?>', {id:[row.ticket_id]}, function(){
					$('#ticket-table').datagrid('deleteRow', index);
					$('#ticket-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#ticket-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].ticket_id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('ticket/admin/ticket/delete_json')?>',{id:selected},function(data){
						$('#ticket-table').datagrid('reload');
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
		$('#form-ticket').form('submit',{
			url: '<?php  echo site_url('ticket/admin/ticket/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-ticket').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#ticket-table').datagrid('reload');	// reload the user data
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
			action: '<?php  echo site_url('ticket/admin/ticket/upload_image')?>',
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
					$('#ticket_image').val(filename);
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