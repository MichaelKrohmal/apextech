#8 - Write an SQL query to get the number of applications per broker
SELECT IFNULL(b.name, 'NO_BROKER') as broker_name, COUNT(a.id) as number_of_applications
FROM brokers as b
         RIGHT JOIN applications AS a ON b.id=a.broker_id
GROUP BY broker_name;
#9 - Write an SQL query to get a list of applications and their status transitions, per broker
SELECT IFNULL(b.name, 'NO_BROKER') as broker_name, COUNT(a.id) as number_of_applications, COUNT(ash.id) as number_of_application_transitions
FROM brokers as b
         RIGHT JOIN applications AS a ON b.id=a.broker_id
         LEFT JOIN application_status_histories AS ash ON a.id=ash.application_id
GROUP BY broker_name;
#10 - Write an SQL query showing customers with incomplete address history
SELECT distinct(name) AS customer_without_address
FROM customers AS c
         LEFT JOIN addresses AS a on c.id=a.customer_id
WHERE a.address IS NULL;
