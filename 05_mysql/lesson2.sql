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
*/

/*
SELECT productCode, buyPrice FROM products
  WHERE buyPrice NOT BETWEEN 100 AND 200;
*/

/*
SELECT count(lastName)
  FROM employees
    WHERE officeCode IN (
      SELECT officeCode FROM offices WHERE country = 'USA'
    );

SELECT count(DISTINCT lastName)
  from employees
  INNER JOIN offices ON offices.officeCode = employees.officeCode
  WHERE offices.country = 'USA';
*/

#SELECT avg(buyPrice) FROM products;

/*
SELECT DISTINCT
  productName,

  CASE
    WHEN (buyPrice > 100) THEN 'expensive'
    ELSE 'cheap'
  END AS priceRange,

  IF (buyPrice > 100, 'expensive', 'cheap') as priceRangeIf,

  buyPrice as realPrice

  FROM products
  WHERE buyPrice > (
      SELECT avg(buyPrice) FROM products
    )
;
*/

/*
SELECT c.customerName,
   GROUP_CONCAT(
       DISTINCT p.productLine ORDER BY p.productLine DESC)
     AS pLines
  FROM customers c
  LEFT JOIN orders o ON c.customerNumber = o.customerNumber
  LEFT JOIN orderDetails d on d.orderNumber = o.orderNumber
  LEFT JOIN products p ON d.productCode = p.productCode
  LEFT JOIN productLines l ON p.productLine = l.productLine
  GROUP BY c.customerName
  ORDER BY c.customerName ASC, p.productLine ASC
;

SELECT c.customerName, o.orderNumber
  FROM customers c
  LEFT JOIN orders o ON c.customerNumber = o.customerNumber
  WHERE o.orderNumber IS NULL;
*/

SELECT YEAR(orderDate) AS Y, MONTHNAME(orderDate) AS M, DAY(orderDate) AS D FROM orders;
