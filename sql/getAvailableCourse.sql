select
    if(enroll.student_id = :student_id, "enrolled", "available") is_enroll,
    course.*
from
    course
        left join
    enroll on enroll.course_id = course.id
where course.del_flg = 0 and if(:subject_id = 0, true, course.subject_id = :subject_id)
