@layout('public')


@section('content')

<h4>User Profile</h4>
<div class="row">
	<div class="profileContent">
		<div class="ten columns">
			<h5>{{ $profile['firstname'].' '.$profile['lastname'] }}</h5>
			<table class="profile-info">
				<tr>
					<td class="detail-title">Email</td>
					<td class="detail-info">{{ $profile['email'] }}</td>
				</tr>
				<tr>
					<td class="detail-title">Registration Type</td>
					<td class="detail-info">{{ $profile['regtype'] }}</td>
				</tr>
				<tr>
					<td class="detail-title">Company</td>
					<td class="detail-info">{{ $profile['company'] }}</td>
				</tr>

			</table>
		</div>
	</div>
</div>
@endsection