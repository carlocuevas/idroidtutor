<?php

require 'dbconfig.php';
if(isset($_POST['Glossary']))
{
	?>
		<h1 class="text-light" style="font-weight:10px;">Glossary</h1>
 			<div class="row cell-auto-size">
				<div class="cell full-size padding10 bg-grey " style="padding:bottom:0;padding-top:0;">
						<div class="padding10 bg-white" style="height:77.3vh;border:0.5px solid black;overflow:hidden;">
						<label class="text-light">Select Letter</label>
                   		<div class="input-control select full-size" data-role="input" id="letterFinder"></div>
						<label class="text-light">Enter the Word</label>
						<div class="input-control text full-size" data-role="input">
							<input type="text" id="word"/>
						</div>
						<label class="text-light">Meaning</label>
						<div class="input-control textarea full-size" data-role="input">
							<textarea id="meaning"></textarea>
						</div>
						<button class="button" id="AddNewMeaning" onClick="addNewMeaning()">Add new Meaning</button>
					</div>
			     </div>	
			     <div class="cell full-size padding0 bg-grey">
						<div class="padding10 bg-white" style="height:77.3vh;border:0.5px solid black;overflow:hidden;">
							<div id="ShowLetters"></div>
						</div>
				</div>
			</div>

			
            
            <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="50%" id="dialogViewMeanings" data-close-button="true">
            </div>
            <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="50%" id="diaglogDeleteLetter" data-close-button="true">
            		   <h4>Deleting Letter :  <br/>"<span id="letter"></span>" other words starting from it will be deleted?</h4>
                <br/>
                       <input type="hidden" id="letterID" value=""/>
                       <button class="button full-size" id="Yes" onClick="DeleteLetter()">Yes</button>
                       <button class="button full-size" id="No" onClick="hideMetroDialog('#dialogConfirmationDeleteLetter')">No</button>
            
            </div>		
			<script>

				selectGlossaryLetter();
				showLetters();
				var interval2;
				function addNewMeaning()
					{
						var word=$("#word").val();
						var Letter=$("#selectLetter").val();
						var Meaning=$("#meaning").val();
						$.ajax
						({
							url : "glossarymaintenance.php",
							type : "POST",
							async : false,
							data : {
								word:word,
								Letter:Letter,
								Meaning:Meaning,
								adder:1
							},
							success : function(aa)
							{	
									Glossary();
							        $.Notify({
							            caption: 'Inserted',
							            content: 'Word has been Inserted',
							            icon: "<span class='mif-language icon'></span>",
							            type: "info"
							        });
							}
						});	
					}
				function DeleteLetter()
					{
						var idDelLetters = $("#letterID").val();
						$.ajax
						({
								url : 'glossarymaintenance.php',
								type : 'POST',
								async : false,
								data : 
								{	
									deleteLetter1 : 1,
									idLett : idDelLetters
								},
								success : function (updatedVid)
								{
									showLetters();
							        $.Notify({
							            caption: 'Delete',
							            content: 'Letter has been Deleted',
							            icon: "<span class='mif-bin icon'></span>",
							            type: "alert"
							        });
									hideMetroDialog("#diaglogDeleteLetter");
								}
						});
					}	
            	$('body').delegate('.EditPDF','click',function()
					{
						var idPDF = $(this).attr('idEditP');
						$.ajax
						({
								url : "pdfmaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									editPDF : 1,
									idPD : idPDF
								},
								success : function (elPDF)
								{
								}
						});
					});
				$('body').delegate('.deleLet','click',function()
					{
						var delLetter = $(this).attr("idDelLet");
						$.ajax 
						({
								url : "glossarymaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									deleteLetter : 1,
									idDelete : delLetter
								},
								success : function (delLet)
								{
									document.getElementById("letter").innerHTML = delLet.letterStarts;
									$("#letterID").val(delLet.glossaryID);
								}
						});
					});             
				$('body').delegate('.ViewPrograms','click',function()
					{
						var LessonID = $(this).attr('idVM');
						$.ajax
						({
								url : "glossarymaintenance.php",
								type : 'POST',
								async : false,
								data : 
								{	
									showMeanings : 1,
									idPD : LessonID
								},
								success : function (elPDF)
								{
									$("#dialogViewMeanings").html(elPDF);
								}
						});
					});
				function selectGlossaryLetter()
					{
						$.ajax
						({
							url : "selectGlossaryLetter.php",
							type : "POST",
							async : false,
							data : {
								selector:1
							},
							success : function(letter)
							{
								$("#letterFinder").html(letter)
							}
						});
					}
				function showLetters()
					{
						$.ajax
						({

							url:"glossarymaintenance.php",
							type:"POST",
							async:false,
							data:{
								showLet : 1
							},
							success:function(letters)
							{
								$("#ShowLetters").html(letters);
							}

						});	
					}

			</script>
		<?php
		exit();
}

?>