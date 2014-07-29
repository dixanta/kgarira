<div data-options="region:'center',title:'Venue',tools:'#venue-toolbar'">  
    
<div id="venue-tab" class="easyui-tabs" style="width:auto;height:auto" data-options="fit:true,tabPosition:'bottom'">  
                        <div title="Venue">  
                            <table id="venue-table" style="height:auto;width:auto" data-options="border:false,singleSelect:true,pagination:true,fit:true,rownumbers:true">  
                                <thead>  
                                    <tr>  
                                        <th data-options="field:'venue_id',sortable:true" width="80">Venue ID</th>  
                                        <th data-options="field:'venue_name',sortable:true" width="200">Venue Name</th>  
                                        <th data-options="field:'address',sortable:true" width="200">Address</th>  
                                        <th data-options="field:'created_date',sortable:true" width="80">Created Date</th>  
                                      
                                        <th data-options="field:'action',align:'center',formatter:formatAction" width="250">Action</th>  
                                    </tr>  
                                </thead>  
                            </table>   
                        </div>    
                </div>    
  
        <!--venue toolbar-->
        <div id="venue-toolbar">  
            <a href="javascript:void(0)" class="icon-add" onclick="create()"></a>  
	    </div> 
        <!--venue toolbar-->  
<div id="venue-dialog" class="easyui-dialog" style="width:500px;height:auto;padding:10px 20px"
            data-options="closed:true,collapsible:true,buttons:'#dlg-buttons',title:'Add Shortcut',modal:true">
        <form id="form-venue" method="post" >
        <table>
            <tr>
               	<td width="34%" ><label>Name:</label></td>
            	<td width="66%"><input name="venue_name" id="venue_name" class="easyui-validatebox" required="true"></td>
           </tr>
            <tr>
               	<td width="34%" ><label>Description:</label></td>
            	<td width="66%"><textarea name="venue_description" id="venue_description" class="easyui-validatebox" required="true"></textarea></td>
           </tr>           
            <tr>
               	<td width="34%" ><label>Address:</label></td>
            	<td width="66%"><input name="address" id="address" class="easyui-validatebox" required="true"></td>
           </tr>           
            <tr>
               	<td width="34%" ><label>Longitude:</label></td>
            	<td width="66%"><input name="longitude" id="longitude"/></td>
           </tr>           
            <tr>
               	<td width="34%" ><label>Latitude:</label></td>
            	<td width="66%"><input name="latitude" id="latitude"/>
                <a href="javascript:void(0)"  onclick="mapLocation()">Find Location</a>
                </td>
           </tr>           

                   <input type="hidden" name="venue_id"/>
        </table>
        </form>
            <div id="dlg-buttons">
                <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onClick="saveVenue()">Save</a>
                <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:$('#venue-dialog').window('close')">Cancel</a>
            </div>             
        </div>

       <div id="map-dialog" class="easyui-dialog" style="width:500px;height:500px;top:10px;padding:20px"
            data-options="closed:true,collapsible:true,modal:true">
            <div id="map_canvas" style="width:440px;height:420px"></div>
       </div>       
</div>
<div data-options="region:'east',split:true" title="East" style="width:220px;">
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('#venue-table').datagrid({url:'<?php echo site_url('admin/venue/json')?>'});

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
	
					$('#address').val(results[0].formatted_address);
					$('#longitude').val(location.lng());
					$('#latitude').val(location.lat());
					$('#map-dialog').window('close');
				}
			});
		});			

	} //close function(map)
	});

		

});

function formatAction(value,row,index)
{
	var c='<a href="javascript:void(0)" onclick="copyVenue('+row.venue_id+')">copy</a>';
	var e='<a href="javascript:void(0)" onclick="editVenue('+index+')" >edit</a>';
	var d='<a href="javascript:void(0)" onclick="deleteVenue('+row.venue_id+')">delete</a>';
	return  c + ' ' + e + ' '+ d;
}

function create()
{
	$('#form-venue').form('clear');
	$('#venue-dialog').window('setTitle','Create Venue');
	$('#venue-dialog').window('open');
	
}

function mapLocation()
{
	
	$('#map-dialog').window('setTitle','Find Longitude Latitude');
	$('#map-dialog').window('open');
	
}



function saveVenue()
{
	$.messager.progress();	// display the progress bar
	$('#form-venue').form('submit', {
		url: '<?php echo site_url('admin/venue/save')?>',
		onSubmit: function(){
			var isValid = $(this).form('validate');
			if (!isValid){
				$.messager.progress('close');	// hide progress bar while the form is invalid
			}
			return isValid;	// return false will stop the form submission
		},
		success: function(data){
			$.messager.progress('close');	// hide progress bar while submit successfully
			var data = eval('('+data+')');
			
			if(data.success)
			{
				$('#venue-table').datagrid('reload');
				$('#venue-dialog').window('close');
			}
			else{
				$.messager.alert('Error','Error occured');
			}
		}
	});	
}

function copyVenue(id)
{
	$.messager.confirm('Copy','Are you sure to copy ?',function(r){
		if(r){
			$.post('<?php echo site_url('admin/venue/copy')?>',{id:id},function(data){
				if(data.success)
					$('#venue-table').datagrid('reload');
				else{
					//
				}
						
			},'json');
		}
	});
}

function deleteVenue(id)
{
	$.messager.confirm('Delete','Are you sure to delete ?',function(r){
		if(r){
			$.post('<?php echo site_url('admin/venue/delete')?>',{id:[id]},function(data){
				if(data.success)
					$('#venue-table').datagrid('reload');
				else{
					//
				}
						
			},'json');
		}
	});
}

function editVenue(index)
{
	var row=$('#venue-table').datagrid('getRows')[index];
	if(row){
		$('#form-venue').form('load',row);
		$('#venue-dialog').window('setTitle','Edit Venue');
		$('#venue-dialog').window('open');			
	}
	else
	{
		$.messager.alert('Error','Please select venue to edit');
	}
}
</script>

