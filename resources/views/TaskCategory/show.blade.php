
@foreach ($task_categories as $task_category)
<?php $task_type = $task_category->task_type ?>
@include ('taskCategoryTemplate')
@endforeach

