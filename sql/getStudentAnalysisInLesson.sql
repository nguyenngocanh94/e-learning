select
        qs.status,
        qs.create_at,
        m.name material,
         qs.type,
       m.type,
       q.name
from  question_status qs left join question q on q.id = qs.question_id left join material m on m.id = q.material_id
where m.lesson_id = :lesson_id and qs.student_id = :student_id order by qs.create_at desc