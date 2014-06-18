<div region="center" border="false">
<div style="padding:20px">
<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('test_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
<form action="" method="post" id="test-search-form">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr><td><label><?php echo lang('test_name')?></label>:</td>
<td><input type="text" name="search[test_name]" id="search_test_name"  class="easyui-validatebox"/></td>
<td><label><?php echo lang('status')?></label>:</td>
<td><input type="radio" name="search[status]" id="search_status1" value="1"/><?php echo lang('general_yes')?>
									<input type="radio" name="search[status]" id="search_status0" value="0"/><?php echo lang('general_no')?></td>
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
<table id="test-table" data-options="pagination:true,title:'<?php  echo lang('test')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
    <thead>
    <th data-options="field:'checkbox',checkbox:true"></th>
    <th data-options="field:'test_id',sortable:true" width="30"><?php echo lang('test_id')?></th>
<th data-options="field:'test_name',sortable:true" width="50"><?php echo lang('test_name')?></th>
<th data-options="field:'status',sortable:true,formatter:formatStatus" width="30" align="center"><?php echo lang('status')?></th>

    <th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
    </thead>
</table>

<div id="toolbar" style="padding:5px;height:auto">
    <p>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_test')?>"><?php  echo lang('create')?></a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_test')?>"><?php  echo lang('remove_selected')?></a>
    </p>

</div> 

<!--for create and edit test form-->
<div id="dlg" class="easyui-dialog" style="width:600px;height:auto;padding:10px 20px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-test" method="post" >
    <table>
		<tr>
		              <td width="34%" ><label><?php echo lang('test_name')?>:</label></td>
					  <td width="66%"><input name="test_name" id="test_name" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('test_description')?>:</label></td>
					  <td width="66%"><textarea name="test_description" id="test_description" class="easyui-validatebox" required="true" style="width:300px;height:100px"></textarea></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('status')?>:</label></td>
					  <td width="66%"><input type="radio" value="1" name="status" id="status1" /><?php echo lang("general_yes")?> <input type="radio" value="0" name="status" id="status0" /><?php echo lang("general_no")?></td>
		       </tr><input type="hidden" name="test_id" id="test_id"/>
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
			$('#test-search-form').form('clear');
			$('#test-table').datagrid({
				queryParams:null
				});

		});

		$('#search').click(function(){
			$('#test-table').datagrid({
				queryParams:{data:$('#test-search-form').serialize()}
				});
		});		
		$('#test-table').datagrid({
			url:'<?php  echo site_url('test/admin/test/json')?>',
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
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_test')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removetest('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_test')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
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
		$('#form-test').form('clear');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_test')?>');
		//uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#test-table').datagrid('getRows')[index];
		if (row){
			$('#form-test').form('load',row);
			//uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_test')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	
		
	function removetest(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#test-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('test/admin/test/delete_json')?>', {id:[row.test_id]}, function(){
					$('#test-table').datagrid('deleteRow', index);
					$('#test-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#test-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].test_id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('test/admin/test/delete_json')?>',{id:selected},function(data){
						$('#test-table').datagrid('reload');
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
		$('#form-test').form('submit',{
			url: '<?php  echo site_url('test/admin/test/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-test').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#test-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close
		
		});		
		
	}
	
	
</script>