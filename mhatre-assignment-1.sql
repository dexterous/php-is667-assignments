\T mhatre-assignment-1.out

select name, city
from customers;

select *
from books
where price < 40;

select c.name, avg(o.amount)
from customers c
inner join orders o on c.customerid = o.customerid
group by c.name
having avg(o.amount) > 50
order by avg(o.amount) desc;

select c.name
from customers c
inner join orders o on c.customerid = o.customerid
inner join order_items oi on o.orderid = oi.orderid
inner join books b on oi.isbn = b.isbn
where b.author = 'Thomas Schenk';

\t
