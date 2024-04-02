<h1>Apextech test</h1>

<h2>STEPS FOR LOCAL SETUP (First setup)</h2>
<ol>  
  <li>cp .env.local .env</li>
  <li>docker compose up -d</li>
  <li>docker exec -it apextech-workspace-1 bash</li>
  <li>composer install</li>
  <li>npm install</li>
  <li>artisan storage:link</li>
  <li>artisan migrate:fresh --seed</li>  
</ol>

<h2>Testing</h2>
<ol>
  <li>docker exec -it apextech-workspace-1 bash</li>
  <li>artisan test</li>    
</ol>


<h2>Customize Test Cases</h2>
<p>Can be done in <b>tests/Feature/CheckoutTest.php</b></p>

<h2>TODOs</h2>
<ol>
  <li>Extend for cases with 2+ DiscountRules per Product (if needed)</li>
  <li>Add admin panel for creating new Products and DiscountRules</li>    
</ol>

<h2>Original task</h2>
------

Notes: Please use about an hour for this test. You can use a framework or structured files as you see fit.

To return the test, either send a zipped archive of code or a *private* repo link.

------

Our supermarket's quest for global reach has prompted us to open a new supermarket - we sell only three products:

Product code | Name         | Price
-----------------------------------------
FR1          | Fruit tea    |  £3.11
SR1          | Strawberries |  £5.00
CF1          | Coffee       | £11.23

The CEO is a big fan of buy-one-get-one-free offers and of fruit tea. He wants us to add a rule to do this.

The COO, though, likes low prices and wants people buying strawberries to get a price discount for bulk purchases. If you buy 3 or more strawberries, the price should drop to £4.50

Our check-out can scan items in any order, and because the CEO and COO change their minds often, it needs to be flexible regarding our pricing rules.

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
