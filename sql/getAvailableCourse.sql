select
    c.name, s.name subject, t.name teacher, enroll.id, enroll.student_id, c.image1, c.description, c.id course,  (select count(l.id) from lession l where l.course_id = course) lesson_count,
    if(enroll.student_id = :student_id, "enrolled", "available") is_enroll
from
    course c
        left join
    enroll on enroll.course_id = c.id and enroll.student_id = :student_id left join subject s on s.id = c.subject_id left join teacher t on t.id = c.teacher_id left join student st on st.id = enroll.student_id
where if(:subject_id = 0, true, c.subject_id = :subject_id);
