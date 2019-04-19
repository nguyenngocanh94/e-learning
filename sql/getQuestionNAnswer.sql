select q.material_id,
       q.id,
       q.name,
       q.content,
       q.essay_content,
       q.hint,
       q.answer_content,
       a.id answer_id,
       a.answer_content answer
from question q
         left join answer a on a.question_id = q.id
where

   q.material_id = :material_id
order by q.rank, a.rank