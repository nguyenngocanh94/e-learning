select
    e.student_id,
    if(e.student_id = :student_id, "enrolled", "available") is_enroll,
    c.id, c.name, c.description, c.image1, s.name subject, t.name teacher, t.id teacher_id

from course c left join subject s on s.id = c.subject_id left join teacher t on t.id = c.teacher_id
              left join enroll e on e.course_id = c.id
where
        c.name like concat(:name,'%')
  and if(:teacher_name = '', true, t.name like concat(:teacher_name,'%'))
  and if(:subject_id = 0, true, s.id = :subject_id)
order by (CASE :type
              WHEN 1 THEN rate
              WHEN 2 THEN enrolled_number

              ELSE c.id END) DESC