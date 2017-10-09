/*select * from employees
  where reportsTo != 1143 and jobTitle = 'Sales Rep' and employeeNumber > 1337
  ORDER BY officeCode DESC, reportsTo DESC;
*/


/*
SELECT officeCode AS office, count(*) AS CNT
  FROM employees
    WHERE jobTitle = 'Sales Rep'
      GROUP BY officeCode
        HAVING CNT > 2;


SELECT *
  FROM employees
  WHERE officeCode IN (
    SELECT officeCode FROM offices WHERE country = 'USA'
  );
*/

/*
SELECT e.email AS mail, o.city
  FROM employees AS e, offices AS o
  WHERE e.officeCode = o.officeCode;


SELECT e.email AS mail, o.city
  FROM employees e
  INNER JOIN offices o ON e.officeCode = o.officeCode
  WHERE o.city = 'Paris'
  ;


SELECT c.customerName,
  ifnull(
      round(
          sum(p.amount), 2
      ),0
  )
  AS SUM
  FROM customers c
  LEFT JOIN payments p ON c.customerNumber = p.customerNumber
  GROUP BY c.customerNumber
  HAVING SUM > 0;
*/

/*
INSERT INTO productlines
  (productLine, textDescription)
  VALUES
  ('PL1', ''),
  ('PL2', 'Description'),
  ('PL3',NULL),
  ('PL4', NULL);
*/

/*

UPDATE productlines SET textDescription = 'New Description 3'
  WHERE productLine LIKE 'PL%';
*/



SELECT c.customerName,
  ifnull(
      round(
          sum(p.amount), 2
      ),0
  )
  AS SUM
  FROM customers c
    LEFT JOIN payments p ON c.customerNumber = p.customerNumber
      GROUP BY c.customerNumber
        HAVING SUM > 0
  LIMIT 10 OFFSET 10
;