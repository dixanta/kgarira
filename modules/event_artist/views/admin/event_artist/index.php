<div region="center" border="false">  
<div style="padding:20px">
<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('event_artist_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
<form action="" method="post" id="event_artist-search-form">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr><td><label><?php echo lang('artist')?></label>:</td>
<td><input type="text" name="search[artist_id]" id="search_artist_id"  class=""/></td>
<td><label><?php echo lang('event')?></label>:</td>
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
<table id="event_artist-table" data-options="pagination:true,title:'<?php  echo lang('event_artist')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
    <thead>
    <th data-options="field:'checkbox',checkbox:true"></th>
    <th data-options="field:'event_artist_id',sortable:true" width="30"><?php echo lang('event_artist_id')?></th>
<th data-options="field:'artist_name',sortable:true" width="50"><?php echo lang('artist')?></th>
<th data-options="field:'event_name',sortable:true" width="50"><?php echo lang('event')?></th>
<th data-options="field:'created_date',sortable:true" width="50"><?php echo lang('created_date')?></th>

    <th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
    </thead>
</table>

<div id="toolbar" style="padding:5px;height:auto">
    <p>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_event_artist')?>"><?php  echo lang('create')?></a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_event_artist')?>"><?php  echo lang('remove_selected')?></a>
    </p>

</div> 

<!--for create and edit event_artist form-->
<div id="dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-event_artist" method="post" >
    <table>
		<tr>
		              <td width="34%" ><label><?php echo lang('artist')?>:</label></td>
					  <td width="66%"><input name="artist_id" id="artist_id" class="" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('event')?>:</label></td>
					  <td width="66%"><input name="event_id" id="event_id" class="" required="true"></td>
		       </tr><input type="hidden" name="event_artist_id" id="event_artist_id"/>
    </table>
    </form>
	<div id="dlg-buttons">
		
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:$('#dlg').window('close')"><?php  echo  lang('general_cancel')?></a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onClick="save()"><?php  echo  lang('general_save')?></a>
	</div>    
</div>
<!--div ends-->
   
</div>
</div>
<script language="javascript" type="text/javascript">
	$(function(){
	   
        <?php easyui_combobox('search_artist_id','ARTIST');
            easyui_combobox('artist_id','ARTIST');
            easyui_combobox('search_event_id','EVENT');
            easyui_combobox('event_id','EVENT')
       ?>
		$('#clear').click(function(){
			$('#event_artist-search-form').form('clear');
			$('#event_artist-table').datagrid({
				queryParams:null
				});

		});

		$('#search').click(function(){
			$('#event_artist-table').datagrid({
				queryParams:{data:$('#event_artist-search-form').serialize()}
				});
		});		
		$('#event_artist-table').datagrid({
			url:'<?php  echo site_url('event_artist/admin/event_artist/json')?>',
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
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_event_artist')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removeevent_artist('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_event_artist')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
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
		$('#form-event_artist').form('clear');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_event_artist')?>');
		//uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#event_artist-table').datagrid('getRows')[index];
		if (row){
			$('#form-event_artist').form('load',row);
			//uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_event_artist')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	
		
	function removeevent_artist(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#event_artist-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('event_artist/admin/event_artist/delete_json')?>', {id:[row.event_artist_id]}, function(){
					$('#event_artist-table').datagrid('deleteRow', index);
					$('#event_artist-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#event_artist-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].event_artist_id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('event_artist/admin/event_artist/delete_json')?>',{id:selected},function(data){
						$('#event_artist-table').datagrid('reload');
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
		$('#form-event_artist').form('submit',{
			url: '<?php  echo site_url('event_artist/admin/event_artist/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-event_artist').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#event_artist-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close
		
		});		
		
	}
	
	
</script>