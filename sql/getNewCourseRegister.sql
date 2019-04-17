select
    c.id,
    s.name subject_name,
    c.name,
    c.image1,
    t.name teacher_name,
    e.update_at

from course c inner join enroll e on e.course_id = c.id
              left join subject s on s.id = c.subject_id
              left join teacher t on t.id = c.teacher_id
where e.student_id = :student_id
order by e.update_at desc limit 1