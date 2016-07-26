<!DOCTYPE html>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


    <html>
    <head>
      <title> SHIPPABLE ASSIGNMENT</title>
    </head>
    <body>
      <input type="text" id="url" placeholder="Enter full URL of GIT" value="" size="50">
      <button id="gitUrlSubmit"  class="button">SUBMIT</button>
    </body>
    </html>

<script type="text/javascript">
function processJSON(inputURL,callback)
{
 $.ajax({
        url: inputURL,
        dataType: 'json',
        success: function(responses) 
          { 
            callback(Object.keys(responses).length);
          },     
      }); 
}
document.getElementById('gitUrlSubmit').addEventListener('click', function() //Advance Search button
      {
        var url="";//later we will use to make different desired urls(egs for open issue/closed issue etc..)
        var Inputurl=document.getElementById('url').value;
        if(Inputurl)//check URL present or not
        {
          var splitURL = Inputurl.split("/");

          //---------- Total number of open issues-----------
              url="https://api.github.com/repos/"+splitURL[3]+"/"+splitURL[4]+"/issues?state=open";
              var totalIssues;
              processJSON(url,function(result) //Since ajax call is Asynchronous, we need to add callback method
              {
                totalIssues=result;
                document.write ("<br>Open Issues Count:<b>".concat(result).concat("</b><br>"));
              });
          //---------EOF ---------

          //----------Number of open issues that were opened in the last 24 hours--------------
              var yesterday = new Date(new Date().getTime() - (24 * 60 * 60 * 1000));
              var issuesOpen24HoursBack;
              //24*60*60*1000 gives milliseconds in a day. Substract that from current day gives 24 hrs back
              url="https://api.github.com/repos/"+splitURL[3]+"/"+splitURL[4]+"/issues?since="+yesterday;
              processJSON(url,function(result) //Since ajax call is Asynchronous, we need to add callback method
              {
                issuesOpen24HoursBack=result;
                document.write ("<br>Open Issues since yesterday(24 hours back):<b>".concat(result).concat("</b><br>"));
              });
          //---------EOF---------

          //--Number of open issues that were opened more than 24 hours ago but less than 7 days ago---
              var oneWeekBack = new Date(new Date().getTime() - (24 * 60 * 60 * 1000* 7));
              //24*60*60*1000 *7 gives milliseconds in a day*7days(ie week+1 day). Substract that from current day gives (24 hrs+(7days)) back
              var issuesOpen7DaysBack;
              url="https://api.github.com/repos/"+splitURL[3]+"/"+splitURL[4]+"/issues?since="+oneWeekBack;
              processJSON(url,function(result) //Since ajax call is Asynchronous, we need to add callback method
              {
                issuesOpen7DaysBack=result;
                result=result-issuesOpen24HoursBack;
                //result contains number of issues since (7days), from that substract count of open issues in last 24 hrs gives desired output
                document.write ("<br>Number of open issues that were opened more than 24 hours ago but less than 7 days ago:<b>".concat(result).concat("</b><br>"));
                      //------------Number of open issues that were opened more than 7 days ago--------
                      result=totalIssues-issuesOpen7DaysBack;
                      document.write ("<br>Number of open issues that were opened more than 7 days ago:<b>".concat(result).concat("</b><br>"));
                      //---------EOF----------
              });
          //---------EOF----------
        }
        else
        {
          alert("url field cant be empty");
          //alert user if URL field is empty
        }

      });


</script>