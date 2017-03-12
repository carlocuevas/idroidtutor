<?php
//Cancel Upload Nalang
	require 'dbconfig.php';
	if(isset($_POST['video']))
		{
			?>
			
			<h1 class="text-light" style="font-weight:10px;">Video's Area</h1>
					<div class="row flex-content-stretch">
						<div class="full-size padding10 bg-white" style="padding-top:0;padding-bottom:0;		    border:0.5px solid black;">
									<div id="cell-contentx">
									</div>
						</div>
						<div class="cell colspan4 padding5 bg-grey" style="padding-top:0;padding-bottom:0">
						<form action="videoUploader.php" id="upload" method="post" enctype="multipart/form-data">
							<div class="padding10 bg-white " style="padding:bottom:0;padding-top:0;border:0.5px solid black;">
								<div class="cell padding10 bg-white" style="height:77.9vh;">
								<label class="text-light">Input video here</label>
								
									<div class="input-control file full-size" id="thisBox" data-role="input" style="width:15rem;">
									    <input type="file" onchange="vidValid()"  name="file" id="vidUrl">
									    <button class="button"><span class="mif-folder"></span></button>

									</div>
								<label class="text-light">Input video title here</label>
								<div class="input-control text full-size" data-role="input" style="width:25rem;">
								    <input type="text" onKeyUp="vidValid()" name="vidTitle" id="filename2" maxlength="20">
								</div>
								<center>
									<button class="button text-shadow" id="UploadButton2" onClick="edit(dialogLoadVid);" disabled>Upload Video</button>	

								</center>
							</div>
							</div>
								<div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-width="50%" id="dialogLoadVid" style="border:0.5px solid black;">
									<div class="cell auto-size paddin0 bg-grey" style="padding-left:0; padding-right:0;padding-top:0;">
												<div class="cell-colspan8 padding10 bg-white" style="height:1%;overflow:hidden;" >
													<h3 class="text-light"> <span id="sct-1">0%</span> Uploading Progress  ...</h3>
													<div class="progress small" data-role="progress" data-color="bg-violet" id="pb1"></div>		
													<button class="button success text-shadow" id="CancelsUpload">Cancel Upload</button>								
												</div>
											</div>
						        </div>
						</form>
				   		</div>
				   	</div>
	            <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" id="dialogEditVid">
	            		   <h2>Edit title of video "<span id="videoTi"></span>"</h2>
	                       <input type="hidden" id="vidsIDs"/>
	                       <label class="text-light">Video Title</label>
	                       <div class="input-control text full-size">
	                       		<input type="text" id="videoT"/>
	                       </div>
	                       <button class="button full-size" id="VideoUpdater" onClick="updateVid();">Update title of video</button>
	            </div>
                <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" id="dialogDeleteConfirmationVideo" data-close-button="true">
            		   <h3>Are you sure you want to delete "<span id="vidTi"></span>"?</h3>
                       <input type="hidden" id="vidIDs"/>
                       <button class="button full-size" id="Yes" onClick="DeleteVideo()">Yes</button>
                       <button class="button full-size" id="No" onClick="hideMetroDialog(dialogDeleteConfirmationVideo)">No</button>
            
          		</div>
<script type="text/javascript">
    var interval1;
	showVids();	
	function updateVid()
		{
			var VideoID = $("#vidsIDs").val();
			var VideoTitleUpdate = $("#videoT").val();
			$.ajax
			({
					url : 'videomaintenance.php',
					type : 'POST',
					async : false,
					data : 
					{	
						VidsID : VideoID,
						VideoTitleNew : VideoTitleUpdate,
						updateVideo : 1
					},
					success : function (updatedVid)
					{
		                $.Notify({
			                caption: 'Update Video Title',
			                content: 'Update Success' ,
			                icon: "<span class='mif-pencil icon'></span>",
			                type: "success"
		                });  
						showVids();
						hideMetroDialog("#dialogEditVid");
					}
			});
		}
	function showVids()
		{
			$.ajax
			({
					url : 'videomaintenance.php',
					type : 'POST',
					async : false,
					data : 
					{	
						showVid : 1
					},
					success : function (z)
					{
						$("#cell-contentx").html(z);
					}
			});
		}
	function DeleteVideo()
		{
			var Del = $("#vidIDs").val();
			$.ajax 
			({
					url : "videomaintenance.php",
					type : 'POST',
					async : false,
					data : 
					{	
						deleteV1 : 1,
						VideoID : Del
					},
					success : function (del)
					{
				        $.Notify({
				            caption: 'Delete',
				            content: 'Record has been Deleted',
				            icon: "<span class='mif-bin icon'></span>",
				            type: "alert"
				        });
				        hideMetroDialog("#dialogDeleteConfirmationVideo");
						showVids();
					}
			});
		}
	$('body').delegate('.DelV','click',function()
		{
			var DeleteVideos = $(this).attr('idDelV');
			$.ajax
			({
					url : "videomaintenance.php",
					type : 'POST',
					async : false,
					data : 
					{	
						deleteV : 1,
						ideL : DeleteVideos
					},
					success : function (delV)
					{
						document.getElementById("vidTi").innerHTML = delV.videoTitle;
						$("#vidIDs").val(DeleteVideos);
						
					}
			});
		});
	$('body').delegate('.EditVid','click',function()
		{
			var EditVideoTitle = $(this).attr('idEditV');
			$.ajax
			({
					url : "videomaintenance.php",
					type : 'POST',
					async : false,
					data : 
					{	
						editVid : 1,
						ideL : EditVideoTitle
					},
					success : function (eLV)
					{
						document.getElementById("videoTi").innerHTML = eLV.videoTitle;
						$("#videoT").val(eLV.videoTitle);
						$("#vidsIDs").val(EditVideoTitle);
						
					}
			});
		});
	var main = function()
		{
			$("#upload").on("submit", function(er)
			{
				er.preventDefault();
				$(this).ajaxSubmit(
				{
					beforeSend:function()
					{
						$("#prog").attr("value","0");
					},
					uploadProgress:function(event,position,total,percentComplete)
					{
						        clearInterval(interval1);
						        var pb = $("#pb1").data('progress');
						            pb.set(percentComplete);
								$("#sct-1").html(percentComplete+'%');
					},
					success:function(data)
					{
						showVids();
						$("#sct-1").html("0"+'%');
						var pb = $("#pb1").data('progress');
        				pb.set(0);
				        $.Notify({
				            caption: 'Inserted',
				            content: 'Video File has been Uploaded',
				            icon: "<span class='mif-video-camera icon'></span>",
				            type: "info"
				        });
	                    hideMetroDialog("#dialogLoadVid");
				        SelectVideos();
					}
				});
			});
		};
            $(document).on('click', '#CancelsUpload', function(e){    
            	var XHR= new XMLHttpRequest();   
			    window.stop();
			    hideMetroDialog("#dialogLoadVid");
			    $("#sct-1").html("0"+'%');
			    var pb=$('#pb1').data('progress');
			    	pb.set(0);
			});
	function vidValid()
			{
				var id_value = document.getElementById('vidUrl').value;		 
				 	if(id_value != '')
							{ 
							  var valid_extensions = /(.mp4|.avi)$/i;   
							  if(valid_extensions.test(id_value))
							 	 { 
							  		 $("#thisBox").addClass("success");
							  		 document.getElementById("UploadButton2").disabled = false;
								 }
						 	  else
								  {
							   		$("#thisBox").addClass('error');
							   		document.getElementById("UploadButton2").disabled = true;
								  }
						 	} 
				if(document.getElementById("filename2").value != "" && document.getElementById("vidUrl").value != "" && $("#vidUrl").hasClass('success'))
					{
						document.getElementById("UploadButton2").disabled = false;
					}
				if(document.getElementById("filename2").value == ""  || document.getElementById("vidUrl").value == "")
					{
						document.getElementById("UploadButton2").disabled = true;
					}
			}
	function vali_type()
		{ 
		 
		}			
	$(document).ready(main);
</script>
				<?php
			}
exit();

?>