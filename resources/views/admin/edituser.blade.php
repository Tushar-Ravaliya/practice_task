<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{ URL::to('/') }}/css/edituser.css">
</head>

<body>
    <div class="container">
        <div class="center">
            <div class="box">
                <form action="{{ URL::to('/') }}/updateuser/{{$member->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="name">Name :</label><br> <input type="text" id="name" name="name"
                        placeholder="Name" value="{{ $member->name }}"><br>
                    @error('name')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                    <label for="email">Email :</label><br><input type="email"id="email" name="email"
                        placeholder="Email"value="{{ $member->email }}"><br>
                    @error('email')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                    <label for="pwd">Password :</label><br><input type="password" id="pwd" name="password"
                        placeholder="password"value="{{ $member->password }}"><br>
                    @error('password')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                    <label for="no">Mobile No :</label><br><input type="number" id="no" name="mobile_no"
                        placeholder="Mobile No."value="{{ $member->mobile_no }}"><br>
                    @error('mobile_no')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                    <label for="dob">Birth Date</label><br> <input type="date" id="dob" name="birthdate"
                        placeholder="DOB" value="{{ $member->birthdate }}"><br>
                    @error('birthdate')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                    <label for="gen">Gender :</label><br> <input type="radio" id="m" name="gender"
                        value="male" c> <label for="m">Male</label>
                    <input type="radio" name="gender" id="f" value="female"> <label
                        for="f">Female</label><br>
                    @error('gender')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                    <label for="pro">Profile Photo :</label><br><input type="file"id="pro" name='profile_image'
                        value="{{ $member->profile_image }}"> <br>
                    <input type="submit" value="Update" class="sub_btn">
                   
                </form>
            </div>
            
        </div>
    </div>
<script>
    var gen = '{{$member->gender}}'
// console.log(gen);
if(gen == 'male'){
    document.getElementById('m').checked = true
}else{
    document.getElementById('f').checked = true
}
</script>
</body>

</html>
