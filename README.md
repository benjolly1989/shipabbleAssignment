# shipabbleAssignment
Problem Description 

Create a repository on GitHub and write a program in any programming language that will do the following: 

Input : User can input a link to any public GitHub repository

Output :

Your UI should display a table with the following information -

- Total number of open issues
- Number of open issues that were opened in the last 24 hours
- Number of open issues that were opened more than 24 hours ago but less than 7 days ago
- Number of open issues that were opened more than 7 days ago 

Solution
Sample Input GIT repository URL:https://github.com/Shippable/support/
Creat new url from above ,say: https://api.github.com/repos/Shippable/support/
github api will return json response in array format. Extract desired output from json.

My implementation is in php/Javascript (new_shippable.blade.php)
To get "Total number of open issues" git api url is
(sample)https://api.github.com/repos/benjolly1989/shipabbleAssignment/issues?state=open

To get "Number of open issues that were opened in the last 24 hours"
(sample)https://api.github.com/repos/benjolly1989/shipabbleAssignment/issues?since=Mon Jul 25  2016 10:59:10 GMT+0530 (IST)
-----current date is 26th july 2016-----

To get "Number of open issues that were opened more than 24 hours ago but less than 7 days ago"
(sample)https://api.github.com/repos/benjolly1989/shipabbleAssignment/issues?since=Mon Jul 19 2016 10:59:10 GMT+0530 (IST)
-----current date is 26th july 2016-----
which gives issues in last week(7days). From that substract issues in last 24 hrs(above method) gives desired output.

To get "Number of open issues that were opened more than 7 days ago"
 Substract 'total issue count'(from method 1) and issue count from method 3
 ie, (total issue - issues created in last 7 days)
 
 FOR LIVE PROJECT VISIT
 https://camness.in/shippable
 (hosted in my paid domain.. will take down on 31st july)
