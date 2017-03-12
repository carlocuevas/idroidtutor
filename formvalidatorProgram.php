<form action="sampleProgramUploaderUpdate.php" id="addNewSampleProgram" method="post" enctype="multipart/form-data">
	<div class="input-control text full-size" data-role="input">
		<input type="text" name="ProgramTitle" id="ProgramTitles"/>
	</div>
	<div class="input-control file full-size" id="thisBox4" data-role="input" >
	    <input type="file"  id="file4" onchange="blankFiles4();"   name="filesp_array[]" placeholder="Place File Here!">
	    <button class="button"><span class="mif-folder"></span></button>

	</div>
	<button class="button text-shadow" onClick="edit(diaglogSampleProgramUpload)" id="addingProgram" disabled>Add Program </button>
</form>			