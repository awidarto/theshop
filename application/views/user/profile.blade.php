@layout('master')


@section('content')

<h4>User Profile</h4>
<div class="row">
	<div class="profileContent">
		<div class="three columns">
			{{ getavatar($profile['_id'])}}
			<a href="{{ URL::to('user/picture')}}" class="inlink" ><i class="foundicon-smiley action"></i> Change Picture</a>
			<a href="{{ URL::to('user/pass')}}" class="inlink" ><i class="foundicon-lock action"></i> Change Password</a>
			<a href="{{ URL::to('user/editprofile')}}" class="inlink" ><i class="foundicon-edit action"></i> Edit Profile</a><br />
		</div>
		<div class="nine columns">
			<h5>{{ $profile['fullname'] }}</h5>
			<table class="profile-info">
				<tr>
					<td class="detail-title">Email</td>
					<td class="detail-info">{{ $profile['email'] }}</td>
				</tr>
				<tr>
					<td class="detail-title">Roles</td>
					<td class="detail-info">	
						<span>{{roletitle($profile['role'])}}</span>
					</td>
				</tr>
				<tr>
					<td class="detail-title">Job Title</td>
					<td class="detail-info">{{ $profile['employee_jobtitle'] }}</td>
				</tr>
				<tr>
					<td class="detail-title">Department</td>
					<td class="detail-info">{{ depttitle($profile['department']) }}</td>
				</tr>

			</table>
		</div>
	</div>
</div>
@endsection