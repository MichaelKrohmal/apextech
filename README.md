<h1>Apextech Test #1</h1>

<h2>STEPS FOR LOCAL SETUP (First setup)</h2>
<ol>  
  <li>cp .env.local .env</li>
  <li>docker compose up -d</li>
  <li>docker exec -it apextech-workspace-1 bash</li>
  <li>composer install</li>
  <li>npm install</li>
  <li>artisan migrate:fresh --seed</li>  
</ol>

<h2>Testing</h2>
<ol>
  <li>docker exec -it apextech-workspace-1 bash</li>
  <li>artisan test</li>    
</ol>

<h2>Customize Test Cases</h2>
<p>Can be done in <b>tests/Feature/CheckoutTest.php</b></p>

<h2>TODOs and Notes</h2>
<ol>
  <li>"buy-one-get-one-free" - there's no sense to buy odd number of Products, only even</li>
  <li>Extend for cases with 2+ DiscountRules per Product (if needed)</li>
  <li>Optional: Can add admin panel for creating new Products and DiscountRules</li>
  <li>Task #2: It's better to use EnumClass statuses to provide easier extending, see TODOs im Migrations</li>
</ol>

<h1>Apextech Test #2</h1>

<h2>Required files</h2>
<p>Queries in <b>MySQLTaskData/queries.sql</b></p>
<p>Schema in <b>MySQLTaskData/schema.sql</b></p>
<p>Seed in <b>MySQLTaskData/seed.sql</b></p>

<h1>Task #1 Description - PHP</h1>
Notes: Please use about an hour for this test. You can use a framework or structured files as you see fit.
To return the test, either send a zipped archive of code or a *private* repo link.

Our supermarket's quest for global reach has prompted us to open a new supermarket - we sell only three products:

Product code | Name         | Price
-----------------------------------------
FR1          | Fruit tea    |  £3.11
SR1          | Strawberries |  £5.00
CF1          | Coffee       | £11.23

The CEO is a big fan of buy-one-get-one-free offers and of fruit tea. He wants us to add a rule to do this.
The COO, though, likes low prices and wants people buying strawberries to get a price discount for bulk purchases.
If you buy 3 or more strawberries, the price should drop to £4.50
Our check-out can scan items in any order, and because the CEO and COO change their minds often, 
it needs to be flexible regarding our pricing rules.
The interface to our checkout looks like this (shown in PHP):

$co = new Checkout($pricing_rules);
$co->scan($item);
$co->scan($item);
$price = $co->total;

1 - Implement a checkout system that fulfils these requirements.
2 - Make sure your code is fully documented so that PHPDoc files can be generated automatically.
3 - Make sure your code is 100% covered by unit tests.

Test data
---------

Basket: FR1,SR1,FR1,FR1,CF1
Total price expected: £22.45

Basket: FR1,FR1
Total price expected: £3.11

Basket: SR1,SR1,FR1,SR1
Total price expected: £16.61

<h1>Task #2 Description - MySQL</h1>
We are designing a new system which will accept loan applications by customers or by brokers working on behalf of
customers. A broker is just an agent working on behalf of the customer, trying to find the best possible loan for them.

Considering that we will be using MySQL8 for this system, design a database schema to represent the relationships
between brokers, customers, products and loan applications, assuming the following:

1 - A customer/applicant can apply for multiple loans.
2 - A customer/applicant applies for a loan either directly or via their choice of broker.
3 - A loan application could have one or more applicants but only one loan product.
4 - The minimum dataset needed should contain the below:
- customer (full name, date of birth, email, address history for the last 5yrs)
- broker (name, email, company address, type [one or more of A, B, C, D]
- product (name, interest rate, term)
- application (customer, broker, product, loan amount, monthly payment (this is a calculated value and for this
exercise assume this formula: loan amount * (interest rate / 12)),
status [one of NEW, PROCESSING, APPROVED, DECLINED, COMPLETED, CANCELLED])
5 - Every database table must have a created and last updated dates.
6 - Note that we need to audit application status changes, so every status change must be recorded.
----
7 - Populate your schema with large enough, sample data.
----
8 - Write an SQL query to get the number of applications per broker.
9 - Write an SQL query to get a list of applications and their status transitions, per broker.
10 - Write an SQL query showing customers with incomplete address history.
----
You will be judged on schema design, correct selection of column types, correct restrictions applied to the schema,
correct indexing and the efficiency of your SQL queries.

Deliverables
------------
1 - Export your database schema on a file named schema.sql
2 - Export your sample data on a file called seed.sql
3 - Create a file named queries.sql, containing the 3 SQL queries answering questions 8, 9, 10.
