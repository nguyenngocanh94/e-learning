jQuery(document).ready(function($) {
    $('student-item').click(function () {
        $student_id = $(this).data('sid');
        $lesson_id = $(this).data('lid');
        location.href = '/material/analysis?student_id='+$student_id+'&lesson_id='+$lesson_id;
    });
});