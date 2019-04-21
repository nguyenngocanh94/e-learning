select
    if(enroll.student_id = :student_id, "enrolled", "available") is_enroll,
    c.*, s.name subject, t.name teacher
from
    course c
        left join
    enroll on enroll.course_id = c.id left join subject s on s.id = c.subject_id left join teacher t on t.id = c.teacher_id
where if(:subject_id = 0, true, c.subject_id = :subject_id)
