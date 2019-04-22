select ea.content, q.name, m.name material, ea.create_at
from
    essay_answer ea left join question q on q.id = ea.question_id left join material m on m.id = q.material_id
where ea.student_id = :student_id and m.lesson_id = :lesson_id order by ea.create_at DESC