<!DOCTYPE html>
<html>
<head>
    <title>{{ ucfirst($itemType) }} Status Update</title>
</head>
	<body>
		<p>Hello {{ $userName }},</p>

		<p>The status of your {{ $itemType }} <strong>"{{ $itemTitle }}"</strong> has been updated to <strong>{{ $status }}</strong>.</p>

		@if($status === 'Published' && $datePublish)
			<p>It will be published on: {{ $timePublish->format('M-d-Y') }} at {{ $timePublish->format('h:i A') }}</p>
		@endif

		@if(in_array($status, ['Revision','Rejected']) && $remarks)
			<p>Remarks: {{ $remarks }}</p>
		@endif

		<p>Thank you!</p>
	</body>
</html>
