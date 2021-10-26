select page,count(page) as tmp from log group by page order by tmp desc LIMIT 0,5

select dayname(date) as gougoul, count(date) as tmp from log where newvis = '1' group by gougoul order by tmp

select date_format(date,'%W %e %M %Y') as dt, count(date) as tmp from log where newvis = '1' group by dt order by tmp DESC LIMIT 0,5

select count(idlog) from log where newvis = '1' and date_format(date,'%w') in (0,6) 



