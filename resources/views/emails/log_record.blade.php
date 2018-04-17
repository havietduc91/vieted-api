<!DOCTYPE html>
<html>
<head>
<title>Log Record</title>
</head>
<body>
<h2>You log to {{$log->table_name}} table</h2>
<br/>
	Status of log is {{$log->status}}<br/>
	Start time of log is {{$log->start_time}}<br/>
	End time of log is {{$log->end_time}}<br/>
</body>
</html>