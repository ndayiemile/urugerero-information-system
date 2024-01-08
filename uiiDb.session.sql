SELECT category,count(*) as count FROM activities
WHERE dueDate >= "2023-10-10" AND dueDate <= "2025-10-10"
GROUP BY category 