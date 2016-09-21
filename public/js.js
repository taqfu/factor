var siteRoot= "http://taqfu.com" == window.location.href.substr(0,16)
  ? "http://taqfu.com/dev-env/factor/public"
  : "http://rootbasis.com";
$(document.body).ready(function () {
    displayTimePeriods($("#period-of-time").val());
    $("#logout").click(function(event){
        $.get(siteRoot + "/logout");
        window.location.replace(siteRoot);
    });
    $(document).on('click', '.cancel-edit-note', function(event){
        var noteID = event.target.id.substr(16, event.target.id.length-16);
        $("#note-report"+noteID).removeClass("hidden");
        $("div#edit-note" + noteID).addClass("hidden");
    });

    $(".endTimestamp").change(function(event){
        $("#endTimestampSelect").prop("checked", true);
    });
    $(document).on('click', '#hide-edit-name', function(event){
        $("#edit-name").addClass("hidden");
        $("#show-edit-name").removeClass("hidden");
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
        console.log ("#hide-new-person" + divCategory + id);
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

    $(document).on('click', ".hideNewTaskNote", function(event){
        $(".newTaskNote").html("");
        $(".showNewTaskNotes").removeClass('hidden');
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
        $("#createTimePeriod").addClass('hidden');
        $("#hideNewTimePeriod").addClass('hidden');
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
    $(document).on('click touchstart', '.note-report', function(event){
        noteID = event.target.id.substr(11, event.target.id.length-11);
        $("#note-report"+noteID).addClass("hidden");
        $("#edit-note" + noteID).removeClass("hidden");
    });
    $(document).on("click", "#show-edit-name", function(event){
      $("#edit-name").removeClass("hidden");
      $("#show-edit-name").addClass("hidden");
    });
    $(document).on('click', '.show-new-person', function(event){
        resetTimePeriodMenu();
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
        $.get(siteRoot + "/person/task/" + taskID + "/timePeriod/" + timePeriodID,
            function( data ) {
                console.log("#new-person" + divCategory + id);
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
        resetTimePeriodMenu();
        var taskID = event.target.id.substr(16,event.target.id.length-16);
        $(".showNewTaskNotes").removeClass('hidden');
        $("#showNewTaskNotes" + taskID).addClass('hidden');
        $("#hideNewTaskNotes" + taskID).removeClass('hidden');
        $(".newTaskNote").html("");
        $.get(siteRoot + "/note/task/" + taskID + "/timePeriod/0",
            function( data ) {
                $("#newTaskNote"+taskID).html(data);
        });
    });

    $(document).on('click', ".showNewTasks", function(event){
        resetTimePeriodMenu();
        var timePeriodID = event.target.id.substr(12, event.target.id.length-12);
        $(".hideNewTasks").addClass('hidden');
        $(".showNewTasks").removeClass('hidden');

        $("#showNewTasks" + timePeriodID).addClass('hidden');
        $("#hideNewTasks" + timePeriodID).removeClass('hidden');
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
        $.get(siteRoot + "/note/task/0/timePeriod/" + timePeriodID,
            function( data ) {
                $('#newTimePeriodNote' + timePeriodID).html(data);
        });

    });
    $("#showPeople").click(function(event){
        resetTopButtons();
        $("#showPeople").addClass('hidden');
        $("#hidePeople").removeClass('hidden');
        $("#people-list").removeClass('hidden');
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
    console.log(siteRoot + "/time/" + timePeriodID);
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
function displayTasksFromCategoryTypeForTimePeriod(timePeriodID, taskCategoryTypeID){
    //This comes up when you click Add Tasks
    $(".listOfNewTasks:not(#listOfNewTasks" + timePeriodID + ")").html("");
    $.get(siteRoot + "/TasksByCategoryForTimePeriod/" + taskCategoryTypeID + "/TimePeriodID/"
      + timePeriodID, function( data ) {
        $('#listOfNewTasks' + timePeriodID).html(data);
    });
}

function displayTasksFromCategoryType(id){ // [ Show Task Types ]
    $(".activeTaskCategoryType").removeClass('activeTaskCategoryType');
    $("#taskCategoryType" + id).addClass('activeTaskCategoryType');
    $.get(siteRoot + "/TasksByTaskCategoryType/"+id, function(data){
        $('#listOfNewTaskTypes').html( data );
    });
}
function displayTimePeriods(periodOfTime){
    $.get(siteRoot + "/time?period=" + periodOfTime, function(data){
        $("#time-period-index").html(data);
    });
}
function reloadTimePeriod(id){
    $.get(siteRoot + "/time/" + id, function(data){
        $("#time-period" + id).html(data);
    });
}
function resetTimePeriodMenu(){
    $(".time-period-menu").html("");
    $(".hide-time-period-menu").addClass('hidden');
    $(".show-time-period-menu").removeClass('hidden');

}
function resetTopButtons(){
    $(".btn-show").removeClass("hidden");
    $(".btn-hide").addClass("hidden");
    $(".menu-top").addClass("hidden");
}
