<div region="center" border="false"> 
<div style="padding:20px">
<div id="search-panel" class="easyui-panel" data-options="title:'<?php  echo lang('venue_search')?>',collapsible:true,iconCls:'icon-search'" style="padding:5px">
<form action="" method="post" id="venue-search-form">
<table width="100%" border="1" cellspacing="1" cellpadding="1">
<tr><td><label><?php echo lang('venue_name')?></label>:</td>
<td><input type="text" name="search[venue_name]" id="search_venue_name"  class="easyui-validatebox"/></td>
<td><label><?php echo lang('venue_type')?></label>:</td>
<td><input type="text" name="search[venue_type_id]" id="search_venue_type_id"  class=""/></td>
</tr>
<tr>
<td><label><?php echo lang('venue_location')?></label>:</td>
<td><input type="text" name="search[venue_location]" id="search_venue_location"  class="easyui-validatebox"/></td>
</tr>
<tr>
<td><label><?php echo lang('cusine')?></label>:</td>
<td><input type="text" name="search[cusine]" id="search_cusine"  class="easyui-validatebox"/></td>
<td><label><?php echo lang('food_price_range')?></label>:</td>
<td><input type="text" name="search[food_price_range]" id="search_food_price_range"  class="easyui-validatebox"/></td>
</tr>
<tr>
<td><label><?php echo lang('drink_price_range')?></label>:</td>
<td><input type="text" name="search[drink_price_range]" id="search_drink_price_range"  class="easyui-validatebox"/></td>
<td><label><?php echo lang('status')?></label>:</td>
<td><input type="radio" name="search[status]" id="search_status1" value="1"/><?php echo lang('general_yes')?>
									<input type="radio" name="search[status]" id="search_status0" value="0"/><?php echo lang('general_no')?></td>
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
<table id="venue-table" data-options="pagination:true,title:'<?php  echo lang('venue')?>',pagesize:'20', rownumbers:true,toolbar:'#toolbar',collapsible:true,fitColumns:true">
    <thead>
    <th data-options="field:'checkbox',checkbox:true"></th>
    <th data-options="field:'venue_id',sortable:true" width="30"><?php echo lang('venue_id')?></th>
    <th data-options="field:'venue_name',sortable:true" width="80"><?php echo lang('venue_name')?></th>
    <th data-options="field:'venue_type',sortable:true" width="50"><?php echo lang('venue_type')?></th>
    <th data-options="field:'venue_location',sortable:true" width="50"><?php echo lang('venue_location')?></th>
    <th data-options="field:'cusine',sortable:true" width="50"><?php echo lang('cusine')?></th>
    <th data-options="field:'food_price_range',sortable:true" width="50"><?php echo lang('food_price_range')?></th>
    <th data-options="field:'drink_price_range',sortable:true" width="50"><?php echo lang('drink_price_range')?></th>
    <th data-options="field:'venue_image',sortable:true,formatter:formatImage" width="50"><?php echo lang('venue_image')?></th>
    <th data-options="field:'status',sortable:true,formatter:formatStatus" width="30" align="center"><?php echo lang('status')?></th>
    <th field="action" width="100" formatter="getActions"><?php  echo lang('action')?></th>
    </thead>
</table>

<div id="toolbar" style="padding:5px;height:auto">
    <p>
    <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="create()" title="<?php  echo lang('create_venue')?>"><?php  echo lang('create')?></a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="removeSelected()"  title="<?php  echo lang('delete_venue')?>"><?php  echo lang('remove_selected')?></a>
    </p>

</div> 

<!--for create and edit venue form-->
<div id="dlg" class="easyui-dialog" style="width:800px;height:auto;padding:10px 20px;top:10px"
        data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',modal:true">
    <form id="form-venue" method="post" >
    <table>
    
		<tr>
		              <td width="34%" ><label><?php echo lang('venue_name')?>:</label></td>
					  <td width="66%"><input name="venue_name" id="venue_name" class="easyui-validatebox" required="true"></td>
		              <td width="34%" ><label><?php echo lang('venue_type')?>:</label></td>
					  <td width="66%"><input name="venue_type_id" id="venue_type_id" class="" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('venue_description')?>:</label></td>
					  <td width="66%" colspan ="3"><textarea name="venue_description" id="venue_description" class="easyui-validatebox" required="true" style="width:300px"></textarea></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('venue_location')?>:</label></td>
					  <td width="66%"><input name="venue_location" id="venue_location" class="easyui-validatebox" required="true" ></td>
                      <td colspan="2"><a href="javascript:void(0)"  onclick="mapLocation()">Find Location</a></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('venue_longitude')?>:</label></td>
					  <td width="66%"><input name="venue_longitude" id="venue_longitude" class="easyui-validatebox" required="true"></td>
		              <td width="34%" ><label><?php echo lang('venue_latitude')?>:</label></td>
					  <td width="66%"><input name="venue_latitude" id="venue_latitude" class="easyui-validatebox" required="true"></td>
                       
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('cusine')?>:</label></td>
					  <td width="66%"><input name="cusine" id="cusine" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('venue_drink')?>:</label></td>
					  <td width="66%"><input name="venue_drink" id="venue_drink" class="easyui-validatebox" required="true"></td>
		              <td width="34%" ><label><?php echo lang('venue_food')?>:</label></td>
					  <td width="66%"><input name="venue_food" id="venue_food" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('drink_price_range')?>:</label></td>
					  <td width="66%"><input name="drink_price_range" id="drink_price_range" class="easyui-validatebox" required="true"></td>
                      <td width="34%" ><label><?php echo lang('food_price_range')?>:</label></td>
					  <td width="66%"><input name="food_price_range" id="food_price_range" class="easyui-validatebox" required="true"></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('venue_image')?>:</label></td>
					  <td width="66%"><label id="upload_image_name" style="display:none"></label>
                      <input name="venue_image" id="venue_image" type="text" style="display:none"/>
                      <input type="file" id="upload_image" name="userfile" style="display:block"/>
                      <a href="#" id="change-image" title="Delete" style="display:none"><img src="<?=base_url()?>assets/icons/delete.png" border="0"/></a></td>
		       </tr><tr>
		              <td width="34%" ><label><?php echo lang('status')?>:</label></td>
					  <td width="66%"><input type="radio" value="1" name="status" id="status1" /><?php echo lang("general_yes")?> <input type="radio" value="0" name="status" id="status0" /><?php echo lang("general_no")?></td>
		       </tr><input type="hidden" name="venue_id" id="venue_id"/>
    </table>
    </form>
	<div id="dlg-buttons">
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:$('#dlg').window('close')"><?php  echo  lang('general_cancel')?></a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onClick="save()"><?php  echo  lang('general_save')?></a>
	</div>    
    
     <div id="map-dialog" class="easyui-dialog" style="width:500px;height:500px;top:10px;padding:20px"
            data-options="closed:true,collapsible:true,modal:true">
            <div id="map_canvas" style="width:440px;height:420px"></div>
       </div>  
</div>
<!--div ends-->
   
</div>
</div>
<script language="javascript" type="text/javascript">
	$(function(){
	   
       <?php easyui_combobox('search_venue_type_id','VENUE_TYPE');
            easyui_combobox('venue_type_id','VENUE_TYPE');
            tinymce('venue_description');
       ?>
		$('#clear').click(function(){
			$('#venue-search-form').form('clear');
			$('#venue-table').datagrid({
				queryParams:null
				});

		});

		$('#search').click(function(){
			$('#venue-table').datagrid({
				queryParams:{data:$('#venue-search-form').serialize()}
				});
		});		
		$('#venue-table').datagrid({
			url:'<?php  echo site_url('venue/admin/venue/json')?>',
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
					$.post('<?php echo site_url('venue/admin/venue/upload_delete')?>',{filename:$('#venue_image').val()},function(data){
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
		var e = '<a href="#" onclick="edit('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-edit"  title="<?php  echo lang('edit_venue')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-edit"></span></span></a>';
		var d = '<a href="#" onclick="removevenue('+index+')" class="easyui-linkbutton l-btn" iconcls="icon-remove"  title="<?php  echo lang('delete_venue')?>"><span class="l-btn-left"><span style="padding-left: 20px;" class="l-btn-text icon-cancel"></span></span></a>';
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
		$('#form-venue').form('clear');
        tinymce.get('venue_description').setContent('');
		$('#dlg').window('open').window('setTitle','<?php  echo lang('create_venue')?>');
        $('#upload_image_name').html('').hide();
		$('#change-image').hide();
		$('#upload_image').show();
		uploadReady(); //Uncomment This function if ajax uploading
	}	

	function edit(index)
	{
		var row = $('#venue-table').datagrid('getRows')[index];
		if (row){
			$('#form-venue').form('load',row);
            if(row.venue_image!='')
			{
				$('#upload_image_name').html(row.venue_image).show();
				$('#change-image').show();
				$('#upload_image').hide();
			}
			uploadReady(); //Uncomment This function if ajax uploading
			$('#dlg').window('open').window('setTitle','<?php  echo lang('edit_venue')?>');
		}
		else
		{
			$.messager.alert('Error','<?php  echo lang('edit_selection_error')?>');				
		}		
	}
	
		
	function removevenue(index)
	{
		$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
			if (r){
				var row = $('#venue-table').datagrid('getRows')[index];
				$.post('<?php  echo site_url('venue/admin/venue/delete_json')?>', {id:[row.venue_id]}, function(){
					$('#venue-table').datagrid('deleteRow', index);
					$('#venue-table').datagrid('reload');
				});

			}
		});
	}
	
	function removeSelected()
	{
		var rows=$('#venue-table').datagrid('getSelections');
		if(rows.length>0)
		{
			selected=[];
			for(i=0;i<rows.length;i++)
			{
				selected.push(rows[i].venue_id);
			}
			
			$.messager.confirm('Confirm','<?php  echo lang('delete_confirm')?>',function(r){
				if(r){				
					$.post('<?php  echo site_url('venue/admin/venue/delete_json')?>',{id:selected},function(data){
						$('#venue-table').datagrid('reload');
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
		$('#form-venue').form('submit',{
			url: '<?php  echo site_url('venue/admin/venue/save')?>',
			onSubmit: function(){
				return $(this).form('validate');
			},
			success: function(result){
				var result = eval('('+result+')');
				if (result.success)
				{
					$('#form-venue').form('clear');
					$('#dlg').window('close');		// close the dialog
					$.messager.show({title: '<?php  echo lang('success')?>',msg: result.msg});
					$('#venue-table').datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.show({title: '<?php  echo lang('error')?>',msg: result.msg});
				} //if close
			}//success close
		
		});		
		
	}
    
    
    $(document).ready(function() {
	//$('#venue-table').datagrid({url:'<?php echo site_url('admin/venue/json')?>'});

	$('#map_canvas').gmap({'disableDefaultUI':false,'callback': function(map) {
			var self = this;
		$(map).click(function(event){
			self.addMarker({'position': event.latLng, 'draggable': true, 'bounds': false}, function(map, marker){
				self.get('findLocation')(marker.getPosition(), marker);
			}).dragend( function(event) {
				self.get('findLocation')(event.latLng, this);
			});
		});	

		self.set('findLocation', function(location, marker) {
			self.search({'location': location}, function(results, status) {

				if ( status === 'OK' ) {
						lat=results[0].geometry.location.lat();
						lng=results[0].geometry.location.lng();
						
					$.each(results[0].address_components, function(i,v) {
						if ( v.types[0] == "administrative_area_level_1" || v.types[0] == "administrative_area_level_2" ) {
							//$('#state').html(v.long_name);
						} else if ( v.types[0] == "country") {
							//$('#country').html(v.long_name);
						}
					});
	
					$('#venue_location').val(results[0].formatted_address);
					$('#venue_longitude').val(location.lng());
					$('#venue_latitude').val(location.lat());
					$('#map-dialog').window('close');
				}
			});
		});			

	} //close function(map)
	});

		

});


function mapLocation()
{
	
	$('#map-dialog').window('setTitle','Find Longitude Latitude');
	$('#map-dialog').window('open');
	
}


function uploadReady()
	{
		uploader=$('#upload_image');
		new AjaxUpload(uploader, {
			action: '<?php  echo site_url('venue/admin/venue/upload_image')?>',
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
					$('#venue_image').val(filename);
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
    
    function formatImage(value)
	{
		if(value!='')
		{
			return '<img src="<?php echo base_url()?>uploads/venue/thumb/' + value + '" height="50" width="50">';
		}
		return '';
	}
	
	
</script>