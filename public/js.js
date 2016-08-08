var taqfuHost=true;
var siteRoot= taqfuHost ? "http://taqfu.com/dev-env/factor/public" : "/factor/public";
$(document.body).ready(function () {
    displayTimePeriods();
    $("#logout").click(function(event){
        $.get(siteRoot + "/logout");
        window.location.replace(siteRoot);
    });

    $(".endTimestamp").change(function(event){
        $("#endTimestampSelect").prop("checked", true);
    });

    $("#hideInactiveTimePeriods").click(function(event){
        $("#showInactiveTimePeriods").show();
        $("#hideInactiveTimePeriods").hide();
        $(".inactive").hide();
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
    });
        
    $(document).on('click', ".hideSelectEndTimestamp", function(event){
        var idTagLength = "hideSelectEndTimestamp".length;
        var timePeriodID = event.target.id.substr(idTagLength, event.target.id.length-idTagLength);
        $('#selectEndTimestamp'+timePeriodID).addClass('hidden');
    });

    $("#hide-sign-up").click(function(event){
        $("#register").addClass('hidden');
        $("#login").removeClass('hidden');    
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

    $(document)on('click', ".showNewTaskNotes", function(event){
        var taskID = event.target.id.substr(16,event.target.id.length-16);
        $(".showNewTaskNotes").removeClass('hidden');
        $("#showNewTaskNotes" + taskID).addClass('hidden');
        $(".newTaskNote").html("");
        $.get(siteRoot + "/note/task/" + taskID + "/timePeriod/0", 
            function( data ) {
                $("#newTaskNote"+taskID).html(data);
        });
    });

    $(".showNewTasks").click(function(event){
        var timePeriodID = event.target.id.substr(12, event.target.id.length-12);
        $("#showNewTasks" + timePeriodID).addClass('hidden');
        $("#hideNewTasks" + timePeriodID).removeClass('hidden');
        displayTasksFromCategoryTypeForTimePeriod(timePeriodID, 1);
        $("input[name='timePeriodID']").val(timePeriodID);
    
    });

    $("#showNewTaskTypes").click(function(event){
        $("#showNewTaskTypes").addClass('hidden');
        $("#hideNewTaskTypes").removeClass('hidden');
        $("#taskTypeSection").removeClass('hidden');
    });

    $("#showNewTimePeriod").click(function(event){
        $("#createTimePeriod").removeClass('hidden');
        $("#hideNewTimePeriod").removeClass('hidden');
        $("#showNewTimePeriod").addClass('hidden');

    });

    $(".showNewTimePeriodNote").click(function(event){
        var classLength = "showNewTimePeriodNote".length;
        var timePeriodID = event.target.id.substr(classLength,event.target.id.length-classLength);
        $(".showNewTimePeriodNote").removeClass('hidden');
        $("#showNewTimePeriodNote" + timePeriodID).addClass('hidden');
        $(".newTimePeriodNote").html("");
        $.get(siteRoot + "/note/task/0/timePeriod/" + timePeriodID, 
            function( data ) {
                $('#newTimePeriodNote' + timePeriodID).html(data);
        });
        
    });

    $("#sign-up-button").click(function(event){
        $("#register").removeClass('hidden');
        $("#login").addClass('hidden');    
    });

    $(".specifyEndTime").click(function(event){
        var idTagLength = "specifyEndTime".length;
        var timePeriodID = event.target.id.substr(idTagLength, event.target.id.length-idTagLength);
        $('#selectEndTimestamp'+timePeriodID).removeClass('hidden');
    });

    $(".startTimestamp").change(function(event){
        $("#startTimestampSelect").prop("checked", true);
    });

    $(".taskCategoryType").click(function(event){
        var classLength =  "taskCategoryType".length; 
        var taskCategoryTypeID = 
          event.target.id.substr(classLength, event.target.id.length-classLength);
        console.log(taskCategoryTypeID);
        displayTasksFromCategoryType(taskCategoryTypeID);
    });

    $(document).on("click", ".taskCategoryTypeForTimePeriod", function (event) {
        var classLength =  "taskCategoryTypeForTimePeriod".length; 
        var taskCategoryTypeID = event.target.id.substr(classLength, 
          event.target.id.length-classLength);
        var timePeriodID = $("#timePeriodIDForListOfNewTasks").val();
        displayTasksFromCategoryTypeForTimePeriod(timePeriodID, taskCategoryTypeID);
    });
});

function displayTasksFromCategoryTypeForTimePeriod(timePeriodID, taskCategoryTypeID){ 
    //This comes up when you click Add Tasks
    $.get(siteRoot + "/TasksByCategoryForTimePeriod/" + taskCategoryTypeID + "/TimePeriodID/" 
      + timePeriodID, function( data ) {
        $('#listOfNewTasks' + timePeriodID).html(data);
    });
}

function displayTasksFromCategoryType(id){ // [ Show Task Types ]
    $(".activeTaskCategoryType").removeClass('activeTaskCategoryType');
    $("#taskCategoryType" + id).addClass('activeTaskCategoryType');
    $.get(siteRoot + "/TaskCategoryType/"+id, function(data){
        $('#listOfNewTaskTypes').html( data );
    });
} 
function displayTimePeriods(){
    $.get(siteRoot + "/time", function(data){
        $("#time-period-index").html(data);
    });
}
