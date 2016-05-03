
$(document.body).ready(function () {
    $(".endTimestamp").change(function(event){
        $("#endTimestampSelect").prop("checked", true);
    });
    $(".startTimestamp").change(function(event){
        $("#startTimestampSelect").prop("checked", true);
    });
    $(".showNewTags").click(function(event){
        var logID = event.target.id.substr(11,event.target.id.length-11);
        $("#showNewTags"+logID).hide();       
        $("#hideNewTags"+logID).show();       
        $("#listOfNewTags"+logID).show();       
    });
    $(".hideNewTags").click(function(event){
        var logID = event.target.id.substr(11,event.target.id.length-11);
        $("#showNewTags"+logID).show();       
        $("#hideNewTags"+logID).hide();       
        $("#listOfNewTags"+logID).hide();       
    });
    $("#showNewTagTypes").click(function(event){
        $("#showNewTagTypes").hide();       
        $("#listOfNewTagTypes").show();       
    });
    $("#hideNewTagTypes").click(function(event){
        var logID = event.target.id.substr(11,event.target.id.length-11);
        $("#showNewTagTypes").show();       
        $("#listOfNewTagTypes").hide();       
    });
    $("#showNewTaskTypes").click(function(event){
        $("#showNewTaskTypes").hide();       
        $("#hideNewTaskTypes").show();       
        $("#taskTypeSection").show();       
    });
    $("#hideNewTaskTypes").click(function(event){
        var logID = event.target.id.substr(11,event.target.id.length-11);
        $("#showNewTaskTypes").show();       
        $("#hideNewTaskTypes").hide();       
        $("#taskTypeSection").hide();       
    });
    $(".showNewTasks").click(function(event){
        var timePeriodID = event.target.id.substr(12, event.target.id.length-12);
        $('.listOfNewTasks').html("");
        $('#listOfNewTasks' + timePeriodID).html($("#newTaskForm").html());
        $("input[name='timePeriodID']").val(timePeriodID);
    
    });
    $(document).on("click", ".hideNewTasks", function (event) {
        $('.listOfNewTasks').html("");
    });
    $(".specifyEndTime").click(function(event){
        var idTagLength = "specifyEndTime".length;
        var timePeriodID = event.target.id.substr(idTagLength, event.target.id.length-idTagLength);
        $('#selectEndTimestamp'+timePeriodID).show();
    });
    $(".hideSelectEndTimestamp").click(function(event){
        var idTagLength = "hideSelectEndTimestamp".length;
        var timePeriodID = event.target.id.substr(idTagLength, event.target.id.length-idTagLength);
        $('#selectEndTimestamp'+timePeriodID).hide();
    });
    $("#showInactiveTimePeriods").click(function(event){
        $("#showInactiveTimePeriods").hide();
        $("#hideInactiveTimePeriods").show();
        $(".inactive").show();
    });
    $("#hideInactiveTimePeriods").click(function(event){
        $("#showInactiveTimePeriods").show();
        $("#hideInactiveTimePeriods").hide();
        $(".inactive").hide();
    });
    $(".hideNewTaskNotes").click(function(event){
        var taskID = event.target.id.substr(16,event.target.id.length-16);
        $("#showNewTaskNotes"+taskID).show();       
        $("#hideNewTaskNotes"+taskID).hide();       
        $("#newTaskNote"+taskID).hide();       
    });
    $(".showNewTaskNotes").click(function(event){
        var taskID = event.target.id.substr(16,event.target.id.length-16);
        console.log(taskID);
        $("#showNewTaskNotes"+taskID).hide();       
        $("#hideNewTaskNotes"+taskID).show();       
        $("#newTaskNote"+taskID).show();       
    });
    $(".hideNewTimePeriodNote").click(function(event){
        var classLength = "hideNewTimePeriodNote".length;
        var timePeriodID = event.target.id.substr(classLength,event.target.id.length-classLength);
        $("#showNewTimePeriodNote"+timePeriodID).show();       
        $("#newTimePeriodNote"+timePeriodID).hide();       
    });
    $(".showNewTimePeriodNote").click(function(event){
        var classLength = "showNewTimePeriodNote".length;
        var timePeriodID = event.target.id.substr(classLength,event.target.id.length-classLength);
        console.log(timePeriodID);
        $("#showNewTimePeriodNote"+timePeriodID).hide();       
        $("#newTimePeriodNote"+timePeriodID).show();       
    });
    $("#showNewTaskCategoryType").click(function(event){
        $("#showNewTaskCategoryType").hide();
        $("#hideNewTaskCategoryType").show();
        $("#newTaskCategoryType").show();
    });
    $("#hideNewTaskCategoryType").click(function(event){
        $("#showNewTaskCategoryType").show();
        $("#hideNewTaskCategoryType").hide();
        $("#newTaskCategoryType").hide();
    });
    $(".showNewTaskCategory").click(function(event){
        var classLength = "showNewTaskCategory".length;
        var taskTypeID = event.target.id.substr(classLength, event.target.id.length-classLength);
        console.log(classLength);
        $("#showNewTaskCategory" + taskTypeID).hide();
        $("#hideNewTaskCategory" + taskTypeID).show();
        $("#newTaskCategory" + taskTypeID).show();
    });
    $(".hideNewTaskCategory").click(function(event){
        var classLength = "hideNewTaskCategory".length;
        var taskTypeID = event.target.id.substr(classLength, event.target.id.length-classLength);
        console.log(taskTypeID);
        $("#showNewTaskCategory" + taskTypeID).show();
        $("#hideNewTaskCategory" + taskTypeID).hide();
        $("#newTaskCategory" + taskTypeID).hide();
    });
    $(".taskCategoryType").click(function(event){
        var classLength =  "taskCategoryType".length; 
        var taskCategoryTypeID = event.target.id.substr(classLength, event.target.id.length-classLength);
        displayTasksFromCategoryType(taskCategoryTypeID);
    });
    
});
function displayTasksFromCategoryType(id){
    $(".activeTaskCategoryType").removeClass('activeTaskCategoryType');
    $("#taskCategoryType"+id).addClass('activeTaskCategoryType');
    $.get("/factor/public/TaskCategoryType/"+id, 
        function( data ) {
            $('#listOfNewTaskTypes').html( data );
        });
}
