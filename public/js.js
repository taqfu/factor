var siteRoot= "http://q.taqfu.com";
var captionIncreasing = false;
var idleTime = 0;
var minutesUntilReload=5;
$(document.body).ready(function () {
	setInterval(function(){
		caption = $(".empty-time-period").html();

		caption = caption == "?" ? "???" : "?";
		$(".empty-time-period").html(caption);

	}, 2000);
	$(".now-button").ready(function(){
		if ($(".now-button").length>0){
		setInterval(updateNowButton, 60000);
		}
	});
	$(".duration.active").ready(function(){
		setInterval(updateDuration, 1000);
	});
    displayTimePeriods($("#period-of-time").val());
    $("#logout").click(function(event){
        $.get(siteRoot + "/logout");
        window.location.replace(siteRoot);
    });
    $(document).on('mouseover', '.resume-button', function(event){
				$("#" + event.target.id).html("Resume");
				$("#" + event.target.id).removeClass("btn-primary");
				$("#" + event.target.id).addClass("btn-info");
    });
    $(document).on('mouseleave', '.resume-button', function(event){
				$("#" + event.target.id).html($("#resume-button-caption" + event.target.id.substr(13)).val());
				$("#" + event.target.id).removeClass("btn-info");
				$("#" + event.target.id).addClass("btn-primary");
    });
    $(document).on('click', '.cancel-edit-note', function(event){
        var noteID = event.target.id.substr(16, event.target.id.length-16);
        $("#note-report"+noteID).removeClass("hidden");
        $("div#edit-note" + noteID).addClass("hidden");
    });
    $(document).on('click', '.delete-element-button', function(event){
        var formID = event.target.id.substr(15, event.target.id.length-15);
        if(confirm("Are you sure you want to delete this?")){
            $("form#" + formID).submit();
        }

    });
    $(document).on('click', '.delete-task', function(event){
        if (confirm("Are you sure you want to delete this task?")){
            var typeID = event.target.id.substr(11, event.target.id.length-11);
            var timePeriodID = $("#task-time-period" + typeID).val();
            $("#delete-task" + typeID).addClass('btn-success');
            $("#delete-task" + typeID).removeClass('btn-danger');
            $("#delete-task" + typeID).addClass('newTask');
            $("#delete-task" + typeID).removeClass('delete-task');
            $("#delete-task" + typeID).attr("id", "newTask" + typeID);
            deleteTaskByTypeAndTimePeriod(typeID, timePeriodID);
        }
    });
    $(".endTimestamp").change(function(event){
        $("#endTimestampSelect").prop("checked", true);
    });
    $(document).on('click', '#hide-edit-name', function(event){
        $("#edit-name").addClass("hidden");
        $("#show-edit-name").removeClass("hidden");
    });
		$(document).on('click', '#hide-overmenu-container', function(event){
				$("#overmenu-container").css("display", "none");
				console.log("ASDFAS");
		});
    $("#hideInactiveTimePeriods").click(function(event){
        $("#showInactiveTimePeriods").show();
        $("#hideInactiveTimePeriods").hide();
        $(".inactive").hide();
    });
    $(document).on('click', '.hide-new-person', function(event){
        var id = event.target.id.substr(15, event.target.id.length-5);
        if (id.substr(0, 5) == "-task"){
            var divCategory = "-task";
            var id = id.substr(5);
        } else {
            var divCategory = "-time-period";
            var id = id.substr(12);
        }
        $("#hide-new-person" + divCategory + id).addClass('hidden');
        $("#show-new-person" + divCategory + id).removeClass('hidden');
        $(".new-person").html("");
    });

    $(document).on("click", ".hideNewTaskCategory", function (event) {
        var classLength = "hideNewTaskCategory".length;
        var taskTypeID = event.target.id.substr(classLength, event.target.id.length-classLength);
        $("#showNewTaskCategory" + taskTypeID).removeClass('hidden');
        $("#newTaskCategory" + taskTypeID).addClass('hidden');
    });
    $("#hideNewTaskCategoryType").click(function(event){
        $("#showNewTaskCategoryType").removeClass('hidden');
        $("#newTaskCategoryType").addClass('hidden');
    });

    $(document).on('click', ".hideNewTaskNotes", function(event){
        $(".newTaskNote").html("");
        $(".showNewTaskNotes").removeClass('hidden');
        $(".hideNewTaskNotes").addClass('hidden');

    });

    $(document).on("click", ".hideNewTasks", function (event) {
        $('.listOfNewTasks').html("");
        $(".showNewTasks").removeClass('hidden');
        $("#hideNewTasks" + event.target.id.substr(12, event.target.id.length-12)).addClass('hidden');
    });

    $("#hideNewTaskTypes").click(function(event){
        $("#showNewTaskTypes").removeClass('hidden');
        $("#hideNewTaskTypes").addClass('hidden');
        $("#taskTypeSection").addClass('hidden');
    });

    $("#hideNewTimePeriod").click(function(event){
				console.log("ASDFA");
        $("#createTimePeriod").addClass('hidden');
        $("#showNewTimePeriod").removeClass('hidden');
    });

    $(document).on('click', ".hideNewTimePeriodNote", function(event){
        $(".newTimePeriodNote").html("");
        $(".showNewTimePeriodNote").removeClass('hidden');
        $(".hideNewTimePeriodNote").addClass('hidden');
    });
    $("#hidePeople").click(function(event){
        $("#hidePeople").addClass('hidden');
        $("#showPeople").removeClass('hidden');
        $("#people-list").addClass('hidden');
    });

    $(document).on('click', ".hideSpecifyEndTime", function(event){
        var idTagLength = "hideSpecifyEndTime".length;
        var timePeriodID = event.target.id.substr(idTagLength, event.target.id.length-idTagLength);
        $('#selectEndTimestamp'+timePeriodID).addClass('hidden');
        $("#specifyEndTime" + timePeriodID).removeClass('hidden');
        $("#hideSpecifyEndTime" + timePeriodID).addClass('hidden');
    });

    $("#hide-sign-up").click(function(event){
        $("#register").addClass('hidden');
        $("#login").removeClass('hidden');
    });
    $("#hide-time-zone").click(function(event){
        $("#hide-time-zone").addClass('hidden');
        $("#show-time-zone").removeClass('hidden');
        $("#time-zone-settings").addClass('hidden');
    });
    $(document).on('click', '.note-report', function(event){
        noteID = event.target.id.substr(11, event.target.id.length-11);
        $("#note-report"+noteID).addClass("hidden");
        $("#edit-note" + noteID).removeClass("hidden");
    });
    $(document).on("click", "#show-edit-name", function(event){
      $("#edit-name").removeClass("hidden");
      $("#show-edit-name").addClass("hidden");
    });
    $(document).on('click', '.show-new-person', function(event){
        resetTaskMenu();
        var id = event.target.id.substr(15, event.target.id.length-5);
        if (id.substr(0, 5) == "-task"){
            var divCategory = "-task";
            var id = id.substr(5);
            var taskID = id;
            var timePeriodID = 0;
        } else {
            var divCategory = "-time-period";
            var id = id.substr(12);
            var taskID=0;
            var timePeriodID = id;
        }
        $("#show-new-person" + divCategory + id).addClass('hidden');
        $("#hide-new-person" + divCategory + id).removeClass('hidden');
        $(".new-person:not(#new-person" + divCategory + id + ")").html("");
        var interval = loadingMenu("#new-person" + divCategory + id);
        $.get(siteRoot + "/person/task/" + taskID + "/timePeriod/" + timePeriodID,
            function( data ) {
                clearInterval(interval);
                $("#new-person" + divCategory + id).html(data);

        });
    });
    $(document).on("click", ".showNewTaskCategory", function (event) {
        var classLength = "showNewTaskCategory".length;
        var taskTypeID = event.target.id.substr(classLength, event.target.id.length-classLength);
        $("#showNewTaskCategory" + taskTypeID).addClass('hidden');
        $("#hideNewTaskCategory" + taskTypeID).removeClass('hidden');
        $("#newTaskCategory" + taskTypeID).removeClass('hidden');
    });

    $("#showNewTaskCategoryType").click(function(event){
        $("#showNewTaskCategoryType").addClass('hidden');
        $("#newTaskCategoryType").removeClass('hidden');
        $("#hideNewTaskCategoryType").removeClass('hidden');
    });

    $(document).on('click', ".showNewTaskNotes", function(event){
        resetTaskMenu();
        var taskID = event.target.id.substr(16,event.target.id.length-16);
        $(".showNewTaskNotes").removeClass('hidden');
        $("#showNewTaskNotes" + taskID).addClass('hidden');
        $("#hideNewTaskNotes" + taskID).removeClass('hidden');
        $(".newTaskNote").html("");
        var interval = loadingMenu("#newTaskNote"+taskID);

        $.get(siteRoot + "/note/task/" + taskID + "/timePeriod/0",
            function( data ) {
                clearInterval(interval);
                $("#newTaskNote"+taskID).html(data);
        });
    });

    $(document).on('click', ".show-new-tasks", function(event){
				$("#overmenu-container").css('display', "flex"); //display:none;
        resetTimePeriodMenu();
        var timePeriodID = event.target.id.substr(12, event.target.id.length-12);

        displayTasksFromCategoryTypeForTimePeriod(timePeriodID, 1);
        $("input[name='timePeriodID']").val(timePeriodID);

    });

    $("#showNewTaskTypes").click(function(event){
        resetTopButtons();
        $("#showNewTaskTypes").addClass('hidden');
        $("#hideNewTaskTypes").removeClass('hidden');
        $("#taskTypeSection").removeClass('hidden');
    });

    $("#showNewTimePeriod").click(function(event){
				console.log("ASDFA");
        resetTopButtons();
        $("#createTimePeriod").removeClass('hidden');
        $("#hideNewTimePeriod").removeClass('hidden');
        $("#showNewTimePeriod").addClass('hidden');

    });

    $(document).on('click', ".showNewTimePeriodNote", function(event){
        resetTimePeriodMenu();
        var classLength = "showNewTimePeriodNote".length;
        var timePeriodID = event.target.id.substr(classLength,event.target.id.length-classLength);
        $(".showNewTimePeriodNote").removeClass('hidden');
        $("#showNewTimePeriodNote" + timePeriodID).addClass('hidden');
        $("#hideNewTimePeriodNote" + timePeriodID).removeClass('hidden');
        $(".newTimePeriodNote").html("");
        var interval = loadingMenu('#newTimePeriodNote' + timePeriodID);

        $.get(siteRoot + "/note/task/0/timePeriod/" + timePeriodID,
            function( data ) {
                clearInterval(interval);
                $('#newTimePeriodNote' + timePeriodID).html(data);
        });

    });
    $("#showPeople").click(function(event){
        resetTopButtons();
        $("#showPeople").addClass('hidden');
        $("#hidePeople").removeClass('hidden');
        $("#people-list").removeClass('hidden');
    });
    $("#show-time-zone").click(function(event){
        resetTopButtons();
        $("#show-time-zone").addClass('hidden');
        $("#hide-time-zone").removeClass('hidden');
        $("#time-zone-settings").removeClass('hidden');
    });

    $("#sign-up-button").click(function(event){
        $("#register").removeClass('hidden');
        $("#login").addClass('hidden');
    });

    $(document).on('click', ".specifyEndTime", function(event){
        var idTagLength = "specifyEndTime".length;
        var timePeriodID = event.target.id.substr(idTagLength, event.target.id.length-idTagLength);
        $("#specifyEndTime" + timePeriodID).addClass('hidden');
        $("#hideSpecifyEndTime" + timePeriodID).removeClass('hidden');
        $('#selectEndTimestamp'+timePeriodID).removeClass('hidden');
    });

    $(".startTimestamp").change(function(event){
        $("#startTimestampSelect").prop("checked", true);
    });

    $(".taskCategoryType").click(function(event){
        var classLength =  "taskCategoryType".length;
        var taskCategoryTypeID =
          event.target.id.substr(classLength, event.target.id.length-classLength);
        displayTasksFromCategoryType(taskCategoryTypeID);
    });
    $(document).on('click', '.newTask', function(event){
        var typeID = event.target.id.substr(7, event.target.id.length-7);
        var timePeriodID = $("#task-time-period" + typeID).val();
        $("#newTask" + typeID).removeClass('btn-success');
        $("#newTask" + typeID).addClass('btn-danger');
        $("#newTask" + typeID).removeClass('newTask');
        $("#newTask" + typeID).addClass('delete-task');
        $("#newTask" + typeID).attr("id", "delete-task" + typeID);


        createTask(typeID, timePeriodID);

    });
    $(document).on("click", ".taskCategoryTypeForTimePeriod", function (event) {
        var classLength =  "taskCategoryTypeForTimePeriod".length;
        var taskCategoryTypeID = event.target.id.substr(classLength,
          event.target.id.length-classLength);
        var timePeriodID = $("#timePeriodIDForListOfNewTasks").val();
        displayTasksFromCategoryTypeForTimePeriod(timePeriodID, taskCategoryTypeID);
    });
});

function createTask(typeID, timePeriodID){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "POST",
        url: siteRoot + "/task",
        data:{timePeriodID:timePeriodID, typeID:typeID},
    })
        .done(function (result){
            result!="OK"
              ? $("#time-period-error" + timePeriodID).html(result)
              : reloadTimePeriod(timePeriodID);
        });
}
function deleteTaskByTypeAndTimePeriod(typeID, timePeriodID){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "GET",
        url: siteRoot + "/task/type/" + typeID + "/TimePeriodID/" + timePeriodID
    })
        .done(function (result){
            result!="OK"
              ? $("#time-period-error" + timePeriodID).html(result)
              : reloadTimePeriod(timePeriodID);
        });

}
function displayTasksFromCategoryTypeForTimePeriod(timePeriodID, taskCategoryTypeID){
    //This comes up when you click Add Tasks
    $('#overmenu-contents').html("");
    var interval = loadingMenu('#overmenu-contents');
	
    $.get(siteRoot + "/TasksByCategoryForTimePeriod/" + taskCategoryTypeID + "/TimePeriodID/"
      + timePeriodID, function( data ) {
        clearInterval(interval);
        $('#overmenu-contents').html(data);
    });
}

function displayTasksFromCategoryType(id){ // [ Show Task Types ]
    $(".activeTaskCategoryType").removeClass('activeTaskCategoryType');
    $("#taskCategoryType" + id).addClass('activeTaskCategoryType');
    var interval = loadingMenu("#listOfNewTaskTypes");

    $.get(siteRoot + "/TasksByTaskCategoryType/"+id, function(data){
        clearInterval(interval);
        $('#listOfNewTaskTypes').html( data );
    });

}
function displayTimePeriods(periodOfTime){
    var interval = loadingMenu("#time-period-index");
    $.get(siteRoot + "/time?period=" + periodOfTime, function(data){
        clearInterval(interval);
        $("#time-period-index").html(data);
    });
}
function loadingMenu(divName){
    var begin = "<h1 style='text-align:center;'>";
    var chars = ".";
    var end = "</h1>";
    var otherChars = begin.length + end.length;
    var interval = window.setInterval( function() {
    if ($(divName).length>0
      && $(divName).html().length - otherChars >10){
        chars = ".";
    } else if ($(divName).length>0
      && $(divName).html().length>0){
        chars = $(divName).html().substr(begin.length, $(divName).html().length - otherChars) + ".";
    }
    $(divName).html(begin + chars + end);
  }, 500);
    return interval;
}
function reloadTimePeriod(id){
    var interval = loadingMenu("#time-period" + id);
    $.get(siteRoot + "/time/" + id, function(data){
        clearInterval(interval);
        $("#time-period" + id).html(data);
    });
}
function resetTimePeriodMenu(){
    $(".time-period-menu").html("");
    $(".hide-time-period-menu").addClass('hidden');
    $(".show-time-period-menu").removeClass('hidden');

}
function resetTaskMenu(){
  $(".task-menu").html("");
  $(".hide-task-menu").addClass('hidden');
  $(".show-task-menu").removeClass('hidden');
}
function resetTopButtons(){
    $(".btn-show").removeClass("hidden");
    $(".btn-hide").addClass("hidden");
    $(".menu-top").addClass("hidden");
}

function timerIncrement() {
    idleTime = idleTime + 1;
}
function resetTimerOrReload(){
        if (idleTime >= minutesUntilReload){
            window.location.reload();
        }
}
function updateDuration(){
	activeDurations = $(".duration.active");
	for(i=0;i<activeDurations.length;i++){
		days=0, hours=0, minutes=0, seconds=0;
		duration = String(activeDurations[i].innerText);
		newDuration = "";
		durationArr = duration.split(" ");
		durationArr.forEach( function (durationElement){
			lastLetter = durationElement.substr(-1);

			switch(lastLetter){
				case "d":
					days = durationElement.substr(0, durationElement.length-1);
					break;
				case "h":
					hours = durationElement.substr(0,durationElement.length-1);
					break;
				case "m":
					minutes = durationElement.substr(0,durationElement.length-1);
					break;
				case "s":
					seconds = durationElement.substr(0,durationElement.length-1);
					break;
			}
		});
		seconds++;
		if (seconds>59) {
			minutes++;
			seconds=0;
		}
		$(".now-seconds").val(seconds);
		if (minutes>59){
			hours++;
			minutes=0;
		}
		if (hours>23){
			hours=0;
			days++;
		}
		if (seconds>0){
			newDuration = seconds + "s";
		}
		if (minutes>0){
			newDuration = minutes + "m " + seconds + "s";
		}
		if (hours>0){
			newDuration = hours + "h " + minutes + "m " + seconds + "s";
		}
		if (days>0){
			newDuration = days + " " + hours + "h " + minutes + "m " + seconds + "s";
		}
		$("#" + activeDurations[i].id).html(newDuration);
		document.title = "Q - " + newDuration;
	}
}

function updateNowButton(){
		buttonVal = $(".now-button").val();
		hours = buttonVal.substr(0,2);
		minutes = buttonVal.substr(3,2);
		minutes++;
		if (minutes>59){
			hours++;
			minutes=0;
		}
		if (hours>23){
			hours=0;
		}
		if (hours<10){
			hours = "0" + hours;
		}
		if (minutes<10){
			minutes = "0" + minutes;
		}
		$(".now-button").val(hours + ":" + minutes);
}
