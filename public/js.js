var taqfuHost=true;
var siteRoot= taqfuHost ? "http://taqfu.com/dev-env/factor/public" : "/factor/public";
$(document.body).ready(function () {
    $(".endTimestamp").change(function(event){
        $("#endTimestampSelect").prop("checked", true);
    });
    $("#hideInactiveTimePeriods").click(function(event){
        $("#showInactiveTimePeriods").show();
        $("#hideInactiveTimePeriods").hide();
        $(".inactive").hide();
    });
    $(".hideNewTags").click(function(event){
        var logID = event.target.id.substr(11,event.target.id.length-11);
        $("#showNewTags"+logID).show();       
        $("#hideNewTags"+logID).hide();       
        $("#listOfNewTags"+logID).hide();       
    });
    $("#hideNewTagTypes").click(function(event){
        var logID = event.target.id.substr(11,event.target.id.length-11);
        $("#showNewTagTypes").show();       
        $("#listOfNewTagTypes").hide();       
    });
    $(document).on("click", ".hideNewTaskCategory", function (event) {
        var classLength = "hideNewTaskCategory".length;
        var taskTypeID = event.target.id.substr(classLength, event.target.id.length-classLength);
        $("#showNewTaskCategory" + taskTypeID).show();
        $("#showNewTaskCategory" + taskTypeID).removeClass('hidden');
        $("#hideNewTaskCategory" + taskTypeID).hide();
        $("#newTaskCategory" + taskTypeID).hide();
    });
    $("#hideNewTaskCategoryType").click(function(event){
        $("#showNewTaskCategoryType").show();
        $("#showNewTaskCategoryType").removeClass('hidden');
        $("#hideNewTaskCategoryType").hide();
        $("#newTaskCategoryType").hide();
    });
    $(document).on('click', ".hideNewTaskNotes", function(event){
        $(".newTaskNote").html("");
        $(".showNewTaskNotes").removeClass('hidden');
    });
    $(document).on("click", ".hideNewTasks", function (event) {
        var timePeriodID = event.target.id.substr(12, event.target.id.length-12);
        $('.listOfNewTasks').html("");
        $("#showNewTasks" + timePeriodID).show();
        $("#showNewTasks" + timePeriodID).removeClass('hidden');
        $(".showNewTasks").show(); 
    });
    $("#hideNewTaskTypes").click(function(event){
        var logID = event.target.id.substr(11,event.target.id.length-11);
        $("#showNewTaskTypes").show();       
        $("#showNewTaskTypes").removeClass('hidden');
        $("#hideNewTaskTypes").hide();       
        $("#taskTypeSection").hide();       
    });
    $(document).on('click', ".hideNewTimePeriodNote", function(event){
        $(".newTimePeriodNote").html("");
        $(".showNewTimePeriodNote").removeClass('hidden');
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
    $(".showNewTags").click(function(event){
        var logID = event.target.id.substr(11,event.target.id.length-11);
        $("#showNewTags"+logID).hide();       
        $("#hideNewTags"+logID).show();       
        $("#listOfNewTags"+logID).show();       
    });
    $("#showNewTagTypes").click(function(event){
        $("#showNewTagTypes").hide();       
        $("#listOfNewTagTypes").show();       
    });
    $(document).on("click", ".showNewTaskCategory", function (event) {
        var classLength = "showNewTaskCategory".length;
        var taskTypeID = event.target.id.substr(classLength, event.target.id.length-classLength);
        $("#showNewTaskCategory" + taskTypeID).hide();
        $("#hideNewTaskCategory" + taskTypeID).show();
        $("#hideNewTaskCategory" + taskTypeID).removeClass('hidden');
        $("#newTaskCategory" + taskTypeID).show();
        $("#newTaskCategory" + taskTypeID).removeClass('hidden');
        console.log(classLength);
    });
    $("#showNewTaskCategoryType").click(function(event){
        $("#showNewTaskCategoryType").hide();
        $("#newTaskCategoryType").show();
        $("#newTaskCategoryType").removeClass('hidden');
        $("#hideNewTaskCategoryType").show();
        $("#hideNewTaskCategoryType").removeClass('hidden');
    });
    $(".showNewTaskNotes").click(function(event){
        var taskID = event.target.id.substr(16,event.target.id.length-16);
        console.log(taskID);
        $(".showNewTaskNotes").removeClass('hidden');
        $("#showNewTaskNotes" + taskID).addClass('hidden');
        $(".newTaskNote").html("");
        $.get(siteRoot + "/TaskNote/create/" + taskID, 
            function( data ) {
                $("#newTaskNote"+taskID).html(data);
        });

    });
    $(".showNewTasks").click(function(event){
        var timePeriodID = event.target.id.substr(12, event.target.id.length-12);
        $("#showNewTasks" + timePeriodID).hide();
        $("#hideNewTasks" + timePeriodID).show();
        $("#hideNewTasks" + timePeriodID).removeClass('hidden');
        displayTasksFromCategoryTypeForTimePeriod(timePeriodID, 1);
        $("input[name='timePeriodID']").val(timePeriodID);
    
    });
    $("#showNewTaskTypes").click(function(event){
        $("#showNewTaskTypes").hide();       
        $("#hideNewTaskTypes").show();       
        $("#hideNewTaskTypes").removeClass('hidden');
        $("#taskTypeSection").show();       
        $("#taskTypeSection").removeClass('hidden');
    });
    $(".showNewTimePeriodNote").click(function(event){
        var classLength = "showNewTimePeriodNote".length;
        var timePeriodID = event.target.id.substr(classLength,event.target.id.length-classLength);
        $(".showNewTimePeriodNote").removeClass('hidden');
        $("#showNewTimePeriodNote" + timePeriodID).addClass('hidden');
        $(".newTimePeriodNote").html("");
        $.get(siteRoot + "/TimePeriodNote/create/" + timePeriodID, 
            function( data ) {
                $('#newTimePeriodNote' + timePeriodID).html(data);
        });
        
    });
    $(".specifyEndTime").click(function(event){
        var idTagLength = "specifyEndTime".length;
        var timePeriodID = event.target.id.substr(idTagLength, event.target.id.length-idTagLength);
        $('#selectEndTimestamp'+timePeriodID).show();
        $('#selectEndTimestamp'+timePeriodID).removeClass('hidden');
    });
    $(".startTimestamp").change(function(event){
        $("#startTimestampSelect").prop("checked", true);
    });
    $(".taskCategoryType").click(function(event){
        var classLength =  "taskCategoryType".length; 
        var taskCategoryTypeID = event.target.id.substr(classLength, event.target.id.length-classLength);
        displayTasksFromCategoryType(taskCategoryTypeID);
    });
    $(document).on("click", ".taskCategoryTypeForTimePeriod", function (event) {
        var classLength =  "taskCategoryTypeForTimePeriod".length; 
        var taskCategoryTypeID = event.target.id.substr(classLength, event.target.id.length-classLength);
        var timePeriodID = $("#timePeriodIDForListOfNewTasks").val();
        displayTasksFromCategoryTypeForTimePeriod(timePeriodID, taskCategoryTypeID);
    });
});

function displayTasksFromCategoryTypeForTimePeriod(timePeriodID, id){ //This comes up when you click Add Tasks
//    console.log(siteRoot + "/TasksByCategoryForTimePeriod/" + id + "/TimePeriodID/" + timePeriodID);
    $.get(siteRoot + "/TasksByCategoryForTimePeriod/" + id + "/TimePeriodID/" + timePeriodID, 
        function( data ) {
            $('#listOfNewTasks' + timePeriodID).html(data);
        });
}

function displayTasksFromCategoryType(id){ // [ Show Task Types ]
    $(".activeTaskCategoryType").removeClass('activeTaskCategoryType');
    $("#taskCategoryType" + id).addClass('activeTaskCategoryType');
    $.get(siteRoot + "/TaskCategoryType/"+id, 
        function( data ) {
            $('#listOfNewTaskTypes').html( data );
        });
} 
