select
    if(enroll.student_id = :student_id, "enrolled", "available") is_enroll,
    course.*
from
    course
left join
    enroll on enroll.course_id = course.id
where course.del_flg = 0

