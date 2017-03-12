<?php
//OK na Video Maintenance Connection nalang sa mga Database
//wala pa si quiz
//wala pa si pdf -- 50/50 ilalagay nalang si upload
//wala pa si texts
session_start();
		require 'dbconfig.php';
        if(!isset($_SESSION['deanID']))
            {
                header("location:index.php");   
            }
        if(isset($_POST['LogOut']))
            {

                session_destroy();
                header("location:index.php");
                exit();

            }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Backend</title>
        <link rel="icon" href="images/logo1.png" type="image/png" sizes="16x16">
        <!-- sources -->
        <link href="build/css/metro.css" rel="stylesheet">
        <link href="build/css/backend.css" rel="stylesheet">
        <link href="build/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="build/css/metro-icons.css" rel="stylesheet">
        <link href="build/css/metro-schemes.css" rel="stylesheet">
        <link href="build/css/metro-responsive.css" rel="stylesheet">
        <script src="build/js/jquery-2-1-3.min.js"></script>
        <script src="build/js/jquery.form.min.js"></script>
        <script src="build/js/metro.js"></script>
        <script src="build/js/jquery.dataTables.min.js"></script>
        <script src="build/js/functionsLessons.js"></script>
        <script src="build/js/functionsQuiz.js"></script>
        <style>
            html, body {
                height: 100%;
            }
            body
            {
                background-image: url(images/background1.PNG);
                background-repeat: repeat;
            }
            .page-content {
                padding-top: 3.125rem;
                min-height: 100%;
                height: 100%;
            }
            .table .input-control.checkbox {
                line-height: 1;
                min-height: 0;
                height: auto;
            }
            @media screen and (max-width: 800px){
                #cell-sidebar {
                    flex-basis: 52px;
                }
                #cell-content {
                    flex-basis: calc(100% - 52px);
                }
            }
        </style>
        <script>
            function pushMessage(t){
                var mes = 'Info|Implement independently';
                $.Notify({
                    caption: mes.split("|")[0],
                    content: mes.split("|")[1],
                    type: t
                });
            }

            $(function(){
                $('.sidebar').on('click', 'li', function(){
                    if (!$(this).hasClass('active')) {
                        $('.sidebar li').removeClass('active');
                        $(this).addClass('active');
                    }
                })
            })
        </script>
    </head>

    <body>
        <div class="container flex-grid">
            <div class="app-bar fixed-top darcula" data-role="appbar" style="align:center;">
                <ul class="app-bar-menu">         
                </ul>
                <span class="app-bar-element branding" onclick="dashboard();">iDroidTutor: Admin's Panel</span>
                <div class="app-bar-element place-right">
                    <div class="app-bar-menu ">
                        <span class="dropdown-toggle"><span class="mif-cog"></span> Settings</span>
                        <div class="app-bar-drop-container bg-white padding10 place-right no-margin-top block-shadow fg-dark" data-role="dropdown" data-no-close="true" style="width: 320px">
                           
                            <ul class="unstyled-list fg-dark ">
                                <li onClick="edit('#dialog1')"  class="fg-white2 fg-hover-yellow" data-hotkey="alt+1">My Account</li>
<!--                                 <li onClick="edit('#dialog2')" class="fg-white2 fg-hover-yellow">Change Profile Picture</li> -->
                                <li onClick="edit('#dialogs')" class="fg-white2 fg-hover-yellow">Change Password</li> 
                                <form action="" method="POST">
                                    <li class="fg-white2 fg-hover-yellow place-right" name="LogOut"><button  name="LogOut" class="fg-white2 fg-hover-yellow text-light padding0 " style="border:0 transparent;background:transparent">Log Out</button> </li>
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content" >
                <div class="flex-grid no-responsive-feature" style="height: 100%;">
                    <div class="row" style="height: 100%;">
                            <div class="cell size-x200" id="cell-sidebar" style="background-color: #0072c6;">
                                <div class="cell align-center padding20">
                                     <img id="imaged" class="align-center cycle" data-format="cycle" style="margin-bottom:0;align:center;" width="110" height="110" >
                                     <br/>
                                     <h3 class="text-light align-center" style="color:white;">Admin <span id="AdminsName"></span></h3>
                                     <hr/>
                                </div>
                                <ul class="sidebar navy" style="background-color:#2980b9;">
                                    <li id="Chapters"><a href="#" onClick="Chapter()">
                                        <span class="mif-books icon" id="Icond"></span>
                                        <span class="title">Manage Chapter</span>
                                    </a></li>
                                    <li id="PDFss" ><a href="#" onClick="PDF();">
                                        <span class="mif-file-pdf icon"></span>
                                        <span class="title">PDF Files</span>

                                    </a></li>
                                    <li id="Vid"><a href="#" onClick="videos();">
                                        <span class="mif-file-video icon"></span>
                                        <span class="title">Video Tutorials</span>
                                    </a></li>
                                    <li id="Quize" ><a href="#" onClick="Quiz();">
                                        <span class="mif-question icon"></span>
                                        <span class="title">Quizzes</span>
                                    </a></li>
                                    <li id="Glossary" ><a href="#" onClick="Glossary();">
                                        <span class="mif-language icon"></span>
                                        <span class="title">Glossary</span>
                                    </a></li>
                                    <li id="SampleProgram" ><a href="#" onClick="SampleProgram();">
                                        <span class="mif-versions icon"></span>
                                        <span class="title">Sample Programs</span>
                                    </a></li>
                                    <li id="SampleExercise" ><a href="#" onClick="SamplExercises();">
                                        <span class="mif-layers icon"></span>
                                        <span class="title">Sample Exercises</span>
                                    </a></li>

                                </ul>
                            </div>
                        <div class="cell auto-size padding20" style="display:none;padding-top:0;height:100%;" id="cell-content">
                        </div>
                        <div class="cell auto-size padding20" style="height:77.5vh;" data-role="preloader" data-type="cycle" data-style="color"  id="loader">
                        </div>
                    </div>
                </div>
            </div>
            <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" id="dialogs" data-close-button="true">
                        <h3 class="text-light">Change Password</h3>
                                <table>
                                <tr>
                                    <td><label> Old Password: </label></td>
                                        <td><div class="input-control password" data-role="input" >
                                            <input type="password" id="oldpass" maxlength="20">
                                            <button class="button helper-button reveal"><span class="mif-looks"></span></button>
                                        </div></td>
                                </tr>
                                <tr>
                                    <td><label> New Password:</label></td>
                                        <td><div class="input-control password" data-role="input" style="padding-left:1%;">
                                            <input type="password" id="newpass" maxlength="20">
                                            <button class="button helper-button reveal"><span class="mif-looks"></span></button>
                                        </div></td>
                                </tr>
                                <tr>
                                    <td><label>Confirm Password:</label></td>
                                        <td><div class="input-control password" data-role="input">
                                            <input type="password" id="confirmpass" maxlength="20">
                                            <button class="button helper-button reveal"><span class="mif-looks"></span></button>
                                        </div></td>
                                </tr>    
                                </table>
                                    <button class="button success text-shadow" onClick="updateDean()">Change Password</button>
            </div>
            <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" id="dialog2" data-close-button="true">
                <form action="imageupload.php" method="POST" id="changeImage">
                    <h3 class="text-light header small">Change Profile Picture</h3> 
                    <div class="input-control file full-size" data-role="input">
                        <input type="file"  name="file" id="profPic">
                        <button class="button"><span class="mif-folder"></span></button>
                    </div >
                    <button class="button place-right">Change Profile Picture</button>
                    <div class="progress big" data-role="progress" data-color="bg-violet" id="pb3"></div>
                </form>
            </div>
            <div  class="padding20" data-role="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" id="dialog1" data-close-button="true">
                <h3 class="text-light"><b>My Account </b></h3>
                <br/>
                     <input type="hidden" id="DeanId" value=""/>
                     <table>
                         <tr>
                             <td>First Name</td>
                             <td>
                                <div class="input-control text">
                                    <input type="text"  id="FirstName" maxlength="20" disabled />
                                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                                </div>
                             </td>
                         </tr>
                         <tr>
                             <td>Middle Name</td>
                             <td>
                                <div class="input-control text">
                                    <input type="text"  id="MiddleName" maxlength="20" disabled/>
                                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                                </div>
                             </td>
                         </tr>
                         <tr>
                             <td>Last Name</td>
                             <td>
                                <div class="input-control text">
                                    <input type="text" id="LastName" maxlength="20" disabled/>
                                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                                </div>
                             </td>
                         </tr>
                         <tr>
                             <td>Username</td>
                             <td>
                                <div class="input-control text">
                                    <input type="text" id="UserName" maxlength="20" disabled/>
                                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                                </div>
                             </td>
                         </tr>

                     </table>
                
                <br/>
<!--                      <button class="button align-center full-size" onClick="updateDean1();">Update Profile</button> -->
                    </div>        
                    </div>
    </body>
    <script type="text/javascript">
        dashboard();
        AdminCredentials();
        function showCharm(id)
                {
                    var  charm = $(id).data("charm");
                    if (charm.element.data("opened") === true) {
                        charm.close();
                    } else {
                        charm.open();
                    }
                }
        deanStation();
        
        function deanStation()
            {
                    var deanID="<?php echo $_SESSION['deanID'] ?>"; 
                    $.ajax
                    ({
                            url : "deanmaintenance.php",
                            type : 'POST',
                            async : false,
                            data : 
                            {   
                                editAcc1 : 1,
                                accountID:deanID
                            },
                            success : function (edit)
                            {
                                        $("#FirstName").val(edit.firstname);
                                        $("#MiddleName").val(edit.middlename);
                                        $("#LastName").val(edit.lastname);
                                        $("#UserName").val(edit.username);

                            }
                    });
            }
        function updateDean()
            {
                var old= $("#oldpass").val();
                var newp= $("#newpass").val();
                var conf= $("#confirmpass").val();

                $.ajax
                ({
                    url : 'deanmaintenance.php',
                    type : "POST",
                    async : false,
                    data : 
                    {
                        updatepas : 1,
                        old : old,
                        newp : newp,
                        conf : conf
                    },
                    success : function(success)
                    {
                        if(success == 0)
                            {
                                $.Notify({
                                caption: 'Incorrect Password',
                                content: 'Incorrect password or Password mismatch' ,
                                icon: "<span class='mif-pencil icon'></span>",
                                type: "alert"
                                });  
                            }
                        if(success == 1)
                            {
                                $.Notify({
                                caption: 'Update Password',
                                content: 'Update Success' ,
                                icon: "<span class='mif-pencil icon'></span>",
                                type: "success"
                                });  
                                hideMetroDialog("#dialogs");
                            }
                    }
                });
            }
            // function updateDean1()
            // {
            //     var deanID ="<?php echo $_SESSION['deanID']?>";
            //     var first=$("#FirstName").val();
            //     var second=$("#MiddleName").val();
            //     var third=$("#LastName").val();
            //     var uname=$("#UserName").val();
            //     $.ajax
            //     ({
            //             url : "deanmaintenance.php",
            //             type : 'POST',
            //             async : false,
            //             data : 
            //             {   
            //                 updateAccount : 1,
            //                 accountID:deanID,
            //                 f:first,
            //                 s:second,
            //                 t:third,
            //                 un:uname
            //             },
            //             success : function (editlla)
            //             {

            //                 $.Notify({
            //                     caption: 'Success',
            //                     content: 'Updation Complete',
            //                     icon: "<span class='mif-pencil icon'></span>",
            //                     type: "success"
            //                 });         
            //                 hideMetroDialog("#dialog1");
            //             }
            //     });
            // }
        function dashboard()
            {
                    $("#Lesso").removeClass('active');
                    $("#Chapters").removeClass('active');
                    $("#PDFss").removeClass('active');
                    $("#Vid").removeClass('active');
                    $("#Quize").removeClass('active');
                    $("#Glossary").removeClass('active');
                    $("#SampleProgram").removeClass('active');
                    $("#SampleExercise").removeClass('active');
                    document.getElementById("loader").style.display="block";
                    document.getElementById("cell-content").style.display="none";
                    $.ajax
                    ({
                        url : 'dashboard.php',
                        type : 'POST',
                        async : false,
                        data : 
                        {   
                            dashboard : 1
                        },
                        success : function (reDashboard)
                        {
                            document.getElementById("loader").style.display="none";
                            document.getElementById("cell-content").style.display="block";
                            $("#cell-content").html(reDashboard);
                        }
                    });
            }    
    	function Chapter()
        	{
                    $("#Chapters").addClass('active');
                    $("#PDFss").removeClass('active');
                    $("#Vid").removeClass('active');
                    $("#Quize").removeClass('active');
                    $("#Glossary").removeClass('active');
                    $("#SampleExercise").removeClass('active');
                    $("#SampleProgram").removeClass('active');
                    document.getElementById("loader").style.display="block";
                    document.getElementById("cell-content").style.display="none";
        			$.ajax
        			({
        				url : 'chapter.php',
        				type : 'POST',
        				async : false,
        				data : 
        				{	
        					chapter : 1
        				},
        				success : function (reChapter)
        				{
                            document.getElementById("loader").style.display="none";
                            document.getElementById("cell-content").style.display="block";
        					$("#cell-content").html(reChapter);
        				}
        			});
        	}
    	function PDF()
        	{
                    $("#PDFss").addClass('active');
                    $("#Chapters").removeClass('active');
                    $("#Vid").removeClass('active');
                    $("#Quize").removeClass('active');    
                    $("#Glossary").removeClass('active');  
                    $("#SampleProgram").removeClass('active'); 
                    $("#SampleExercise").removeClass('active');             
                    document.getElementById("loader").style.display="block";
                    document.getElementById("cell-content").style.display="none";
        			$.ajax
        			({
        				url : 'pdf.php',
        				type : 'POST',
        				async : false,
        				data : 
        				{	
        					PDFfiles : 1
        				},
        				success : function (pdf)
        				{
                            document.getElementById("loader").style.display="none";
                            document.getElementById("cell-content").style.display="block";
        					$("#cell-content").html(pdf);
        				}
        			});
        	}
    	function videos()
        	{
                    $("#Vid").addClass('active');
                    $("#Chapters").removeClass('active');
                    $("#PDFss").removeClass('active');
                    $("#Quize").removeClass('active');  
                    $("#Glossary").removeClass('active');
                    $("#SampleProgram").removeClass('active');
                    $("#SampleExercise").removeClass('active');
                    document.getElementById("loader").style.display="block";
                    document.getElementById("cell-content").style.display="none";
        			// add pre loader here!
        			$.ajax
        			({
        				url : 'videos.php',
        				type : 'POST',
        				async : false,
        				data : 
        				{	
        					video : 1
        				},
        				success : function (vids)
        				{
                            document.getElementById("loader").style.display="none";
                            document.getElementById("cell-content").style.display="block";
        					$("#cell-content").html(vids);
        				}
        			});
        	}
    	function Quiz()
        	{
                    $("#Quize").addClass('active');
                    $("#Chapters").removeClass('active');
                    $("#Vid").removeClass('active');
                    $("#PDFss").removeClass('active');  
                    $("#Glossary").removeClass('active');
                    $("#SampleProgram").removeClass('active');
                    $("#SampleExercise").removeClass('active');
                    document.getElementById("loader").style.display="block";
                    document.getElementById("cell-content").style.display="none";
        			$.ajax
        			({
        				url : 'quizes.php',
        				type : 'POST',
        				async : false,
        				data : 
        				{	
        					quiz : 1
        				},
        				success : function (quizs)
        				{
                            document.getElementById("loader").style.display="none";
                            document.getElementById("cell-content").style.display="block";
        					$("#cell-content").html(quizs);
        				}
        			});
        	}
        function Glossary()
            {
                    $("#Glossary").addClass('active');
                    $("#Quize").removeClass('active');
                    $("#Chapters").removeClass('active');
                    $("#Vid").removeClass('active');
                    $("#PDFss").removeClass('active');  
                    $("#SampleProgram").removeClass('active');
                    $("#SampleExercise").removeClass('active');
                    document.getElementById("loader").style.display="block";
                    document.getElementById("cell-content").style.display="none";
                    $.ajax
                    ({
                        url : 'glossary.php',
                        type : 'POST',
                        async : false,
                        data : 
                        {   
                            Glossary : 1
                        },
                        success : function (Glo)
                        {
                            document.getElementById("loader").style.display="none";
                            document.getElementById("cell-content").style.display="block";
                            $("#cell-content").html(Glo);
                        }
                    });
            }
        function SampleProgram()
            {
                    $("#SampleProgram").addClass('active');
                    $("#Glossary").removeClass('active');
                    $("#Quize").removeClass('active');
                    $("#Chapters").removeClass('active');
                    $("#Vid").removeClass('active');
                    $("#PDFss").removeClass('active');  
                    $("#SampleExercise").removeClass('active');  
                    document.getElementById("loader").style.display="block";
                    document.getElementById("cell-content").style.display="none";
                    $.ajax
                    ({
                        url : 'sampleProgram.php',
                        type : 'POST',
                        async : false,
                        data : 
                        {   
                            sampleProg : 1
                        },
                        success : function (SP)
                        {
                            document.getElementById("loader").style.display="none";
                            document.getElementById("cell-content").style.display="block";
                            $("#cell-content").html(SP);
                        }
                    });
            }
        function SamplExercises()
            {
                    $("#SampleExercise").addClass('active');
                    $("#Glossary").removeClass('active');
                    $("#Quize").removeClass('active');
                    $("#Chapters").removeClass('active');
                    $("#Vid").removeClass('active');
                    $("#PDFss").removeClass('active');  
                    $("#SampleProgram").removeClass('active');  
                    document.getElementById("loader").style.display="block";
                    document.getElementById("cell-content").style.display="none";
                    $.ajax
                    ({
                        url : 'sampleExercise.php',
                        type : 'POST',
                        async : false,
                        data : 
                        {   
                            sampleEx : 1
                        },
                        success : function (SE)
                        {
                            document.getElementById("loader").style.display="none";
                            document.getElementById("cell-content").style.display="block";
                            $("#cell-content").html(SE);
                        }
                    });
            }
        function edit(id)
            {
                    var dialog = $(id).data('dialog');
                    dialog.open();
            }
		function AdminCredentials()
			{
                    var userName = "<?php echo $_SESSION['deanID'] ?>";
					$.ajax
					({
							url : 'showName.php',
							type : 'POST',
							async : false,
							data : 
							{	
								showsName : 1,
                                deanID : userName
							},
							success : function (ShowedName)
							{
                                document.getElementById("AdminsName").innerHTML = ShowedName.firstname;
								$("#AdminsName").val(ShowedName.firstname);
                                document.getElementById("imaged").src = ShowedName.image;
							}
					});
			}
        var ChangeDP = function()
            {
                $("#changeImage").on("submit", function(cImg)
                {
                    cImg.preventDefault();
                    $(this).ajaxSubmit(
                    {
                        beforeSend:function()
                        {
                            $("#prog1").attr("value","0");
                        },
                        uploadProgress:function(event,position,total,percentComplete)
                        {
                            clearInterval(interval2);
                            var pb2 = $("#pb3").data('progress');
                                pb2.set(percentComplete);
                        },
                        success:function(data)
                        {
                            AdminCredentials();
                            var pb = $("#pb3").data('progress');
                                pb.set(0);
                            $.Notify({
                                caption: 'Updated',
                                content: 'Profile Picture has Been Updated',
                                icon: "<span class='mif-file icon'></span>",
                                type: "success"
                            });
                            hideMetroDialog('#dialog2');
                        }

                    });

                });
            };
            $(document).ready(ChangeDP);
    </script>
</html>