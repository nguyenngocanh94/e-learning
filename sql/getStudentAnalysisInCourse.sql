select
    le.status, le.update_at, l.name, l.id, (select count(id) from material m where m.lesson_id= l.id) total
from lession_status le left join lession l on l.id = le.lesson_id where le.student_id = :student_id and l.course_id = :course_id
order by l.rank