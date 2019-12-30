# Basic PHP and Symfony 4.4 interview

Dear Kristian, 

The name of my mysql database is neos.
The neo:fetch command class is in src/Neo/NeoBundle/Command/FetchCommand.php.
When we enter --since = 1, the neo: fetch returns today's NEOs.
The value of the since option must be: 
	-greater than or equal to 1 
	-less than or equal to 7 (requirement of nasa api).
When the --non-interactive option is present, 
neo:fetch goes directly to retrieving data from the API.

Examples:

/neo/fastest returns json like 
{
	"id":98,
	"date":"2019-12-27T00:00:00+02:00",
	"reference":3830873,
	"name":"(2018 SB2)",
	"speed":140895.11654746,
	"isHazardous":false
}

/neo/fastest/hazardous returns json like
{
	"id":280,
	"date":"2019-12-28T00:00:00+02:00",
	"reference":2136849,
	"name":"136849 (1998 CS1)",
	"speed":115246.23973247,
	"isHazardous":true
}

/neo/best-month returns json like {"best\_month":"12"}

/neo/best-year returns json like {"best\_year":"2019"}

Cordially,

Alain

CET 21:33 Sunday: tasks 1,2,3,4,5,6,7 completed.
CET 22:29 Sunday: task 8 completed.
CET 07:43 Monday: tasks 9 and 10 completed. 
CET 08:25 Monday: Bonus task 1 completed. 
CET 09:31 Monday: Bonus task 2 completed. 
