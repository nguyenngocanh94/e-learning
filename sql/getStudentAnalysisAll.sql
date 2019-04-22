select
    le.status, le.update_at, l.name lesson, l.id, (select count(id) from material m where m.lesson_id= l.id) total, le.student_id, s.name
from lession_status le left join lession l on l.id = le.lesson_id left join student s on s.id = le.student_id
where l.id = :lesson_id
