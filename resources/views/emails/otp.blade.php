<p>Dear user,</p>
<p>Company: <strong>{{ $company }}</strong></p>
<p>Your OTP code is: <strong>{{ $otp }}</strong></p>
<p>Please use this code to verify your account.</p>

<p>
    <a href="{{ $verificationUrl }}" style="padding: 10px 20px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px;">
        Verify Your Account
    </a>
</p>

